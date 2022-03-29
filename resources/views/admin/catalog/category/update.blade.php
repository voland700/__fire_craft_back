@extends('admin.layouts.layout')

@section('title', 'Админ-панель - страница редактированиея категории каталога')
@section('h1', $category->name)
@section('breadcrumbs')
    {{ Breadcrumbs::render('category.edit', $category) }}
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

    <form id="update" role="form" method="post" action="{{ route('category.update', $category->id)}}">
        @csrf
        @method('PUT')
        <div class="row">

            <div class="col-md-6"><!-- Start cart -->
                <div class="card">
                    <div class="card-header">
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
                                <input class="custom-control-input" type="checkbox" id="active" name="active" {{($category->active == 1) ? 'checked=""' : ''}}>
                                <label for="active" class="custom-control-label">Категория активна</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="main" name="main" {{($category->main == 1) ? 'checked=""' : ''}}>
                                <label for="main" class="custom-control-label">Показывать на главной</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sort" class="col-sm-2 col-form-label">Сортировка</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control @error('sort') is-invalid @enderror" id="sort"  name="sort" value="{{$category->sort}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Наименование</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{$category->name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="slug" class="col-sm-2 col-form-label">ЧПУ категории</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{$category->slug}}">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="parent_id">Родительская категория</label>
                            <select name="parent_id" class="form-control">
                                @php
                                    $traverse = function ($categories, $prefix = '-&ensp;', $parentId=NULL) use (&$traverse) {
                                        echo ($parentId == NULL) ? '<option value="" selected >Нет родительской</option>' : '<option value="">Нет родительской</option>';
                                        foreach ($categories as $category) {
                                            $checked = ($category->id == $parentId) ? 'selected' : '';
                                            echo  '<option value="'.$category->id.'" '.$checked.'>'.$prefix.' '.$category->name.'</option>';
                                            $traverse($category->children, $prefix.'-&ensp;', $parentId);
                                        }
                                    };
                                    $traverse($categories, '-&ensp;', $category->parent_id);
                                @endphp
                            </select>
                        </div>

                        <input type="hidden" id="img" name="img" value="{{$category->img}}">
                        <input type="hidden" name="thumbnail" value="{{$category->thumbnail}}" id="thumbnail">
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
                            <input type="text" class="form-control" id="h1" name="h1" value="{{$category->h1}}">
                        </div>

                        <div class="form-group">
                            <label for="meta_title">Meta TITLE</label>
                            <textarea class="form-control" rows="3" name="meta_title">{{$category->meta_title}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="meta_keywords">Meta KEYWORDS</label>
                            <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ $category->meta_keywords }}">
                        </div>

                        <div class="form-group">
                            <label for="meta_description">Meta DESCRIPTION</label>
                            <textarea class="form-control" rows="3" name="meta_description" placeholder="Enter ...">{{$category->meta_description}}</textarea>
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
                            <textarea class="form-control" name="description" id="description">{!!$category->description !!}</textarea>
                        </div>

                    </div>
                    <div class="card-footer clearfix">
                        <p></p>
                    </div>
                </div>
            </div>

        </div><!-- /.END ROW -->

        <button type="submit" class="btn btn-primary mt-3">Применить</button>
    </form>

@endsection

@section('scripts')

    <script>

        const img = document.getElementById('img');
        let imgPath = @if(count($img)>0) '{{$img['path']}}' @else null @endif;

        const thumbnail = document.getElementById('thumbnail');
        let pathThumbnail =  @if(count($thumbnail)>0) '{{$thumbnail['path']}}' @else null @endif;

        Dropzone.autoDiscover = false;
        let imageDropzone = new Dropzone("#imageDropzone",
            {
                url: '/admin/category-img-update',
                headers: {'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content},
                method: 'POST',
                maxFilesize: 1,
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 60000,
                params: {
                    id: {{$id}}
                },
                @if(count($img)>0)
                init: function () {
                    let imageDropzone = this;
                    let mockFile = {name: "{{ $img['name'] }}", size: Number("{{$img['size']}}")};
                    imageDropzone.displayExistingFile(mockFile, "{{ asset( $img['path']) }}" );
                    //console.log()
                },
                @endif
                removedfile: function(file){
                    file.previewElement.remove();
                    img.value=null;
                    RemoveFile(imgPath);
                    imgPath = null;
                },
                success: function (file, response) {
                    console.log(response.success);
                    imgPath = response.success;
                    img.value = response.success;
                },
                error: function (file, response) {
                    console.log(response);
                    //return false;
                }
            });

        function RemoveFile(path){
            $.ajax(
                {
                    url: '/admin/category-img-update-remove',
                    type: 'POST',
                    data: {
                        _token: document.querySelector('meta[name=csrf-token]').content,
                        path: path,
                        id: {{$category->id}},
                    },
                    success: function (response) {
                        //console.log(response.success);
                        console.log(response);
                    },
                    error: function (response) {
                        console.log(response);
                    }
                });
        }















    </script>
@endsection

