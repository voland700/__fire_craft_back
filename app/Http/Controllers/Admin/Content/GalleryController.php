<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::all()->sortBy('sort');
        return view('admin.content.gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.content.gallery.create');
    }

    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Поле "Наименование" обязательно для заполнения',
            'sort.integer' => 'Номер сортровки должен быть целым числом'
        ];
        $this->validate($request, [
            'name' => 'required',
            'sort' => 'integer|nullable'
        ],$messages);
        $gallery = new Gallery($request->all());
        $gallery->active=$request->has('active') ? 1 : 0;
        $gallery->save();
        return redirect()->route('gallery.index')->with('success', 'Новй слайд создан');
    }

    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $gallery = Gallery::find($id);
        $img=[];
        if($gallery->img && Storage::disk('public')->exists(str_replace('storage', '', $gallery->img))){
            $img['path'] = $gallery->img;
            $img['src'] = str_replace('storage', 'public', $gallery->img);
            $img['name'] = basename($gallery->img);
            $img['size'] = Storage::size($img['src']);
        }
        return view('admin.content.gallery.update', compact('gallery', 'img'));
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'name.required' => 'Поле "Наименование" обязательно для заполнения',
            'sort.integer' => 'Номер сортровки должен быть целым числом'
        ];
        $this->validate($request, [
            'name' => 'required',
            'sort' => 'integer|nullable'
        ],$messages);
        $gallery = Gallery::find($id);
        $data = $request->all();
        $data['active']=$request->has('active') ? 1 : 0;
        $gallery->update($data);
        return redirect()->route('gallery.index')->with('success', 'Данные обновлены');
    }

    public function destroy($id)
    {
        $gallery = Gallery::find($id);
        if (Storage::disk('public')->exists(str_replace('storage', '', $gallery->img))){
            Storage::disk('public')->delete(str_replace('storage', '', $gallery->img));
        }
        $gallery->delete();
        return redirect()->route('gallery.index')->with('success', 'Слайд удален');
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
        $gallery = Gallery::find($request->id);
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $fileName = time().'_'.Str::lower(Str::random(5)).'.'.$image->getClientOriginalExtension();
            $path_to = '/images/'.getfolderName();
            $image->storeAs('public'.$path_to, $fileName);
            $imgPath = 'storage'.$path_to.'/'.$fileName;
            Image::make(storage_path('app/public'.$path_to.'/'.$fileName))->save();
            $gallery->img = $imgPath;
            $gallery->save();
        }
        return response()->json(['success'=>$imgPath]);
    }

    public function imgRemoveForUpdate(Request $request)
    {
        $gallery = Gallery::find($request->id);
        if (Storage::disk('public')->exists(str_replace('storage', '', $request->path))){
            Storage::disk('public')->delete(str_replace('storage', '', $request->path));
        }
        $gallery->img = null;
        $gallery->save();
        return response()->json(['success'=>200]);
    }
}
