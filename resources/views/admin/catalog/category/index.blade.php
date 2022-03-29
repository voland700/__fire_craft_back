@extends('admin.layouts.layout')

@section('title', 'Админ-панель - Список категорий, разделов каталога товаров')
@section('h1', 'Список категорий каталога')
@section('breadcrumbs')
    {{ Breadcrumbs::render('category.index') }}
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
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <a href="{{route('category.create')}}" type="button" class="btn btn-primary mb-3">Добавить</a>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Name</th>
                        <th style="width: 20px">Active</th>
                        <th style="width: 20px">Main</th>
                        <th style="width: 20px">Sort</th>
                        <th style="width: 120px">Редактировать</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>
                                @if ($category->active === 0)
                                    <span class="pale-icon"><i class="far fa-check-circle"></i></span>
                                @endif
                                @if ($category->active === 1)
                                    <span class="green-icon"><i class="far fa-check-circle"></i></span>
                                @endif
                            </td>
                            <td>
                                @if ($category->main === 0)
                                    <span class="pale-icon"><i class="far fa-check-circle"></i></span>
                                @endif
                                @if ($category->main === 1)
                                    <span class="green-icon"><i class="far fa-check-circle"></i></span>
                                @endif
                            </td>
                            <td>{{$category->sort}}</td>
                            <td>
                                <a href="{{ route('category.edit', $category->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                <form method="POST" action="{{ route('category.destroy', $category->id) }}" class="formDelete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm delete" onclick="return confirm('Подтвердите удаление')"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                        @if(count($category->children)>0)
                            @foreach ($category->children as $childCategory)
                                @include('admin.catalog.category.child_categories_list', ['childCategory' => $childCategory])
                            @endforeach
                        @endif

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
