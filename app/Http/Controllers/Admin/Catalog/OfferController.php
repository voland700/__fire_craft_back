<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Currency;
use App\Models\Product;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function list($id)
    {
        $product = Product::with('offers')->find($id);

        return view('admin.catalog.offer.index', compact( 'product'));
    }

    public function create($id)
    {
        $product = Product::find($id);
        $currency = Currency::select('currency', 'Name')->get();
        $colors = Color::get();
        return view('admin.catalog.offer.create', compact( 'product', 'currency', 'colors'));
    }
}
