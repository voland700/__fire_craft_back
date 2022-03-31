<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Property;
use App\Models\Document;
use App\Models\Discount;
use App\Models\Offer;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{
    public function list($id=NULL)
    {
        if($id){
            $DataCategories = Category::descendantsAndSelf($id);
            $parentId = Category::find($id)->parent_id;
            $products = Product::with('offers')->whereIn('category_id', $DataCategories->pluck('id'))->orderBy('sort')->paginate(20);
        }else{
            $DataCategories = Category::get();
            $parentId = null;
            $products = Product::with('offers')->orderBy('sort', 'asc')->paginate(20);
        }
        $categories = $DataCategories->toTree();
        return view('admin.catalog.product.index', compact( 'categories', 'products','id', 'parentId'));
    }

    public function create($id=NULL)
    {
        $categories = Category::all()->toTree();
        $currency = Currency::select('currency', 'Name')->get();
        $properties = Property::all()->sortBy('sort');
        $category_id = $id;
        return view('admin.catalog.product.create', compact('categories', 'category_id', 'currency', 'properties'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['active'] = $request->has('active') ? 1 : 0;
        $data['hit'] = $request->has('hit') ? 1 : 0;
        $data['new'] = $request->has('new') ? 1 : 0;
        $data['stock'] = $request->has('stock') ? 1 : 0;
        $data['advice'] = $request->has('advice') ? 1 : 0;
        $data['category_id'] = $request->category_id != 0 ? $request->category_id : NULL;

        $properties = [];
        if($data['properties']){
            foreach ($data['properties'] as $key => $property){
                if($property['value'] !== null){
                    $properties[$key] = $property;
                }
            }
        }
        $data['properties'] = json_encode($properties,JSON_UNESCAPED_UNICODE);

        $data['currency'] = $request->currency;
        if($request->base_price != NULL) {
            if($request->currency == 'RUB') {
                $data['base_price'] = (float)$request->base_price;
                $data['price'] = $request->base_price;
            } else {
                $currency = Currency::find($request->currency);
                $data['base_price'] = (float)$request->base_price;
                $data['price'] = $request->base_price * $currency->Nominal * $currency->value;
            }
        } else {
            $data['base_price'] = 0;
            $data['price'] = 0;
        }

        if($request->img && !$request->preview){
            $pathSmall = str_replace('big_', 'small_', $request->img);
            if (Storage::disk('public')->exists(str_replace('storage', '', $request->img))){
                Storage::disk('public')->copy(str_replace('storage', '', $request->img), str_replace('storage', '', $pathSmall));
                Image::make(storage_path(str_replace('storage', 'app/public', $pathSmall)))->fit(300, 350)->save();
                $data['preview'] = $pathSmall;
            }
        }






        $product = Product::create($data);

        if($request->image) {
            foreach ($request->image as $image){
                \App\Models\Image::create([
                    'product_id' => $product->id,
                    'img' => $image,
                    'thumbnail' => str_replace('big_', 'small_', $image)
                ]);
            }
        }

        $arrDocs = [];
        $arrIdDocs = Document::pluck('id')->toArray();
        foreach ($request->doc as $document){
            if($document !== null && in_array($document, $arrIdDocs))  array_push($arrDocs, $document);
        }
        if($arrDocs) {
            $product->documents()->sync($arrDocs);
        }

        return redirect()->route('product.list', $data['category_id'] )->with('success', 'Новый товар созздан');
    }


    public function edit($id){



    }













    //Dropzone.js - загрузка imd и preview изображений при создании нового товара
    public function CreateImgUpload(Request $request)
    {
        if($request->hasFile('file')){
            $image = $request->file('file');
            $fileName = time() . '_' . Str::lower(Str::random(2)) . '.' . $image->getClientOriginalExtension();
            $path_to = '/images/' . getfolderName();
            if($request->type == 'img'){
                $image->storeAs('public' . $path_to, 'big_'.$fileName);
                $imgPath = 'storage' . $path_to . '/' . 'big_'.$fileName;
            }
            if($request->type == 'preview'){
                $image->storeAs('public' . $path_to, 'small_'.$fileName);
                Image::make(storage_path('app/public'.$path_to.'/'.'small_'.$fileName))->resize(350, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save();
                $imgPath = 'storage' . $path_to . '/' . 'small_'.$fileName;
            }
            return response()->json(['success' => $imgPath]);
        } else {
            return response()->json(['error' =>'Файл не загружен']);
        }
    }


    //Dropzone.js - загрузка images дополнительных изображений при создании нового товара
    public function CreateImagesUpload(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time().'_'.Str::lower(Str::random(2)).'.'.$image->getClientOriginalExtension();

            $fileBigName = 'big_'.$fileName;
            $fileSmallName = 'small_'.$fileName;
            $path_to = '/temp/images/'.getfolderName();
            $image->storeAs('public'.$path_to, $fileBigName);
            $image->storeAs('public'.$path_to, $fileSmallName);
            Image::make(storage_path('app/public'.$path_to.'/'.$fileSmallName))->fit(100, 100)->save();
            $imgPath = 'storage'.$path_to.'/'.$fileBigName;
            return response()->json(['success'=>$imgPath]);
        }

    }
    //Dropzone.js - удаление images дополнительных изображений при создании нового товара
    public function CreateImagesRemove(Request $request)
    {
        if($request->path) {
            $pathSmall = str_replace('big_', 'small_', $request->path);
            if (Storage::disk('public')->exists(str_replace('storage', '', $request->path))){
                Storage::disk('public')->delete(str_replace('storage', '', $request->path));
            }
            if (Storage::disk('public')->exists(str_replace('storage', '', $pathSmall))){
                Storage::disk('public')->delete(str_replace('storage', '', $pathSmall));
            }
            return response()->json(['success'=>200]);
        }
    }








}
