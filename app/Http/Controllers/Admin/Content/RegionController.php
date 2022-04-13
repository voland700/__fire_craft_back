<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Requests\RegionRequest;



class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::paginate(40);
        return view('admin.content.region.index', compact('regions'));
    }

    public function create()
    {
        return view('admin.content.region.create');
    }

    public function store(RegionRequest $request)
    {
        $region = new Region($request->all());
        $region->save();
        return redirect()->route('region.index')->with('success', 'Новй регион добавлен');
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
        $region = Region::find($id);
        return view('admin.content.region.update', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RegionRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
