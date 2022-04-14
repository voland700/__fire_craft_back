<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Dealer;
use App\Http\Requests\PropertyRequest;

class DealerController extends Controller
{
    public function index()
    {
        $dealers = Dealer::with(
            ['region' => function($q){$q->select('id','name'); }]
        )->select('id', 'name', 'active', 'region_id')->paginate(40);
        //dd($dealers);
        return view('admin.content.dealer.index', compact('dealers'));
    }

    public function create()
    {
        $regions = Region::select('id', 'name')->get();
        return view('admin.content.dealer.create', compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyRequest $request)
    {
        $data = $request->all();
        $data['active'] = $request->has('active') ? 1 : 0;
        Dealer::create($data);
        return redirect()->route('dealer.index')->with('success', 'Новй дилер добавлен');
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
        $dealer = Dealer::find($id);
        $regions = Region::select('id', 'name')->get();
        return view('admin.content.dealer.update', compact('regions', 'dealer'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyRequest $request, $id)
    {
        $dealer = Dealer::find($id);
        $data = $request->all();
        $data['active'] = $request->has('active') ? 1 : 0;
        $dealer->update($data);
        return redirect()->route('dealer.index')->with('success', 'Данные партнера обновлены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dealer = Dealer::find($id);
        $dealer->delete();
        return redirect()->route('dealer.index')->with('success', 'региональный дилер удален');
    }
}
