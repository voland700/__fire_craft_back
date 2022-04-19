@extends('admin.layouts.layout')

@section('title', 'Админ-панель - Слайдер, в футете сайта')
@section('h1', 'Слайдер в футере сайта')

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
                <a href="{{route('gallery.create')}}" type="button" class="btn btn-primary mb-3">Добавить</a>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Name</th>
                        <th style="width: 20px">Active</th>
                        <th style="width: 20px">Sort</th>
                        <th style="width: 120px">Редактировать</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($galleries as $gallery)
                        <tr>
                            <td>{{$gallery->id}}</td>
                            <td>{{$gallery->name}}</td>
                            <td>
                                @if ($gallery->active === 0)
                                    <span class="pale-icon"><i class="far fa-check-circle"></i></span>
                                @endif
                                @if ($gallery->active === 1)
                                    <span class="green-icon"><i class="far fa-check-circle"></i></span>
                                @endif
                            </td>
                            <td>{{$gallery->sort}}</td>
                            <td>
                                <a href="{{ route('gallery.edit', $gallery->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                <form method="POST" action="{{ route('gallery.destroy', $gallery->id) }}" class="formDelete">
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
