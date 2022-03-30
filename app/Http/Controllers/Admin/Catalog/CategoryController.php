<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('sort')->get()->toTree();
        $delimiter = '–&nbsp;';
        return view('admin.catalog.category.index', compact('categories', 'delimiter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get()->toTree();
        return view('admin.catalog.category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category=new Category($request->all());
        $category->active=$request->has('active') ? 1 : 0;
        $category->main=$request->has('main') ? 1 : 0;
        $category::fixTree();
        $category->save();
        return redirect()->route('category.index')->with('success', 'Новая категория создана');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $categories = Category::get()->toTree();
        $img=[];
        $thumbnail=[];
        if($category->img && Storage::disk('public')->exists(str_replace('storage', '', $category->img))){
            $img['path'] = $category->img;
            $img['src'] = str_replace('storage', 'public', $category->img);
            $img['name'] = basename($category->img);
            $img['size'] = Storage::size($img['src']);
        }
        if($category->thumbnail && Storage::disk('public')->exists(str_replace('storage', '', $category->thumbnail))){
            $thumbnail['path'] = $category->thumbnail;
            $thumbnail['src'] = str_replace('storage', 'public', $category->thumbnail);
            $thumbnail['name'] = basename($category->thumbnail);
            $thumbnail['size'] = Storage::size($thumbnail['src']);
        }
        return view('admin.catalog.category.update', compact('category', 'categories', 'id', 'img', 'thumbnail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::find($id);
        $data = $request->all();
        $data['active']=$request->has('active') ? 1 : 0;
        $data['main']=$request->has('main') ? 1 : 0;
        $category->update($data);
        $category::fixTree();
        return redirect()->route('category.index')->with('success', 'Данные обновлены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if (Storage::disk('public')->exists(str_replace('storage', '', $category->img))){
            Storage::disk('public')->delete(str_replace('storage', '', $category->img));
        }
        if (Storage::disk('public')->exists(str_replace('storage', '', $category->thumbnail))){
            Storage::disk('public')->delete(str_replace('storage', '', $category->thumbnail));
        }
        $category->delete();
        $category::fixTree();
        return redirect()->route('category.index')->with('success', 'Категория удалена');
    }

    public function imgUpload(Request $request)
    {
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $fileName = time().'_'.Str::lower(Str::random(5)).'.'.$image->getClientOriginalExtension();
            $path_to = '/images/'.getfolderName();
            $image->storeAs('public'.$path_to, $fileName);
            $imgPath = 'storage'.$path_to.'/'.$fileName;
            Image::make(storage_path('app/public'.$path_to.'/'.$fileName))->save();
        }
        return response()->json(['success'=>$imgPath]);
    }

    public function imgUpdate(Request $request)
    {
        $category = Category::find($request->id);
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $fileName = time().'_'.Str::lower(Str::random(5)).'.'.$image->getClientOriginalExtension();
            $path_to = '/images/'.getfolderName();
            $image->storeAs('public'.$path_to, $fileName);
            $imgPath = 'storage'.$path_to.'/'.$fileName;
            Image::make(storage_path('app/public'.$path_to.'/'.$fileName))->save();
            $category->img = $imgPath;
            $category->save();
        }
        return response()->json(['success'=>$imgPath]);
    }

    public function imgRemoveForUpdate(Request $request)
    {
        $category = Category::find($request->id);
        if (Storage::disk('public')->exists(str_replace('storage', '', $request->path))){
            Storage::disk('public')->delete(str_replace('storage', '', $request->path));
        }
        $category->img = null;
        $category->save();
        return response()->json(['success'=>200]);
    }


    public function thumbUpdate(Request $request)
    {
        $category = Category::find($request->id);
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $fileName = time().'_'.Str::lower(Str::random(5)).'.'.$image->getClientOriginalExtension();
            $path_to = '/images/'.getfolderName();
            $image->storeAs('public'.$path_to, $fileName);
            $imgPath = 'storage'.$path_to.'/'.$fileName;
            Image::make(storage_path('app/public'.$path_to.'/'.$fileName))->save();
            $category->thumbnail = $imgPath;
            $category->save();
        }
        return response()->json(['success'=>$imgPath]);
    }

    public function thumbRemoveForUpdate(Request $request)
    {
        $category = Category::find($request->id);
        if (Storage::disk('public')->exists(str_replace('storage', '', $request->path))){
            Storage::disk('public')->delete(str_replace('storage', '', $request->path));
        }
        $category->thumbnail = null;
        $category->save();
        return response()->json(['success'=>200]);
    }






}
