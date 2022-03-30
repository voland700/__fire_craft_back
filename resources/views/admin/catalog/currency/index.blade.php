@extends('admin.layouts.layout')

@section('title', 'Админ-панель - Курсы валют, обновление цен товаров каталога')
@section('h1', 'Курсы валют, обновление')
@section('breadcrumbs')
    {{ Breadcrumbs::render('currency.index') }}
@endsection
@section('content')
    <div class="col-md-9">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Обновление курса</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                @if($necessary)
                    <p>Последнее обнавление курса валют производилось: <em class="text-success ml-1">{{$data}}</em> - <em class="text-secondary ml-1">{{$ago}}</em></p>
                    <p class="h3 text-success mb-4">Данные актуальны</p>
                @else
                    <p>Последнее обнавление курса валют производилось: <em class="text-danger ml-1">{{$data}}</em> - <em class="text-secondary ml-1">{{$ago}}</em></p>
                    <p class="h3 text-danger mb-4">Небходимо обновить данные</p>
                @endif
                <p>Получить актуальный действующий курс валют по данным ЦБ России</p>
                <a href="{{route('get_currency')}}" type="button" class="btn btn-primary">Обновить данные</a>
                <a href="{{route('update_prices')}}" type="button" class="btn btn-primary">Обновить цены</a>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <p></p>
            </div>
            <!-- /.card-footer-->
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Курсы валют на последнюю дату обновления</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">N</th>
                        <th>Валюта</th>
                        <th>Наименование</th>
                        <th style="width: 10px">Номинал</th>
                        <th style="width: 40px">Значение</th>
                        <th>Дата</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($currency as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->currency}}</td>
                            <td>{{$item->Name}}</td>
                            <td>{{$item->Nominal}}</td>
                            <td>{{$item->value}}</td>
                            <td>{{$item->updated_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <p></p>
            </div>
        </div>
    </div>
@endsection
