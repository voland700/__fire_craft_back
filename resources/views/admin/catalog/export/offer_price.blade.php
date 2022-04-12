@extends('admin.layouts.layout')

@section('title', 'Админ-панель - Экспорт опций товаров каталога')
@section('h1', 'Экспорт опций товаров')
@section('breadcrumbs')
    {{ Breadcrumbs::render('offer.price.export.show') }}
@endsection
@section('content')
    <div class="col-md-9">
        @if ($message = Session::get('success'))
            <div class="alert alert-success mb-2" role="alert">
                {{ $message }}
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger mb-2" role="alert">
                {{ $message }}
            </div>
        @endif

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-info mr-2"></i>Внимание!</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <p>Экспортируемые поля для последующего обновления опций товаров</p>
                    <ul>
                        <li><b>id</b>  id - опции товара</li>
                        <li><b>name</b>  Наименование опции</li>
                        <li><b>product_id</b>  id - товара, <b>обязательное поле</b></li>
                        <li><b>product_name</b>  название товара, которому пренадлежат опции (для информации)</li>
                        <li><b>active</b>  статус активности, 1 или 0. </li>
                        <li><b>sort</b>  индекс сортировки, необязательное поле, по умолчанию 500</li>
                        <li><b>color_id</b>  опция  Цвет, <b>обязательное поле</b> - <u>необходимо указать</u></li>
                        <li><b>color_name</b>  название опции  Цвет (для информации)</li>
                        <li><b>number</b>  артикул опции товара, необязательное поле</li>
                        <li><b>base_price</b>  цена, базовая стоимость опции товара</li>
                        <li><b>currency</b> значение Валюты, (<em>RUB, EUR, USD, BYN, UAH</em>), не обязатеьное, по умолчанию RUB - Российские рубли</li>
                    </ul>
                </div>
                <div class="card-footer"><p></p></div>
            </div>
        </div>







        <div class="card">
            <div class="card-header">
                <p></p>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('offer.price.export') }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- Select multiple-->
                            <div class="form-group">
                                <label>Выбор категрий товаров для экспорта опций</label>
                                <select multiple="" name="category_id[]"  class="form-control">
                                    @php
                                        $traverse = function ($categories, $prefix = '') use (&$traverse) {
                                            foreach ($categories as $category) {
                                                $option = '<option value="'.$category->id.'">'.PHP_EOL.$prefix.' '.$category->name.'</option>';
                                                echo $option;
                                                $traverse($category->children, $prefix.'-&ensp;');
                                            }
                                        };
                                        $traverse($categories, '-&ensp;');
                                    @endphp
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <!-- checkbox -->
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="nested" checked="">
                                    <label class="form-check-label">Опции товарв вложенных категрий</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="all">
                                    <label class="form-check-label">Опции всех товаров</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Получить</button>
                </form>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <p></p>
            </div>
            <!-- /.card-footer-->

        </div>
    </div>
@endsection
