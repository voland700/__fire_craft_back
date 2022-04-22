<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dealer;
use App\Models\Region;
use App\Models\Product;
use App\Models\Offer;

class DealerController extends Controller
{
    public function list()
    {
        $dealers = Dealer::with('region')->where('active', '=', 1)->orderBy('sort')->paginate(24);
        $ForRegions = Region::select('id', 'item', 'name')->get();

        $ForMap = Region::whereHas('dealers')->with('dealers')->get();//->toArray();
        $data = [];
        foreach ($ForMap as $reg){
            $data[$reg->item] = [];

            foreach ($reg->dealers as $deal){
                array_push(  $data[$reg->item], $deal['name']);
            }

        }
        //$data = json_encode($data, JSON_UNESCAPED_UNICODE);

        $regions = [];
        foreach ($ForRegions as $regItem){
            $item = [];
            $item['item'] = $regItem->item;
            $item['name'] = $regItem->name;
            array_push(  $regions, $item);
        }
        //$regions = json_encode($regions, JSON_UNESCAPED_UNICODE);

        //dd($regions);
        //dd($data);
        //dd(json_encode($data, JSON_UNESCAPED_UNICODE));
        return view('front.dealer.list', compact( 'regions', 'dealers', 'data'));




    }
}
