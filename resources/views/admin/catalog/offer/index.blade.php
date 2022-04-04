@extends('admin.layouts.layout')

@section('title', 'Админ-панель - Каталог товаров, торговые предложения')
@section('h1', 'Торговые предложения: '.$product->name)

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
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <a href="{{route('offer.create', $product->id)}}" type="button" class="btn btn-primary mb-3">Добавить</a>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">№</th>
                        <th>Название</th>
                        <th style="width: 30px">Цвет</th>
                        <th style="width: 20px">Active</th>
                        <th style="width: 20px">Sort</th>
                        <th  style="width: 10px">ID</th>
                        <th style="width: 120px">Редактировать</th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach($product->offers as $offer)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td><a href="{{route("offer.edit", $offer->id)}}">{{$offer->name}}</a></td>
                                <td class="td_color">@if($offer->color->file) <img src="{{asset($offer->color->file)}}" class="colorOffer"> @endif</td>
                                <td>
                                    @if ($offer->active === 0)
                                        <span class="pale-icon"><i class="far fa-check-circle"></i></span>
                                    @endif
                                    @if ($offer->active === 1)
                                        <span class="green-icon"><i class="far fa-check-circle"></i></span>
                                    @endif
                                </td>
                                <td class="text-center">{{$offer->sort}}</td>
                                <td class="text-center">{{$offer->id}}</td>
                                <td>
                                    <a href="{{ route('offer.edit', $offer->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                    <form method="POST" action="{{ route('offer.destroy', $offer->id) }}" class="formDelete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm delete" onclick="return confirm('Подтвердите удаление')"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <p></p>
            </div>
            <!-- /.card-footer-->
        </div>

    </div>
@endsection
