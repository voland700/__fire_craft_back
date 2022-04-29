<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Category;
use App\Models\Product;
use App\Models\Dealer;
use App\Models\Region;


class SitemapController extends Controller
{
    public function createSitemap()
    {
        $path = public_path() . '/sitemap.xml';
        $res = Sitemap::create();

        // Главная
        $res->add(
            Url::create(route('index'))
                //->setLastModificationDate(null)
                ->setChangeFrequency('daily')
                ->setPriority(0.8)
        );
        // Каталог - категории
        $res->add('/catalog');
        $categories = Category::where('active', 1)->select('id', 'slug', 'updated_at')->get();
        foreach ($categories as $category) {
            $res->add(
                Url::create(route('catalog.category', $category->slug))
                    ->setLastModificationDate(Carbon::parse($category->updated_at))
                    ->setChangeFrequency('daily')
                    ->setPriority(0.8)
            );
        }
        // Товары
        $products = Product::where('active', 1)->select('id', 'slug', 'updated_at')->get();
        foreach ($products as $product) {
            $res->add(
                Url::create(route('catalog.product', $product->slug))
                    ->setLastModificationDate(Carbon::parse($product->updated_at))
                    ->setChangeFrequency('daily')
                    ->setPriority(0.8)
            );
        }
        // дилеры - регионы
        $res->add('/dealers');
        $regions = Region::select('id', 'item', 'updated_at')->get();
        foreach ($regions as $region) {
            $res->add(
                Url::create(route('dealer.region', $region->item))
                    ->setLastModificationDate(Carbon::parse($region->updated_at))
                    ->setChangeFrequency('daily')
                    ->setPriority(0.8)
            );
        }
        // Дилеры
        $dealers = Dealer::where('active', 1)->select('id', 'slug', 'updated_at')->get();
        foreach ($dealers as $dealer) {
            $res->add(
                Url::create(route('dealer.detail', $dealer->slug))
                    ->setLastModificationDate(Carbon::parse($dealer->updated_at))
                    ->setChangeFrequency('daily')
                    ->setPriority(0.8)
            );
        }
        // О компании
        $res->add('/about');
        // Контакты
        $res->add('/contacts');
        // Вопросы
        $res->add('/questions');
        // Гарантия
        $res->add('/guarantee');
        // Доставка
        $res->add('/delivery');
        //Информация
        $res->add('/information');
        // Статья
        $res->add('/why-iron');
        // Статья
        $res->add('/see-all');
        // Статья
        $res->add('/first-ignition');
        $res->writeToFile($path);
        return $res;
    }
}
