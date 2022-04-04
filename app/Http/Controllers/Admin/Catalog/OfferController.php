<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Color;
use App\Models\Currency;
use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class OfferController extends Controller
{
    public function list($id)
    {
        $product = Product::with('offers')->find($id);

        return view('admin.catalog.offer.index', compact( 'product'));
    }

    public function create($id)
    {
        $product = Product::find($id);
        $currency = Currency::select('currency', 'Name')->get();
        $colors = Color::get();
        return view('admin.catalog.offer.create', compact( 'product', 'currency', 'colors'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['active'] = $request->has('active') ? 1 : 0;
        $data['hit'] = $request->has('hit') ? 1 : 0;
        $data['new'] = $request->has('new') ? 1 : 0;
        $data['stock'] = $request->has('stock') ? 1 : 0;
        $data['advice'] = $request->has('advice') ? 1 : 0;


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


        if($request->img  && Storage::disk('public')->exists(str_replace('storage', '', $request->img))) {
            $pathThumbnail = str_replace('big_', 'thumb_', $request->img);
            Storage::disk('public')->copy(str_replace('storage', '', $request->img), str_replace('storage', '', $pathThumbnail));
            Image::make(storage_path(str_replace('storage', 'app/public', $pathThumbnail)))->fit(100, 100)->save();
            $data['thumbnail'] = $pathThumbnail;
            if(!$request->preview){
                $pathSmall = str_replace('big_', 'small_', $request->img);
                Storage::disk('public')->copy(str_replace('storage', '', $request->img), str_replace('storage', '', $pathSmall));
                Image::make(storage_path(str_replace('storage', 'app/public', $pathSmall)))->resize(350, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save();
                $data['preview'] = $pathSmall;
            }
        }

        $offer = Offer::create($data);

        if($request->image) {
            foreach ($request->image as $image){
                \App\Models\Photo::create([
                    'offer_id' => $offer->id,
                    'img' => $image,
                    'thumbnail' => str_replace('big_', 'small_', $image)
                ]);
            }
        }

        return redirect()->route('offer.list', $offer->product_id )->with('success', 'Новое предложение создано');
    }

    public function edit($id){
        $offer = Offer::find($id);
        //$product = Product::find($id);
        $currency = Currency::select('currency', 'Name')->get();
        $colors = Color::get();


        $img = [];
        $preview = [];
        $images = [];
        if($offer->img && Storage::disk('public')->exists(str_replace('storage', '', $offer->img))){
            $img['path'] = $offer->img;
            $img['src'] = str_replace('storage', 'public', $offer->img);
            $img['name'] = basename($offer->img);
            $img['size'] = Storage::size($img['src']);
        }
        if($offer->preview && Storage::disk('public')->exists(str_replace('storage', '', $offer->preview))){
            $preview['path'] = $offer->preview;
            $preview['src'] = str_replace('storage', 'public', $offer->preview);
            $preview['name'] = basename($offer->preview);
            $preview['size'] = Storage::size($preview['src']);
        }
        if($offer->photos){
            $item=[];
            foreach ($offer->photos as $item){
                $item['path'] = $item->img;
                $item['src'] = str_replace('storage', 'public', $item->img);
                $item['name'] = basename($item->img);
                $item['size'] = Storage::size($item['src']);
                $images[] = $item;
            }
        }
        return view('admin.catalog.offer.update', compact('offer',  'colors', 'currency','img', 'preview', 'images'));
    }

    public function update(ProductRequest $request, $id)
    {
        $offer = Offer::find($id);
        $data = $request->all();
        $data['active'] = $request->has('active') ? 1 : 0;
        $data['hit'] = $request->has('hit') ? 1 : 0;
        $data['new'] = $request->has('new') ? 1 : 0;
        $data['stock'] = $request->has('stock') ? 1 : 0;

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
        $offer->update($data);
        return redirect()->route('offer.list', $offer->product_id )->with('success', 'Данные обновлены');
    }

    public function destroy($id)
    {
        $offer = Offer::with('photos')->find($id);
        $offer->delete();
        return redirect()->route('offer.list', $offer->product_id )->with('success', 'Данные удалены');

        //dd($product->images);
    }

























    //Dropzone.js - загрузка imd и preview изображений при создании нового предложения товара
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


    //Dropzone.js - загрузка images дополнительных изображений при создании нового предложения товара
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
    //Dropzone.js - удаление images дополнительных изображений при создании нового предложения товара
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


    //Dropzone.js  - загрузка imd изображения при обновлении предложения товара
    public function UpdateImgUpload(Request $request)
    {
        $offer = Offer::find($request->id);
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $fileName = time() . '_' . Str::lower(Str::random(2)) . '.' . $image->getClientOriginalExtension();
            $path_to = '/temp/images/' . getfolderName();
            $image->storeAs('public' . $path_to, 'big_'.$fileName);
            $image->storeAs('public' . $path_to, 'thumb_'.$fileName);
            $imgPath = 'storage' . $path_to . '/' . 'big_'.$fileName;
            $pathThumbnail = 'storage' . $path_to . '/' . 'thumb_'.$fileName;
            Image::make(storage_path(str_replace('storage', 'app/public', $pathThumbnail)))->fit(100, 100)->save();
            $offer->img = $imgPath;
            $offer->thumbnail = $pathThumbnail;
            $offer->update();
            return response()->json(['success' => $imgPath]);
        } else {
            return response()->json(['error' => 'Файл не загружен']);
        }

    }

    //Dropzone.js  - загрузка preview изображения при обновлении предложения товара
    public function UpdatePreviewUpload(Request $request)
    {
        $offer = Offer::find($request->id);
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $fileName = 'small_'.time() . '_' . Str::lower(Str::random(2)) . '.' . $image->getClientOriginalExtension();
            $path_to = '/temp/images/' . getfolderName();
            $image->storeAs('public' . $path_to, $fileName);
            $prevPath = 'storage' . $path_to . '/' . $fileName;
            Image::make(storage_path('app/public' . $path_to . '/' . $fileName))->resize(350, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
            $offer->preview = $prevPath;
            $offer->update();
            return response()->json(['success' => $prevPath]);
        } else {
            return response()->json(['error' => 'Файл не загружен']);
        }
    }

    //Dropzone.js - загрузка images дополнительных изображений при обновлении предложения товара
    public function UpdateImagesUpload(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time().'_'.Str::lower(Str::random(2)).'.'.$image->getClientOriginalExtension();
            $fileBigName = 'big_'.$fileName;
            $fileSmallName = 'thumb_'.$fileName;
            $path_to = '/temp/images/'.getfolderName();
            $image->storeAs('public'.$path_to, $fileBigName);
            $image->storeAs('public'.$path_to, $fileSmallName);
            Image::make(storage_path('app/public'.$path_to.'/'.$fileSmallName))->fit(100, 100)->save();
            $imgPath = 'storage'.$path_to.'/'.$fileBigName;
            \App\Models\Photo::create([
                'offer_id' => $request->product_id,
                'img' => $imgPath,
                'thumbnail' => str_replace('big_', 'small_', $imgPath)
            ]);
            return response()->json(['success'=>$imgPath]);
        }else {
            return response()->json(['error' => 'Файл не загружен']);
        }


    }
    //Dropzone.js  - удаление основного (img и thumbnail) или preview изображения при обновлении предложения товара
    public function UpdateImgRemove(Request $request)
    {
        $offer = Offer::find($request->id);
        if($request->type == 'img'){
            if (Storage::disk('public')->exists(str_replace('storage', '', $product->img))){
                Storage::disk('public')->delete(str_replace('storage', '', $product->img));
            }
            if (Storage::disk('public')->exists(str_replace('storage', '', $product->thumbnail))){
                Storage::disk('public')->delete(str_replace('storage', '', $product->thumbnail));
            }
        }
        if($request->type == 'preview'){
            if (Storage::disk('public')->exists(str_replace('storage', '', $product->preview))){
                Storage::disk('public')->delete(str_replace('storage', '', $product->preview));
            }
        }
    }

    //Dropzone.js  - удаление файлов images дополнительных изображений обновлении товара
    public function UpdateImagesRemove(Request $request)
    {
        $path = str_replace('/storage', 'storage', $request->path);
        $offer = \App\Models\Offer::where('offer_id', $request->offer_id)->where('img', $path)->first();
        if (Storage::disk('public')->exists(str_replace('storage', '', $offer->img))){
            Storage::disk('public')->delete(str_replace('storage', '', $offer->img));
        }
        if (Storage::disk('public')->exists(str_replace('storage', '', $offer->thumbnail))){
            Storage::disk('public')->delete(str_replace('storage', '', $offer->thumbnail));
        }
        $offer->delete();
        return response()->json(['success'=>'Файл удален']);
    }

}
