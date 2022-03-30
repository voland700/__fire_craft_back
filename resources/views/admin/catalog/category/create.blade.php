@extends('admin.layouts.layout')

@section('title', 'Админ-панель - страница создания новой категории для товаров')
@section('h1', 'Создать новый раздел каталога')
@section('breadcrumbs')
    {{ Breadcrumbs::render('category.create') }}
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

    <form id="create" role="form" method="post" action="{{ route('category.store') }}">
        @csrf
        <div class="row">

            <div class="col-md-6"><!-- Start cart -->
                <div class="card">
                    <div class="card-header">
                        <a href="{{route('category.index')}}" class="float-left mr-2"><i class="fas fa-arrow-alt-circle-left"></i></a>
                        <h3 class="card-title">Общие данные категорий</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="active" name="active" checked="">
                                <label for="active" class="custom-control-label">Категория активна</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="main" id="main">
                                <label for="main" class="custom-control-label">Показывать на главной</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sort" class="col-sm-2 col-form-label">Сортировка</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control @error('sort') is-invalid @enderror" id="sort"  name="sort" value="500" placeholder="500">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Наименование</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"   value="{{ old('name') }}" placeholder="Название характеристики">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="slug" class="col-sm-2 col-form-label">ЧПУ категории</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="parent_id">Родительская категория</label>
                            <select name="parent_id" class="form-control">
                                <option value="">Нет родительской</option>
                                @php
                                    $traverse = function ($categories, $prefix = '-&ensp;') use (&$traverse) {
                                        foreach ($categories as $category) {
                                            echo '<option value="'.$category->id.'">'.$prefix.' '.$category->name.'</option>'.PHP_EOL;
                                            $traverse($category->children, $prefix.'-&ensp;');
                                        }
                                     };
                                    $traverse($categories);
                                @endphp
                            </select>
                        </div>

                        <input type="hidden" name="img" value="{{ old('img') }}" id="img">
                        <input type="hidden" name="thumbnail" value="{{ old('thumbnail') }}" id="thumbnail">


                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="imageDropzone">Картинка главная 300×300</label>
                                <div class="dropzone" id="imageDropzone"></div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="thumbDropzone">Картинка бренда 100×100</label>
                                <div class="dropzone" id="thumbDropzone"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <p></p>
                    </div><!-- /.card-footer-->
                </div>
            </div>


            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">SEO данные категории</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="form-group">
                            <label for="h1">Заголовок H1</label>
                            <input type="text" class="form-control" id="h1" name="h1" value="{{ old('h1') }}" placeholder="Заголовок категории">
                        </div>

                        <div class="form-group">
                            <label for="meta_title">Meta TITLE</label>
                            <textarea class="form-control" rows="3" name="meta_title" placeholder="Enter ...">{{ old('meta_title') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="meta_keywords">Meta KEYWORDS</label>
                            <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords') }}" placeholder="Kлючевые слова">
                        </div>

                        <div class="form-group">
                            <label for="meta_description">Meta DESCRIPTION</label>
                            <textarea class="form-control" rows="3" name="meta_description" placeholder="Enter ...">{{ old('meta_description') }}</textarea>
                        </div>

                    </div>
                    <div class="card-footer clearfix">
                        <p></p>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Общие данные категорий</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <!-- textarea -->
                        <div class="form-group">
                            <label for="description">Описание для категории</label>
                            <textarea class="form-control" name="description" id="description">{!! old('description') !!}</textarea>
                        </div>

                    </div>
                    <div class="card-footer clearfix">
                        <p></p>
                    </div>
                </div>
            </div>

        </div><!-- /.END ROW -->

        <button type="submit" class="btn btn-primary mt-3 mb-3">Применить</button>

    </form>
@endsection

@section('scripts')

    <script>
        if(document.getElementById('create')){
            const img = document.getElementById('img');
            let pathImg = null;
            const thumbnail = document.getElementById('thumbnail');
            let pathThumbnail = null;

            Dropzone.autoDiscover = false;
            let myDropzone = new Dropzone("#imageDropzone",
                {
                    url: '/admin/category-img-upload',
                    headers: {'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content},
                    method: 'POST',
                    maxFilesize: 1,
                    acceptedFiles: ".jpeg,.jpg,.png,.gif",
                    addRemoveLinks: true,
                    timeout: 60000,
                    removedfile: function(file){
                        file.previewElement.remove();
                        img.value = '';
                        if(pathImg){
                            RemoveNewInput(pathFile);
                        }
                    },
                    success: function (file, response) {
                        console.log(response.success);
                        pathImg = response.success;
                        img.value = response.success;
                    },
                    error: function (file, response) {
                        console.log(response);
                        //return false;
                    }
                });


            let thumbDropzone = new Dropzone("#thumbDropzone",
                {
                    url: '/admin/category-img-upload',
                    headers: {'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content},
                    method: 'POST',
                    maxFilesize: 1,
                    acceptedFiles: ".jpeg,.jpg,.png,.gif",
                    addRemoveLinks: true,
                    timeout: 60000,
                    removedfile: function(file){
                        file.previewElement.remove();
                        thumbnail.value = '';
                        if(pathThumbnail){
                            RemoveNewInput(pathThumbnail);
                        }
                    },
                    success: function (file, response) {
                        console.log(response.success);
                        pathThumbnail = response.success;
                        thumbnail.value = response.success;
                    },
                    error: function (file, response) {
                        console.log(response);
                        //return false;
                    }
                });




            function RemoveNewInput(path){
                $.ajax(
                    {
                        url: "/admin/drop-remove-file",
                        type: 'POST',
                        data: {
                            _token: document.querySelector('meta[name=csrf-token]').content,
                            path: path,
                        },
                        success: function (response) {
                            console.log(response.success);
                        },
                        error: function (response) {
                            console.log(response);
                        }
                    });
            }
        }
    </script>
@endsection
