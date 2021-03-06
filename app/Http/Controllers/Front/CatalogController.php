<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Offer;

class CatalogController extends Controller
{
    public function index()
    {
        $categories = Category::where([['active', '=', 1], ['parent_id', '=', null]])->orderBy('sort')->select('id', 'active', 'name', 'slug', 'sort', 'img', 'thumbnail')->get();
        $products = Product::with('discount', 'offers')->where('active', 1)->orderBy('sort')->paginate(24);
        addDataPriceAll($products);
        return view('front.catalog.index', compact( 'categories', 'products'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $categories = $category->children;
        $categoriesId = $category->descendants()->pluck('id');
        $categoriesId[] = $category->getKey();
        $products = Product::with('discount', 'offers')->whereIn('category_id', $categoriesId)->where('active', 1)->orderBy('sort')->paginate(24);
        addDataPriceAll($products);
        return view('front.catalog.category', compact( 'categories', 'category','products'));
    }

    public function product($slug)
    {
        $product = Product::with('discount', 'offers', 'images', 'documents')->where([['active', 1], ['slug', $slug]])->firstOrFail();
        $category = Category::where('id', $product->category_id)->firstOrFail();
        $brand = null;
        if($product->properties){
            $product->properties = json_decode($product->properties);
            foreach ($product->properties as $prop){
              if($prop->name == 'Бренд:' || $prop->name == 'Бренд'){
                    $brand = $prop->value;
                    break;
                }
            }
        }
        addDataPriceItem($product);

        if($product->offers->isEmpty()){
            $offer = null;
        }else{
            $offer = $product->offers->sortBy('sort')->first();
            //getPrice($offer);
        }
        //dd($brand);
        return view('front.catalog.product', compact('product', 'category', 'offer', 'brand'));
    }

    public function getOfferList(Request $request)
    {
        $product =  Product::with('discount', 'offers')->select('id','name', 'slug')->find($request->product_id);

        $product->offers->each(function ($itemOffer){
            $itemOffer = getPrice($itemOffer);
        });
        $offer = $product->offers->where('id', $request->offer_id)->first();
        return view('front.catalog.offer_list', compact('product', 'offer'));
    }

    public function getOfferProduct(Request $request)
    {
        $offer = Offer::with('photos')->find($request->offer);
        return view('front.catalog.offer_product', compact('offer'));
    }

    public function typeaheadSearch(Request $request)
    {
        $dbQuery = $request->get('q');
        $output = Product::where('name', 'LIKE', '%'. $dbQuery. '%')->get();
        return response()->json($output);
    }

    public function search(Request $request)
    {
        $q = $request->q;
        $request->validate([
            'q' => 'required',
        ]);
        $products = Product::where('name', 'LIKE', '%'. $q. '%')->with('discount', 'offers')->where('active', 1)->orderBy('sort')->paginate(24);
        addDataPriceAll($products);
        return view('front.catalog.search', compact('products', 'q'));
    }



}
