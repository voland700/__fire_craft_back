@extends('admin.layouts.layout')

@section('title', 'Админ-панель - страница редактирования товара каталога')
@section('h1', $product->name)

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


    <form action="{{route('product.update', $product->id )}}" method="post" id="productUpdate" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">

            <div class="col-md-6"><!-- Start cart -->
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('product.list', $product->category_id) }}" class="float-left mr-2"><i class="fas fa-arrow-alt-circle-left"></i></a>
                        <h3 class="card-title">Основные данные товара</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 text-right">
                            @if($product->offers->count())
                                <a href="{{route('offer.list', $product->id)}}" class="btn btn-info">Список опций</a>
                                <a href="{{route('offer.create', $product->id)}}" class="btn btn-info ml-1">Добавить опцию</a>
                            @else
                                <a href="{{route('offer.create', $product->id)}}" class="btn btn-default">Добавить опции</a>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="active" name="active" @if($product->active) checked @endif>
                                <label for="active" class="custom-control-label">Товар активен</label>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-6">

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" name="hit" id="hit"  type="checkbox" @if($product->hit) checked @endif>
                                        <label class="custom-control-label" for="hit" >Популярный</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" name="new" id="new" type="checkbox" @if($product->new) checked @endif>
                                        <label class="custom-control-label" for="new">Новинка</label>
                                    </div>
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="form-group toggle">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" name="stock" id="stock"  type="checkbox" @if($product->stock) checked @endif>
                                        <label class="custom-control-label" for="stock">Товар со скидкой</label>
                                    </div>
                                </div>

                                <div class="form-group toggle">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" name="advice" id="advice" type="checkbox" @if($product->advice) checked @endif>
                                        <label class="custom-control-label" for="advice">Советуем</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-2">
                                <input type="number" class="form-control @error('sort') is-invalid @enderror" id="sort" name="sort" value="{{$product->sort}}">
                            </div>
                            <label for="sort" class="col-sm-4 col-form-label">Сортировка</label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="art_number"  name="art_number"  value="{{$product->art_number}}">
                            </div>
                            <label for="art_number" class="col-sm-2 col-form-label">Артикул</label>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-12 col-form-label">Название товра</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="slug" class="col-sm-12 col-form-label">Символьный код товара</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $product->slug) }}">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="category_id">Родительская категория</label>
                            <select name="category_id" class="form-control">
                                @php
                                    if($product->category_id == NULL){
                                        echo '<option  value="NULL" selected >-&ensp; Нет категории</option>';
                                        } else {
                                            echo '<option  value="NULL" class="text-black-50">-&ensp; Нет категории</option>';
                                        }
                                        $traverse = function ($categories, $prefix = '-&ensp;', $category_id = 'NULL') use (&$traverse) {
                                            foreach ($categories as $category) {
                                                $selected = ($category_id == $category->id) ? 'selected' : '';
                                                echo '<option  value="'.$category->id.'"'.$selected.'>'.PHP_EOL.$prefix.' '.$category->name.'</option>';
                                                $traverse($category->children, $prefix.'-&ensp;', $category_id);
                                            }
                                         };
                                        $traverse($categories, '-&ensp;', $product->category_id);
                                @endphp
                            </select>
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
                                        <input type="text" class="form-control" name="base_price" id="base_price" value="{{ old('base_price', $product->base_price) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="price" class="col-sm-3 col-form-label">Валюта</label>
                                    <div class="col-sm-9">
                                        <select name="currency"  class="form-control">
                                            <option value="RUB" @if($product->currency == "RUB") selected @endif>RUB - Российский рубль </option>
                                            @foreach($currency as $curItem)
                                                <option value="{{$curItem->currency}}" @if($product->currency == $curItem->currency) selected @endif>{{$curItem->currency}} - {{$curItem->Name}}</option>
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


                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Аксессуры для товара (HTML)</h3>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="summary">Данные об аксессуарах для товара</label>
                                <textarea class="form-control" id="accessory" name="accessory" rows="5" placeholder="HTML table...">{{ old('accessory', $product->accessory) }}</textarea>
                            </div>
                        </div>
                        <div class="card-footer clearfix"><p></p></div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Документы для товара</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12" id="Docs">
                                <label for="doc" class="col-sm-6 col-form-label">ID Документа</label>
                                @forelse ($product->documents as $document)
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control mb-2 @error('doc') is-invalid @enderror"  name="doc[]"   value="{{ $document->id }}">
                                    </div>
                                @empty
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control mb-2 @error('doc') is-invalid @enderror"  name="doc[]"   value="{{ old('doc[]') }}">
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        <div class="row pt-2">
                            <div class="col-6"><button class="btn btn-outline-secondary btn-sm" id="addDoc">Добавить</button></div>
                        </div>
                    </div>
                    <div class="card-footer clearfix"><p></p></div>
                </div><!-- END DOCUMENTS -->
            </div><!-- END ROW -->


            <div class="col-md-6 d-flex align-items-stretch"><!-- Новый ряд - правый -->

                <div class="card flex-fill">
                    <div class="card-header">
                        <h3 class="card-title">Характеристики товара</h3>
                    </div>
                    <div class="card-body">
                        <div id="propertiesList">
                            @if($properties)
                                @foreach ($properties as $key=>$property)
                                    <div class="form-group row">
                                        <div class="col-sm-6 text-lg-right">
                                            <input type="text" name="properties[{{ $key }}][name]" value="{{ old('properties['.$key.'][name]', $property['name']) }}" class="form-control">
                                        </div>
                                        <div class="col-sm-6 d-flex align-items-center">
                                            <input type="text" name="properties[{{ $key }}][value]" value="{{ old('properties['.$key.'][value]', $property['value']) }}" class="form-control">
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="row pt-3">
                            <div class="col-6"><button class="btn btn-outline-secondary btn-sm" id="addProperties">Добавить</button></div>
                        </div>
                        <template id="tmplProperty">
                            <div class="form-group row">
                                <div class="col-sm-6 text-lg-right">
                                    <input type="text" name=""  class="form-control name" placeholder="Название...">
                                </div>
                                <div class="col-sm-6 d-flex align-items-center">
                                    <input type="text" name="" class="form-control value" placeholder="Значение...">
                                </div>
                            </div>
                        </template>
                    </div>
                    <div class="card-footer clearfix"><p></p>
                    </div>
                </div><!-- END Характеристики товара -->

            </div><!-- END ROW col-6 -->
        </div><!-- END ROW col-12 -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">META данные товара</h3>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="h1">Заголовок H1</label>
                            <input type="text" class="form-control" id="h1" name="h1" value="{{ old('h1', $product->h1) }}">
                        </div>

                        <div class="form-group">
                            <label for="meta_title">META Title</label>
                            <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title', $product->meta_title) }}">
                        </div>


                        <div class="form-group">
                            <label for="meta_keywords">META Title</label>
                            <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $product->meta_keywords) }}">
                        </div>

                        <div class="form-group">
                            <label for="meta_description">META Description</label>
                            <textarea class="form-control" id="meta_description" name="meta_description" rows="3">{{ old('meta_description', $product->meta_description) }}</textarea>
                        </div>

                    </div>
                    <div class="card-footer clearfix"><p></p>
                    </div>
                </div>
            </div><!-- END META  -->

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Описание товара</h3>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="summary">Краткое описание товара</label>
                            <textarea class="form-control" id="summary" name="summary" rows="3" placeholder="Краткое описание товара...">{{ old('summary', $product->summary) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">Описание товара</label>
                            <textarea class="form-control" id="description" name="description" rows="7" placeholder="Описание товара...">{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer clearfix"><p></p></div>
                </div>
            </div>
        </div><!-- END ROW col-12 -->
        <button type="submit" class="btn btn-primary mt-3">Применить</button>
    </form>



@endsection

@section('scripts')
    <script>

        let img ="{{$product->img ? $product->img : ''}}";
        let preview =  "{{$product->preview ? $product->preview : ''}}";
        let count = 1;
        let namber = 100;

        document.getElementById('addDoc').addEventListener('click', function (e){
            e.preventDefault();
            document.getElementById('Docs').insertAdjacentHTML('beforeend', '<div class="col-sm-3"><input type="number" class="form-control mb-2"  name="doc[]"   value=""></div>');
        });

        document.getElementById('addProperties').addEventListener('click', function (e){
            e.preventDefault();
            let tmpl = tmplProperty.content.cloneNode(true);
            tmpl.querySelector('.name').setAttribute('name', 'properties['+namber+'][name]');
            tmpl.querySelector('.value').setAttribute('name', 'properties['+namber+'][value]');
            namber++;
            document.getElementById('propertiesList').append(tmpl);
        })

        Dropzone.autoDiscover = false;
        let myDropzone = new Dropzone("#imageDropzone",
            {
                url: '{{route('product.update.img')}}',
                headers: {'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content},
                method: 'POST',
                maxFilesize: 2,
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 60000,
                params: {
                    id: {{$product->id}}
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
                url: '{{route('product.update.preview')}}',
                headers: {'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content},
                method: 'POST',
                maxFilesize: 2,
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 60000,
                params: {
                    id: {{$product->id}}
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
                    url: "{{route('product.update.img.remove')}}",
                    type: 'POST',
                    data: {
                        _token: document.querySelector('meta[name=csrf-token]').content,
                        type: type,
                        id: '{{$product->id}}',
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
                url: '{{route('product.update.images')}}',
                headers: {'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content},
                method: 'POST',
                paramName: 'image',
                //uploadMultiple: true,
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 60000,
                params: {
                    product_id: {{$product->id}}
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
                    url: '{{route('product.update.images.remove')}}',
                    type: 'POST',
                    data: {
                        _token: document.querySelector('meta[name=csrf-token]').content,
                        path: path,
                        product_id: '{{$product->id}}',
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
