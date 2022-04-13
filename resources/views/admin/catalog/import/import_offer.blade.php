@extends('admin.layouts.layout')

@section('title', 'Админ-панель - импорт данных, опции товара')
@section('h1', 'Импорт опций товаров из Excel')
@section('breadcrumbs')
    {{ Breadcrumbs::render('offer.import.show') }}
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
                    <p>Применяется опции Цвет для товаров. В столбцах импортируемого листа Excel:</p>
                    <ul>
                        <li><b>color_id</b>  опция, ID - Цвета, элемент таблицы "colors", базы данных, <b>обязательное поле</b></li>
                        <li><b>product_id</b> соответсвует ID - товара, которому пренадлежат опции, <b>обязательное поле</b></li>
                        <li><b>name</b>  Наименование опции - необязательное</li>
                        <li><b>active</b>  статус активности, 1 или 0. необязательное, по умолчанию 1</li>
                        <li><b>sort</b>  индекс сортировки, необязательное поле, по умолчанию 500</li>
                        <li><b>number</b>  артикул опции товара, необязательное поле</li>
                        <li><b>hit</b>  Популярнй - необязательное</li>
                        <li><b>new</b>  Новинка - необязательное</li>
                        <li><b>stock</b>  Акция - необязательное</li>
                        <li><b>advice</b>  Советуем - необязательное</li>
                        <li><b>img</b>  путь к файлу основного изображения товара - необязательное</li>
                        <li><b>preview</b>  путь к файлу preview - изображения товара - необязательное</li>
                        <li><b>images</b>  дополнительные изображения, пути к файлам через запятую - необязательное</li>
                        <li><b>base_price</b>  цена, базовая стоимость опции товара</li>
                        <li><b>currency</b> значение Валюты, (<em>RUB, EUR, USD, BYN, UAH</em>), не обязатеьное, по умолчанию RUB - Российские рубли</li>
                    </ul>
                    Скачать <a href="{{asset('storage/download/excel/import_offers.xlsx')}}" download>шаблон для импорта</a>
                </div>
                <div class="card-footer"><p></p></div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <p></p>
            </div>
            <div class="card-body">

                <form action="{{route('offer.import')}}" method="post" enctype="multipart/form-data">
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
                            <button type="submit" class="btn btn-primary align-self-end mb-3">Создать</button>
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
