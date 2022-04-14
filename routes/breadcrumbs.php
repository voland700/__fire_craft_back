<?php


use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('admin.index', function ($trail) {
$trail->push('Админ', route('admin.index'));
});

// Categories
Breadcrumbs::for('category.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Категории товаров', route('category.index'));
});
Breadcrumbs::for('category.create', function (BreadcrumbTrail $trail) {
    $trail->parent('category.index');
    $trail->push('Новая категория', route('category.create'));
});
Breadcrumbs::for('category.edit', function (BreadcrumbTrail $trail, \App\Models\Category $category) {
    $trail->parent('category.index', $category);
    $trail->push($category->name, route('category.edit', $category));
});
// Currency
Breadcrumbs::for('currency.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Список валют', route('currency.index'));
});

// Offer color
Breadcrumbs::for('color.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Цвета товаров', route('color.index'));
});
Breadcrumbs::for('color.create', function (BreadcrumbTrail $trail) {
    $trail->parent('color.index');
    $trail->push('Новая цвет', route('color.create'));
});
Breadcrumbs::for('color.edit', function (BreadcrumbTrail $trail, \App\Models\Color $color) {
    $trail->parent('color.index', $color);
    $trail->push($color->name, route('color.edit', $color));
});
// Properties
Breadcrumbs::for('property.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Характеристики', route('property.index'));
});
Breadcrumbs::for('property.create', function (BreadcrumbTrail $trail) {
    $trail->parent('property.index');
    $trail->push('Новая характеристика', route('property.create'));
});
Breadcrumbs::for('property.edit', function (BreadcrumbTrail $trail, \App\Models\Property $property) {
    $trail->parent('property.index', $property);
    $trail->push($property->name, route('property.edit', $property));
});
//Documents
Breadcrumbs::for('document.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Документы', route('document.index'));
});
Breadcrumbs::for('document.create', function (BreadcrumbTrail $trail) {
    $trail->parent('document.index');
    $trail->push('Новый документ', route('document.create'));
});
Breadcrumbs::for('document.edit', function (BreadcrumbTrail $trail, \App\Models\Document $document) {
    $trail->parent('document.index', $document);
    $trail->push($document->name, route('document.edit', $document));
});

// Discounts
Breadcrumbs::for('discounts.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Скидки', route('discounts.index'));
});
Breadcrumbs::for('discounts.create', function (BreadcrumbTrail $trail) {
    $trail->parent('discounts.index');
    $trail->push('Новая скидка', route('discounts.create'));
});
Breadcrumbs::for('discounts.edit', function (BreadcrumbTrail $trail, \App\Models\Discount $discount) {
    $trail->parent('discounts.index', $discount);
    $trail->push($discount->name, route('discounts.edit', $discount));
});

// Regions
Breadcrumbs::for('region.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Регионы', route('region.index'));
});
Breadcrumbs::for('region.create', function (BreadcrumbTrail $trail) {
    $trail->parent('region.index');
    $trail->push('Добавление региона', route('region.create'));
});
Breadcrumbs::for('region.edit', function (BreadcrumbTrail $trail, \App\Models\Region $region) {
    $trail->parent('region.index', $region);
    $trail->push($region->name, route('region.edit', $region));
});

// Dealers
Breadcrumbs::for('dealer.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Дилеры', route('dealer.index'));
});
Breadcrumbs::for('dealer.create', function (BreadcrumbTrail $trail) {
    $trail->parent('dealer.index');
    $trail->push('Добавление дилера', route('dealer.create'));
});
Breadcrumbs::for('dealer.edit', function (BreadcrumbTrail $trail, \App\Models\Dealer $dealer) {
    $trail->parent('dealer.index', $dealer);
    $trail->push($dealer->name, route('dealer.edit', $dealer));
});


// Export to Excel
Breadcrumbs::for('product.price.export.show', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('"Экспорт данных товаров', route('product.price.export.show'));
});
Breadcrumbs::for('offer.price.export.show', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('"Экспорт данных опций', route('offer.price.export.show'));
});
Breadcrumbs::for('product.import.show', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Импорт товаров', route('product.import.show'));
});
Breadcrumbs::for('offer.import.show', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Импорт опций товаров', route('offer.import.show'));
});



