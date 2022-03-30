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

