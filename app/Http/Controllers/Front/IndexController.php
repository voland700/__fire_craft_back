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

        return view('front.index', compact('sliders', ));
       //dd($sliders);




    }
}
