<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Document;
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
        $regions = [];
        foreach ($ForRegions as $regItem){
            $item = [];
            $item['item'] = $regItem->item;
            $item['name'] = $regItem->name;
            array_push(  $regions, $item);
        }
        return view('front.dealer.list', compact( 'regions', 'dealers', 'data'));
    }
    public function region($slug)
    {
        $region = Region::where('item', $slug)->first();
        $dealers = Dealer::where([['region_id', '=', $region->id ], ['active', '=', 1]])->orderBy('sort')->paginate(24);
        $products =  Product::whereIn('category_id', [2,3])->where('active', 1)->select('id','name', 'slug', 'active', 'preview')->inRandomOrder()->take(3)->get();
        return view('front.dealer.region', compact( 'region', 'dealers', 'products'));
    }
    public function detail($slug)
    {
        $dealer = Dealer::with('region')->where('slug', $slug)->firstOrFail();
        $products =  Product::whereIn('category_id', [2,3])->where('active', 1)->select('id','name', 'slug', 'active', 'preview')->inRandomOrder()->take(3)->get();
        return view('front.dealer.dealer', compact(  'dealer', 'products'));
    }
}
