@extends('admin.layouts.layout')
@section('title', 'Админ-панель - страница добавления регионо продаж')
@section('h1', 'Новый регион продаж')
@section('breadcrumbs')
    {{ Breadcrumbs::render('region.create') }}
@endsection
@section('content')
    <div class="col-12">
        @if (count($errors) > 0)
            <div class="card bg-danger">
                <div class="card-header">
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
    <form id="createForm" role="form" method="post" action="{{ route('region.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="col-md-9">
            <!-- Default box -->
            <div class="card">

                <div class="card-header">
                    <a href="{{route('region.index')}}" class="float-left mr-2"><i class="fas fa-arrow-alt-circle-left"></i></a>
                    <h3 class="card-title">Данные региона</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Наименование</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"   value="{{ old('name') }}" placeholder="Заголовок слайда">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="item" class="col-sm-12 col-form-label">Kод региона</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control @error('item') is-invalid @enderror" id="item" name="item" value="{{ old('item') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="h1">Заголовок H1</label>
                        <input type="text" class="form-control" id="h1" name="h1" value="{{ old('h1') }}" placeholder="Заголовок страницы товара...">
                    </div>

                    <div class="form-group">
                        <label for="meta_title">META Title</label>
                        <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title') }}" placeholder="CEO заголовок страницы товара...">
                    </div>


                    <div class="form-group">
                        <label for="meta_keywords">META Keywords</label>
                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords') }}" placeholder="Ключевые слова...">
                    </div>

                    <div class="form-group mb-5">
                        <label for="meta_description">META Description</label>
                        <textarea class="form-control" id="meta_description" name="meta_description" rows="3" placeholder="CEO описание страницы товара...">{{ old('meta_description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="description">Описание региона</label>
                        <textarea class="form-control" id="description" name="description" rows="7" placeholder="Описание региона...">{{ old('description') }}</textarea>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <p></p>
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->
            <button type="submit" id="sendForm" class="btn btn-primary mt-3 mb-3">Применить</button>
        </div>

    </form>
@endsection
