@extends('admin.layouts.layout')

@section('title', 'Админ-панель - Новый цвет предложения товаров')
@section('h1', 'Новый цвет торгового предложения')
@section('breadcrumbs')
    {{ Breadcrumbs::render('color.edit', $color) }}
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

    <form id="create" role="form" method="post" action="{{ route('color.update', $color->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">

            <div class="col-md-6"><!-- Start cart -->
                <div class="card">
                    <div class="card-header">
                        <a href="{{route('color.index')}}" class="float-left mr-2"><i class="fas fa-arrow-alt-circle-left"></i></a>
                        <h3 class="card-title">Общие данные</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Наименование</label>
                            <div class="col-sm-12">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"  value="{{$color->name}}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-2">
                                <label class="overlay-label mb-0">Иконка</label>
                                <div class="color_img_wrap">
                                    <img src="{{asset($color->file)}}" class="color_img">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputFile">Миниатюра 24×24</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="file" value="{{ $color->file }}" class="custom-file-input @error('file') is-invalid @enderror">
                                        <label class="custom-file-label" for="file">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <p></p>
                    </div><!-- /.card-footer-->
                </div>
            </div>

        </div><!-- /.END ROW -->

        <button type="submit" class="btn btn-primary mt-3 mb-3">Применить</button>

    </form>
@endsection
