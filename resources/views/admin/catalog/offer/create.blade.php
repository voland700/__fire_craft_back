@extends('admin.layouts.layout')

@section('title', 'Админ-панель - страница создания новоо торгового предложения')
@section('h1', 'Новое торговое предложение для товара: '.$product->name)

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

    <form id="create" role="form" method="post" action="{{ route('offer.store') }}">
        @csrf
        <div class="row">

            <div class="col-md-6"><!-- Start cart -->
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('offer.list', $product->id) }}" class="float-left mr-2"><i class="fas fa-arrow-alt-circle-left"></i></a>
                        <h3 class="card-title">Основные данные</h3>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="active" name="active" checked="">
                                <label for="active" class="custom-control-label">Товар активен</label>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-6">

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" name="hit" id="hit"  type="checkbox">
                                        <label class="custom-control-label" for="hit" >Популярный</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" name="new" id="new" type="checkbox">
                                        <label class="custom-control-label" for="new">Новинка</label>
                                    </div>
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="form-group toggle">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" name="stock" id="stock"  type="checkbox">
                                        <label class="custom-control-label" for="stock">Товар со скидкой</label>
                                    </div>
                                </div>

                                <div class="form-group toggle">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" name="advice" id="advice" type="checkbox">
                                        <label class="custom-control-label" for="advice">Советуем</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-2">
                                <input type="number" class="form-control @error('sort') is-invalid @enderror" id="sort"  name="sort" value="{{old('sort', 500)}}">
                            </div>
                            <label for="sort" class="col-sm-4 col-form-label">Сортировка</label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="art_number"  name="art_number">
                            </div>
                            <label for="number" class="col-sm-2 col-form-label">Артикул</label>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-12 col-form-label">Название</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"   value="{{ old('name') }}" placeholder="Название...">
                            </div>
                        </div>


                        <input type="hidden" name="img" id="img" value="">
                        <input type="hidden" name="preview" id="preview" value="">
                        <div id="galleryHidden"></div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="imageDropzone">Основное изображение</label>
                                <div class="dropzone" id="imageDropzone"></div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="thumbnailDropzone">Изображение анонса</label>
                                <div class="dropzone" id="thumbnailDropzone"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="imagesDropzone">Дополнительные изображения</label>
                                <div class="dropzone dropzone-gallery" id="imagesDropzone"></div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer clearfix">
                        <p></p>
                    </div>
                </div><!--//END Основные данные -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Стоимость и наличие товара</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">

                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="base_price" class="col-sm-2 col-form-label">Цена</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="base_price" value="{{ old('base_price') }}" id="base_price" placeholder="Цена">
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="price" class="col-sm-3 col-form-label">Валюта</label>
                                    <div class="col-sm-9">
                                        <select name="currency"  class="form-control">
                                            <option value="RUB" selected>RUB - Российский рубль</option>
                                            @foreach($currency as $curItem)
                                                <option value="{{$curItem->currency}}">{{$curItem->currency}} - {{$curItem->Name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="card-footer clearfix">
                        <p></p>
                    </div>
                </div><!-- END цена и валюта -->

            </div><!-- END ROW -->

        </div><!-- END ROW col-12 -->
        <button type="submit" class="btn btn-primary mt-3 mb-3">Применить</button>
    </form>



@endsection

@section('scripts')

    <script>

        if(document.getElementById('create')){
            const img = document.getElementById('img');
            const preview = document.getElementById('preview');
            const galleryHidden = document.getElementById('galleryHidden');

            Dropzone.autoDiscover = false;
            let myDropzone = new Dropzone("#imageDropzone",
                {
                    url: '{{route('offer.upload.img')}}',
                    headers: {'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content},
                    method: 'POST',
                    maxFilesize: 1,
                    acceptedFiles: ".jpeg,.jpg,.png,.gif",
                    addRemoveLinks: true,
                    timeout: 60000,
                    params: {
                        type: 'img'
                    },
                    removedfile: function(file){
                        file.previewElement.remove();
                        if(!img.value == null || !img.value == ''){
                            RemoveOneImgFile(img.value);
                        }
                        img.value=null;
                    },
                    success: function (file, response) {
                        img.value = response.success;


                        console.log(response.success);
                    },
                    error: function (file, response) {
                        console.log(response);
                        //return false;
                    }
                });

            let thumbnailDropzone = new Dropzone("#thumbnailDropzone",
                {
                    url: '{{route('product.upload.img')}}',
                    headers: {'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content},
                    method: 'POST',
                    maxFilesize: 1,
                    acceptedFiles: ".jpeg,.jpg,.png,.gif",
                    addRemoveLinks: true,
                    timeout: 60000,
                    params: {
                        type: 'preview'
                    },
                    removedfile: function(file){
                        file.previewElement.remove();
                        if(!preview.value == null || !preview.value == '') {
                            RemoveOneImgFile(preview.value);
                        }
                        preview.value=null;
                    },
                    success: function (file, response) {
                        preview.value = response.success;


                        console.log(response.success);
                    },
                    error: function (file, response) {
                        console.log(response);
                        //return false;
                    }
                });

            function RemoveOneImgFile(path){
                $.ajax(
                    {
                        url: "/admin/drop-remove-file",
                        type: 'POST',
                        data: {
                            _token: document.querySelector('meta[name=csrf-token]').content,
                            path: path,
                        },
                        success: function (response) {
                            //console.log(response.success);
                        },
                        error: function (response) {
                            console.log(response);
                        }
                    });
            }

            let imagesDropzone = new Dropzone("#imagesDropzone",
                {
                    url: '{{route('product.upload.images')}}',
                    headers: {'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content},
                    method: 'POST',
                    paramName: 'image',
                    //uploadMultiple: true,
                    acceptedFiles: ".jpeg,.jpg,.png,.gif",
                    addRemoveLinks: true,
                    timeout: 60000,
                    removedfile: function(file){
                        RemoveImageFile(file.previewTemplate.querySelector('input').value);
                        file.previewElement.remove();
                    },
                    success: function (file, response) {
                        file.previewTemplate.appendChild(AddHiddenInput(response.success));

                        console.log(response.success);
                    },
                    error: function (file, response) {
                        console.log(response);
                        //return false;
                    }
                });

            function RemoveImageFile(path){
                $.ajax(
                    {
                        url: '{{route('product.create.images.remove')}}',
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

            function AddHiddenInput(path){
                let input = document.createElement("input");
                input.type = "hidden";
                input.name = 'image[]';
                input.value = path;
                return input;
            }
        }
    </script>
@endsection
