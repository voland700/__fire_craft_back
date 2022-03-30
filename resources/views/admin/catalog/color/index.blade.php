@extends('admin.layouts.layout')

@section('title', 'Админ-панель - Цвета торговых предложений')
@section('h1', 'Каталог цветов торговых предложений')
@section('breadcrumbs')
    {{ Breadcrumbs::render('color.index') }}
@endsection
@section('content')
    <div class="col-md-8">
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
                <a href="{{route('color.create')}}" type="button" class="btn btn-primary mb-3">Добавить</a>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 30px">№</th>
                        <th>Название</th>
                        <th style="width: 100px">Цвет</th>
                        <th style="width: 120px">Редактировать</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($colors as $color)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$color->name}}</td>
                            <td class="td_color">@if($color->file) <img src="{{asset($color->file)}}"  class="colorOffer"> @endif</td>
                            <td>
                                <a href="{{ route('color.edit', $color->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                <form method="POST" action="{{ route('color.destroy', $color->id) }}" class="formDelete">
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
