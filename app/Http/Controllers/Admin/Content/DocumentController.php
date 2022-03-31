<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentRequest;
use App\Models\Document;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Document::paginate(40);
        return view('admin.content.document.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.document.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentRequest $request)
    {
        $document = new Document($request->all());
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName =  time().'_'.Str::lower(Str::random(2)).'.'.$file->getClientOriginalExtension();
            $path_to = '/upload/documents/'.getfolderName();
            $file->storeAs('public'.$path_to, $fileName);
            $document->file = 'storage'.$path_to.'/'.$fileName;
        }
        $document->save();
        return redirect()->route('document.index')->with('success', 'Файл загружен');
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
        $document = Document::find($id);
        return view('admin.content.document.update', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentRequest $request, $id)
    {
        $document = Document::find($id);
        $data = $request->all();
        if ($request->hasFile('file')) {
            if (Storage::disk('public')->exists(str_replace('storage', '', $document->file))){
                Storage::disk('public')->delete(str_replace('storage', '', $document->file));
            }
            $file = $request->file('file');
            $fileName =  time().'_'.Str::lower(Str::random(2)).'.'.$file->getClientOriginalExtension();
            $path_to = '/upload/documents/'.getfolderName();
            $file->storeAs('public'.$path_to, $fileName);
            $data['file']='storage'.$path_to.'/'.$fileName;
        }
        $document->update($data);
        return redirect()->route('documents.index')->with('success', 'Данные обновлены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document = Document::find($id);
        if (Storage::disk('public')->exists(str_replace('storage', '', $document->file))){
            Storage::disk('public')->delete(str_replace('storage', '', $document->file));
        }
        $document->delete();
        return redirect()->route('document.index')->with('success', 'Документ удален');
    }
}
