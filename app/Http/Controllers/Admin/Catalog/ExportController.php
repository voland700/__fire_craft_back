<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use App\Models\Offer;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PriceProductExport;
//use App\Exports\OffersExport;

class ExportController extends Controller
{

    public function productsPriceExportShow()
    {
        $categories = Category::get()->toTree();
        return view('admin.catalog.export.product_price', compact('categories'));
    }

    public function productsPriceExport(Request $request)
    {
        $products = [];
        $fileName = 'export_price_'.preg_replace("/[^,.0-9]/", '',  \Carbon\Carbon::now()->toDateTimeString());

        while (true) {
            if(!$request->category_id && !isset($request->all)){
                return redirect()->route('product.price.export.show')->with('error', 'Не выбраны категории товаров для экспорта');
            } elseif (isset($request->all)){
                $products = Product::with(
                    ['category' => function($q){$q->select('id','name'); }]
                )->select('id', 'name', 'active', 'art_number', 'category_id', 'base_price', 'currency')->get()->toArray();
                break;
            } elseif ($request->category_id && isset($request->nested)){
                $categoriesId = [];
                foreach ($request->category_id as $id){
                    $arrId = Category::descendantsAndSelf($id)->pluck('id');
                    array_push($categoriesId, $arrId);
                }
                $categoriesId = array_unique(Arr::collapse($categoriesId));
                $products = Product::with(
                    ['category' => function($q){$q->select('id','name'); }]
                )->whereIn('category_id', $categoriesId)->select('id', 'name', 'active', 'art_number', 'category_id', 'base_price', 'currency')->get()->toArray();
                break;
            } else {
                $categoriesId = array_map('intval', $request->category_id);
                $products = Product::with(
                    ['category' => function($q){$q->select('id','name'); }]
                )->whereIn('category_id', $categoriesId)->select('id', 'name', 'active', 'art_number', 'category_id', 'base_price', 'currency', 'source')->get()->toArray();
            }
            break;
        }
        //$export = new PriceProductExport($products);
        //return Excel::download($export, $fileName.'.xlsx');

        dd($products);
    }






}
