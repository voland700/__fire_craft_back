<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Offer;

class CatalogController extends Controller
{

    public function getOfferList(Request $request)
    {
        $product =  Product::with('discount', 'offers')->select('id','name', 'slug')->find($request->product_id);

        $product->offers->each(function ($itemOffer){
            $itemOffer = getPrice($itemOffer);
        });
        $offer = $product->offers->where('id', $request->offer_id)->first();
        return view('front.catalog.offer_list', compact('product', 'offer'));
    }
}
