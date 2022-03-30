<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Color::all();
        return view('admin.catalog.color.index', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.catalog.color.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Поле "Название цвета" обязательно для заполнения',
            'file.required' => 'Изобразение миниатюры - обязательно',
            'file.image' => 'Миниатюра - должна быть файлом c изображением',
            'file.mimes' => 'Фал с изображением должен иметь расширение: jpeg,jpg,bmp,png',
            'file.size' => 'Размер изображения не должен превышать 2 мб.',
        ];
        $this->validate($request, [
            'name' => 'required',
            'file' => 'image|mimes:jpeg,jpg,bmp,png|required',
            'file.size' => '2048',
        ],$messages);
        $image = $request->file('file');
        $fileName = $image->getClientOriginalName();//.'.'.$image->getClientOriginalExtension();
        $path_to = '/images/color';
        $image->storeAs('public'.$path_to, $fileName);
        $imgPath = 'storage'.$path_to.'/'.$fileName;
        $color = Color::create([
            'name' => $request->name,
            'file' => $imgPath
        ]);
        return redirect()->route('color.index')->with('success', 'Новй элемент создан');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $color = Color::find($id);
        return view('admin.catalog.color.update', compact('color'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $color = Color::find($id);
        return view('admin.catalog.color.update', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'name.required' => 'Поле "Название цвета" обязательно для заполнения',
            'file.required' => 'Изобразение миниатюры - обязательно',
            'file.image' => 'Миниатюра - должна быть файлом c изображением',
            'file.mimes' => 'Фал с изображением должен иметь расширение: jpeg,jpg,bmp,png',
            'file.size' => 'Размер изображения не должен превышать 2 мб.',
        ];
        $this->validate($request, [
            'name' => 'required',
            'file' => 'image|mimes:jpeg,jpg,bmp,png',
            'file.size' => '2048',
        ],$messages);
        $color = Color::find($id);
        $color->name = $request->name;
        if ($request->hasFile('file')) {
            if (Storage::disk('public')->exists(str_replace('storage', '', $color->file))){
                Storage::disk('public')->delete(str_replace('storage', '', $color->file));
            }
            $image = $request->file('file');
            $fileName = $image->getClientOriginalName();
            $path_to = '/images/color';
            $image->storeAs('public'.$path_to, $fileName);
            $imgPath = 'storage'.$path_to.'/'.$fileName;
            $color->file = $imgPath;
        }
        $color->save();
        return redirect()->route('color.index')->with('success', 'Элемент обновлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $color = Color::find($id);
        if (Storage::disk('public')->exists(str_replace('storage', '', $color->file))){
            Storage::disk('public')->delete(str_replace('storage', '', $color->file));
        }
        $color->delete();
        return redirect()->route('color.index')->with('success', 'Цвет товара удален');
    }
}
