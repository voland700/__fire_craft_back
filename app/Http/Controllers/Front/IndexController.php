<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Product;

class IndexController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('active', 1)->orderBy('sort')->get();
        $favoriteCategories = Category::where('active', 1)->where('main', 1)->orderBy('sort')->select(['id','name', 'slug', 'img'])->get();
        $advices =  Product::with('discount', 'offers')->where([['advice', 1],['active', 1]])->select('id','name', 'slug', 'active', 'hit', 'new', 'stock', 'advice', 'preview', 'base_price', 'price', 'currency' )->inRandomOrder()->take(8)->get();

        $advicesProducts = $advices->each(function ($item) {
            if(!$item->offers->isEmpty()){
                $item->offers->each(function ($itemOffer){
                    $itemOffer = getPrice($itemOffer);
                });
            }
            $item = getPrice($item);
            return $item;
        });

        //dd($advicesProducts);

        return view('front.index', compact('sliders', 'favoriteCategories', 'advicesProducts'));





    }
}
