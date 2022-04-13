@extends('admin.layouts.layout')

@section('title', 'Админ-панель - импорт данных в каталог')
@section('h1', 'Импорт данных из Excel')
@section('breadcrumbs')
    {{ Breadcrumbs::render('product.import.show') }}
@endsection
@section('content')
    <div class="col-md-9">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if (isset($errors) && $errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        @if (session()->has('failures'))

            <table class="table table-danger">
                <tr>
                    <th>Row</th>
                    <th>Attribute</th>
                    <th>Errors</th>
                    <th>Value</th>
                </tr>

                @foreach (session()->get('failures') as $validation)
                    <tr>
                        <td>{{ $validation->row() }}</td>
                        <td>{{ $validation->attribute() }}</td>
                        <td>
                            <ul>
                                @foreach ($validation->errors() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            {{ $validation->values()[$validation->attribute()] }}
                        </td>
                    </tr>
                @endforeach
            </table>

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

                    <p>Поля EXCEL для загрузки данных товаров. В столбцах импортируемого листа Excel:</p>
                    <ul>
                        <li><b>name</b> - Наименование товара - <b>обязательное поле</b></li>
                        <li><b>slug</b> - Наименование товара - не обязательное поле</li>
                        <li><b>active</b> - Статус активности, 1 или 0. необязательное, по умолчанию 1</li>
                        <li><b>art_number</b> - Аартикул опции товара, необязательное поле</li>
                        <li><b>hit</b> - Популярнй - 1 или 0. необязательное, по умолчанию 0</li>
                        <li><b>new</b> - Новинка - 1 или 0. необязательное, по умолчанию 0</li>
                        <li><b>stock</b> - Акция - 1 или 0. необязательное, по умолчанию 0</li>
                        <li><b>advice</b> - Советуем - 1 или 0. необязательное, по умолчанию 0</li>
                        <li><b>sort</b> - Индекс сортировки, необязательное поле, по умолчанию 500</li>
                        <li><b>category_id</b> - Опция, ID - категории товра, элемент таблицы "categories", базы данных, не обязательное поле</li>
                        <li><b>h1</b> - Заголовок H1 товра- необязательное поле</li>
                        <li><b>meta_title</b> - Meta Title товара- необязательное поле</li>
                        <li><b>meta_keywords</b> - Meta keys ключевые стова для товара - необязательное поле</li>
                        <li><b>meta_description</b> - Meta description - meta описание товара - необязательное поле</li>
                        <li><b>summary</b> - Краткое описание товара - необязательное поле</li>
                        <li><b>description</b> - Полное описание товара(HTML) - необязательное поле</li>
                        <li><b>accessory</b> - Данные для вкладки "Аксессуары" (HTML table) - необязательное поле</li>
                        <li><b>preview</b> - Путь к файлу preview - изображения товара - необязательное</li>
                        <li><b>images</b> - Дополнительные изображения, пути к файлам через запятую - необязательное</li>
                        <li><b>base_price</b> - Цена, базовая стоимость опции товара</li>
                        <li><b>currency</b> - Значение Валюты, (<em>RUB, EUR, USD, BYN, UAH</em>), не обязатеьное, по умолчанию RUB - Российские рубли</li>
                        <li><b>documents</b> - Данные для вкладки "Документация" ID - докуменов, через запятую - необязательное поле</li>
                        <li><b>properties</b> - Характеристики товара в JSON формате  - необязательное поле</li>
                    </ul>
                    Скачать <a href="{{asset('storage/download/excel/import_products.xlsx')}}" download>шаблон для импорта</a>
                </div>
                <div class="card-footer"><p></p></div>
            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <p></p>
            </div>
            <div class="card-body">

                <form action="{{route('product.import')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="file">Загрузиить файл</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file" name="file" value="{{old('file')}}">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex">
                            <button type="submit" class="btn btn-primary align-self-end mb-3">Import</button>
                        </div>
                    </div>
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
