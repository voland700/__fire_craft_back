<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Кэш очищен.";
})->name('clear.cash');


Route::group(['prefix' => 'admin'], function () {

    Route::get('/', [\App\Http\Controllers\Admin\MainController::class, 'index'])->name('admin.index');
    Route::post('/drop-remove-file',[\App\Http\Controllers\Admin\DropzoneController::class, 'removeOne'])->name('dropzone.remove.one');

    Route::resource('/slider', \App\Http\Controllers\Admin\Content\SliderController::class);
    Route::post('/slider-img-upload',[\App\Http\Controllers\Admin\Content\SliderController::class, 'imgUpload'])->name('slider.img.upload');
    Route::post('/slider-img-update',[\App\Http\Controllers\Admin\Content\SliderController::class, 'imgUpdate'])->name('slider.img.update');
    Route::post('/slider-img-update-remove',[\App\Http\Controllers\Admin\Content\SliderController::class, 'imgRemoveForUpdate'])->name('slider.img.remove');

    Route::resource('/document', \App\Http\Controllers\Admin\Content\DocumentController::class);


    Route::resource('/category', \App\Http\Controllers\Admin\Catalog\CategoryController::class);

    Route::post('/category-img-upload',[\App\Http\Controllers\Admin\Catalog\CategoryController::class, 'imgUpload'])->name('category.img.upload');
    Route::post('/category-img-update',[\App\Http\Controllers\Admin\Catalog\CategoryController::class, 'imgUpdate'])->name('category.img.update');
    Route::post('/category-img-update-remove',[\App\Http\Controllers\Admin\Catalog\CategoryController::class, 'imgRemoveForUpdate'])->name('category.img.remove');
    Route::post('/category-thumb-update',[\App\Http\Controllers\Admin\Catalog\CategoryController::class, 'thumbUpdate'])->name('category.thumb.update');
    Route::post('/category-thumb-update-remove',[\App\Http\Controllers\Admin\Catalog\CategoryController::class, 'thumbRemoveForUpdate'])->name('category.thumb.remove');

    Route::get('/currency', [\App\Http\Controllers\Admin\Catalog\CurrencyController::class, 'index'])->name('currency.index');
    Route::get('/get-currency', [\App\Http\Controllers\Admin\Catalog\CurrencyController::class, 'get'])->name('get_currency');
    Route::get('/update-prices', [\App\Http\Controllers\Admin\Catalog\CurrencyController::class, 'updatePrices'])->name('update_prices');

    Route::resource('/color', \App\Http\Controllers\Admin\Catalog\ColorController::class);
    Route::resource('/property', \App\Http\Controllers\Admin\Catalog\PropertyController::class);

    //Product
    Route::get('/product-list/{id?}', [\App\Http\Controllers\Admin\Catalog\ProductController::class, 'list'])->name('product.list');
    Route::get('/product-create/{id?}', [\App\Http\Controllers\Admin\Catalog\ProductController::class, 'create'])->name('product.create');
    Route::post('/product-store', [\App\Http\Controllers\Admin\Catalog\ProductController::class, 'store'])->name('product.store');
    Route::get('/product-edit/{id}', [\App\Http\Controllers\Admin\Catalog\ProductController::class, 'edit'])->name('product.edit');
    Route::match(['put', 'patch'],'/product-update/{id}', [\App\Http\Controllers\Admin\Catalog\ProductController::class, 'update'])->name('product.update');
    Route::delete('/product-destroy/{id}', [\App\Http\Controllers\Admin\Catalog\ProductController::class, 'destroy'])->name('product.destroy');
    //Product - upload, create images -dropzone uploader
    Route::post('/product-upload-img', [\App\Http\Controllers\Admin\Catalog\ProductController::class, 'CreateImgUpload'])->name('product.upload.img');
    Route::post('/product-upload-images', [\App\Http\Controllers\Admin\Catalog\ProductController::class, 'CreateImagesUpload'])->name('product.upload.images');
    Route::post('/product-upload-images-remove', [\App\Http\Controllers\Admin\Catalog\ProductController::class, 'CreateImagesRemove'])->name('product.create.images.remove');
    //Product - update, images -dropzone uploader
    Route::post('/product-update-img', [\App\Http\Controllers\Admin\Catalog\ProductController::class, 'UpdateImgUpload'])->name('product.update.img');
    Route::post('/product-update-preview', [\App\Http\Controllers\Admin\Catalog\ProductController::class, 'UpdatePreviewUpload'])->name('product.update.preview');
    Route::post('/product-update-images', [\App\Http\Controllers\Admin\Catalog\ProductController::class, 'UpdateImagesUpload'])->name('product.update.images');
    Route::post('/product-update-img-remove', [\App\Http\Controllers\Admin\Catalog\ProductController::class, 'UpdateImgRemove'])->name('product.update.img.remove');
    Route::post('/product-update-images-remove', [\App\Http\Controllers\Admin\Catalog\ProductController::class, 'UpdateImagesRemove'])->name('product.update.images.remove');

    //Offer
    Route::get('/offer-list/{id}', [\App\Http\Controllers\Admin\Catalog\OfferController::class, 'list'])->name('offer.list');
    Route::get('/offer-create/{id}', [\App\Http\Controllers\Admin\Catalog\OfferController::class, 'create'])->name('offer.create');
    Route::post('/offer-store', [\App\Http\Controllers\Admin\Catalog\OfferController::class, 'store'])->name('offer.store');
    Route::get('/offer-edit/{id}', [\App\Http\Controllers\Admin\Catalog\OfferController::class, 'edit'])->name('offer.edit');
    Route::match(['put', 'patch'],'/offer-update/{id}', [\App\Http\Controllers\Admin\Catalog\OfferController::class, 'update'])->name('offer.update');
    Route::delete('/offer-destroy/{id}', [\App\Http\Controllers\Admin\Catalog\OfferController::class, 'destroy'])->name('offer.destroy');
    //Offer - upload, create images -dropzone uploader
    Route::post('/offer-upload-img', [\App\Http\Controllers\Admin\Catalog\OfferController::class, 'CreateImgUpload'])->name('offer.upload.img');
    Route::post('/offer-upload-images', [\App\Http\Controllers\Admin\Catalog\OfferController::class, 'CreateImagesUpload'])->name('offer.upload.images');
    Route::post('/offer-upload-images-remove', [\App\Http\Controllers\Admin\Catalog\OfferController::class, 'CreateImagesRemove'])->name('offer.create.images.remove');
    //Offer - update, images (photo)-dropzone uploader
    Route::post('/offer-update-img', [\App\Http\Controllers\Admin\Catalog\OfferController::class, 'UpdateImgUpload'])->name('offer.update.img');
    Route::post('/offer-update-preview', [\App\Http\Controllers\Admin\Catalog\OfferController::class, 'UpdatePreviewUpload'])->name('offer.update.preview');
    Route::post('/offer-update-images', [\App\Http\Controllers\Admin\Catalog\OfferController::class, 'UpdateImagesUpload'])->name('offer.update.images');
    Route::post('/offer-update-img-remove', [\App\Http\Controllers\Admin\Catalog\OfferController::class, 'UpdateImgRemove'])->name('offer.update.img.remove');
    Route::post('/offer-update-images-remove', [\App\Http\Controllers\Admin\Catalog\OfferController::class, 'UpdateImagesRemove'])->name('offer.update.images.remove');


    //Discount
    Route::resource('discounts', \App\Http\Controllers\Admin\Catalog\DiscountController::class);
    Route::post('/discounts-goods-create', [\App\Http\Controllers\Admin\Catalog\DiscountController::class, 'choice_goods_create'])->name('discounts.goods.create');
    Route::post('/discounts_choice_categories', [\App\Http\Controllers\Admin\Catalog\DiscountController::class, 'choice_categories'])->name('discounts.choice.categories');
    Route::get('/discounts_create_paginate', [\App\Http\Controllers\Admin\Catalog\DiscountController::class, 'create_paginate'])->name('discounts.create.paginate');
    Route::post('/discounts_goods_update', [\App\Http\Controllers\Admin\Catalog\DiscountController::class, 'choice_goods_update'])->name('discounts.goods.update');

    Route::post('/discounts_choice_categories_up', [\App\Http\Controllers\Admin\Catalog\DiscountController::class, 'choice_categories_update'])->name('discounts.choice.categories.update');
    Route::post('/discounts_update_paginate', [\App\Http\Controllers\Admin\Catalog\DiscountController::class, 'update_paginate'])->name('discounts.update.paginate');

    //Export Data
    Route::get('/product-price-export', [\App\Http\Controllers\Admin\Catalog\ExportController::class, 'productsPriceExportShow'])->name('product.price.export.show');
    Route::post('/product-price-export', [\App\Http\Controllers\Admin\Catalog\ExportController::class, 'productsPriceExport'])->name('product.price.export');

    Route::get('/offer-price-export', [\App\Http\Controllers\Admin\Catalog\ExportController::class, 'offersPriceExportShow'])->name('offer.price.export.show');
    Route::post('/offer-price-export', [\App\Http\Controllers\Admin\Catalog\ExportController::class, 'offersPriceExport'])->name('offer.price.export');





});







