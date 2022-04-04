@extends('admin.layouts.layout')

@section('title', 'Админ-панель - страница редактирования торгового предложения')
@section('h1', $offer->name)

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


    <form action="{{route('offer.update', $offer->id )}}" method="post" id="productUpdate" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="product_id" value="{{$offer->product_id}}">
        <div class="row">

            <div class="col-md-6"><!-- Start cart -->
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('offer.list', $offer->product_id) }}" class="float-left mr-2"><i class="fas fa-arrow-alt-circle-left"></i></a>
                        <h3 class="card-title">Основные данные </h3>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="active" name="active" @if($offer->active) checked @endif>
                                <label for="active" class="custom-control-label">Товар активен</label>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-6">

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" name="hit" id="hit"  type="checkbox" @if($offer->hit) checked @endif>
                                        <label class="custom-control-label" for="hit" >Популярный</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" name="new" id="new" type="checkbox" @if($offer->new) checked @endif>
                                        <label class="custom-control-label" for="new">Новинка</label>
                                    </div>
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="form-group toggle">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" name="stock" id="stock"  type="checkbox" @if($offer->stock) checked @endif>
                                        <label class="custom-control-label" for="stock">Товар со скидкой</label>
                                    </div>
                                </div>

                                <div class="form-group toggle">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" name="advice" id="advice" type="checkbox" @if($offer->advice) checked @endif>
                                        <label class="custom-control-label" for="advice">Советуем</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-2">
                                <input type="number" class="form-control @error('sort') is-invalid @enderror" id="sort" name="sort" value="{{$offer->sort}}">
                            </div>
                            <label for="sort" class="col-sm-4 col-form-label">Сортировка</label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="art_number"  name="number"  value="{{$offer->number}}">
                            </div>
                            <label for="art_number" class="col-sm-2 col-form-label">Артикул</label>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-12 col-form-label">Название предложения</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $offer->name) }}">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-6"></div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="price" class="col-sm-2 col-form-label">Цвет</label>
                                    <div class="col-sm-10">
                                        <select name="color_id" class="form-control">
                                            @foreach($colors as $color)
                                                <option value="{{$color->id}}"  @if($color->id == $offer->color_id) selected @endif>{{$color->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                                        <input type="text" class="form-control" name="base_price" id="base_price" value="{{ old('base_price', $offer->base_price) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="price" class="col-sm-3 col-form-label">Валюта</label>
                                    <div class="col-sm-9">
                                        <select name="currency"  class="form-control">
                                            <option value="RUB" @if($offer->currency == "RUB") selected @endif>RUB - Российский рубль </option>
                                            @foreach($currency as $curItem)
                                                <option value="{{$curItem->currency}}" @if($offer->currency == $curItem->currency) selected @endif>{{$curItem->currency}} - {{$curItem->Name}}</option>
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

            </div>
        </div>


        <button type="submit" class="btn btn-primary mt-3 mb-3">Применить</button>
    </form>



@endsection

@section('scripts')
    <script>

        let img ="{{$offer->img ? $offer->img : ''}}";
        let preview =  "{{$offer->preview ? $offer->preview : ''}}";

        Dropzone.autoDiscover = false;
        let myDropzone = new Dropzone("#imageDropzone",
            {
                url: '{{route('offer.update.img')}}',
                headers: {'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content},
                method: 'POST',
                maxFilesize: 2,
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 60000,
                params: {
                    id: {{$offer->id}}
                },
                @if(!empty($img))
                init: function () {
                    let imageDropzone = this;
                    let mockFile = {name: "{{ $img['name'] }}", size: Number("{{$img['size']}}")};
                    imageDropzone.displayExistingFile(mockFile, "{{ '/'.$img['path'] }}" );
                },
                @endif
                removedfile: function(file){
                    RemoveImgOneFile('img');
                    file.previewElement.remove();
                    img = null;
                },
                success: function (file, response) {
                    img = response.success;
                    console.log(response);
                },
                error: function (file, response) {
                    console.log(response);
                }
            });

        let thumbnailDropzone = new Dropzone("#thumbnailDropzone",
            {
                url: '{{route('offer.update.preview')}}',
                headers: {'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content},
                method: 'POST',
                maxFilesize: 2,
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 60000,
                params: {
                    id: {{$offer->id}}
                },
                @if(!empty($preview))
                init: function () {
                    let thumbnailDropzone = this;
                    let mockFile = {name: "{{ $preview['name'] }}", size: Number("{{$preview['size']}}")};
                    thumbnailDropzone.displayExistingFile(mockFile, "{{ '/'.$preview['path'] }}" );
                },
                @endif
                removedfile: function(file){
                    RemoveImgOneFile('preview');
                    file.previewElement.remove();
                    preview = null;
                },
                success: function (file, response) {
                    preview = response.success;
                    console.log(response);
                },
                error: function (file, response) {
                    console.log(response);
                }
            });

        //Удаление одного файла основных изображений основного докусмента с удалением записи из базы
        function RemoveImgOneFile(type){
            $.ajax(
                {
                    url: "{{route('offer.update.img.remove')}}",
                    type: 'POST',
                    data: {
                        _token: document.querySelector('meta[name=csrf-token]').content,
                        type: type,
                        id: '{{$offer->id}}',
                    },
                    success: function (response) {
                        console.log(response);
                    },
                    error: function (response) {
                        console.log(response);
                    }
                });
        }

        let imagesDropzone = new Dropzone("#imagesDropzone",
            {
                url: '{{route('offer.update.images')}}',
                headers: {'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content},
                method: 'POST',
                paramName: 'image',
                //uploadMultiple: true,
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 60000,
                params: {
                    offer_id: {{$offer->id}}
                },
                @if(count($images)>0)
                init: function () {
                    let images = JSON.parse('{!! json_encode($images) !!}');
                    let self = this;
                    images.forEach(function (file) {
                        let mockFile = {
                            name: file.name,
                            size: file.size,
                        };
                        self.displayExistingFile(mockFile, '/'+file.path);
                    });
                },
                @endif
                removedfile: function(file) {
                    RemoveImagesFile(file.dataURL);
                    file.previewElement.remove();
                },
                success: function (file, response) {
                    file.dataURL= response.success;
                },
                error: function (file, response) {
                    console.log(response);
                }
            });

        //Удаление файлов дополнительных изображений основного докусмента с удалением записи из базы
        function RemoveImagesFile(path){
            $.ajax(
                {
                    url: '{{route('offer.update.images.remove')}}',
                    type: 'POST',
                    data: {
                        _token: document.querySelector('meta[name=csrf-token]').content,
                        path: path,
                        offer_id: '{{$offer->id}}',
                    },
                    success: function (response) {
                        console.log(response.success);
                    },
                    error: function (response) {
                        console.log(response);
                    }
                });
        }
    </script>
@endsection
