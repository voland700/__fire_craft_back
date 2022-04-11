@extends('admin.layouts.layout')

@section('title', 'Админ-панель - Экспорт цен товаров каталога')
@section('h1', 'Экспорт цен товаров')
@section('breadcrumbs')
    {{ Breadcrumbs::render('product.price.export.show') }}
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
                    <p>Экспортируемые поля для последующего обновления цен</p>
                    <ul>
                        <li><strong>'id'</strong> - ID товара</li>
                        <li><strong>'active'</strong> -  статус активности товара</li>
                        <li><strong>'category_id</strong>' – Id категории товара (и название)</li>
                        <li> <strong>'name'</strong> наименование товара</li>
                        <li><strong>'art_number'</strong> артикул товара</li>
                        <li><strong>'base_price'</strong> – значение базовой цены</li>
                        <li> <strong>'currency'</strong> – валюта базовой цены (по умолчанию RUB)</li>
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
                <form role="form" method="post" action="{{ route('product.price.export') }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- Select multiple-->
                            <div class="form-group">
                                <label>Категрии для экспорта</label>
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
                                    <input class="form-check-input" type="checkbox" id="nested" name="nested" checked="">
                                    <label class="form-check-label" for="nested">Вложенные категрии</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="all" id="all">
                                    <label class="form-check-label" for="all">Весь каталог</label>
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
