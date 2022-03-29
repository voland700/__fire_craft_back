<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;



class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all()->sortBy('sort');
        return view('admin.content.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.content.slider.create');
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
            'name.required' => 'Поле "Наименование" обязательно для заполнения',
            'sort.integer' => 'Номер сортровки должен быть целым числом'
        ];
        $this->validate($request, [
            'name' => 'required',
            'sort' => 'integer|nullable'
        ],$messages);
        $slider = new Slider($request->all());
        $slider->active=$request->has('active') ? 1 : 0;
        $slider->save();
        return redirect()->route('slider.index')->with('success', 'Новй слайд создан');
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
        $slide = Slider::find($id);
        $img=[];
        if($slide->img && Storage::disk('public')->exists(str_replace('storage', '', $slide->img))){
            $img['path'] = $slide->img;
            $img['src'] = str_replace('storage', 'public', $slide->img);
            $img['name'] = basename($slide->img);
            $img['size'] = Storage::size($img['src']);
        }
        return view('admin.content.slider.update', compact('slide', 'img'));
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
            'name.required' => 'Поле "Наименование" обязательно для заполнения',
            'sort.integer' => 'Номер сортровки должен быть целым числом'
        ];
        $this->validate($request, [
            'name' => 'required',
            'sort' => 'integer|nullable'
        ],$messages);
        $slide = Slider::find($id);
        $data = $request->all();
        $data['active']=$request->has('active') ? 1 : 0;
        $slide->update($data);
        return redirect()->route('slider.index')->with('success', 'Данные обновлены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slide = Slider::find($id);
        if (Storage::disk('public')->exists(str_replace('storage', '', $slide->img))){
            Storage::disk('public')->delete(str_replace('storage', '', $slide->img));
        }
        $slide->delete();
        return redirect()->route('slider.index')->with('success', 'Слайд удален');
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
        $slide = Slider::find($request->id);
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $fileName = time().'_'.Str::lower(Str::random(5)).'.'.$image->getClientOriginalExtension();
            $path_to = '/images/'.getfolderName();
            $image->storeAs('public'.$path_to, $fileName);
            $imgPath = 'storage'.$path_to.'/'.$fileName;
            Image::make(storage_path('app/public'.$path_to.'/'.$fileName))->save();
            $slide->img = $imgPath;
            $slide->save();
        }
        return response()->json(['success'=>$imgPath]);
    }

    public function imgRemoveForUpdate(Request $request)
    {
        $slide = Slider::find($request->id);
        if (Storage::disk('public')->exists(str_replace('storage', '', $request->path))){
            Storage::disk('public')->delete(str_replace('storage', '', $request->path));
        }
        $slide->img = null;
        $slide->save();
        return response()->json(['success'=>200]);
    }

}
