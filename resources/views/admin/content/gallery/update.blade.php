@extends('admin.layouts.layout')
@section('title', 'Админ-панель - страница редактирование слайда')
@section('h1', 'Реактировать слайд')
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
    <form id="updateForm" role="form" method="post" action="{{ route('gallery.update', $gallery->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="col-md-6">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <a href="{{route('gallery.index')}}" class="float-left mr-2"><i class="fas fa-arrow-alt-circle-left"></i></a>
                    <h3 class="card-title">Данные слайда</h3>
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


                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="active" name="active" {{($gallery->active == 1) ? 'checked=""' : ''}}>
                            <label for="active" class="custom-control-label">Слайд активен</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="sort" class="col-sm-2 col-form-label">Сортировка</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control @error('sort') is-invalid @enderror" id="sort"  name="sort" value="{{$gallery->sort}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Наименование</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{$gallery->name}}">
                        </div>
                    </div>

                    <input type="hidden" name="img" value="{{$gallery->img}}" id="img">

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="imageDropzone">Изображение слайда</label>
                            <div class="dropzone" id="imageDropzone"></div>
                        </div>
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

@section('scripts')
    <script>
        const img = document.getElementById('img');
        let imgPath = @if(count($img)>0) '{{$img['path']}}' @else null @endif;

        Dropzone.autoDiscover = false;
        new Dropzone("#imageDropzone",
            {
                url: '{{route('gallery.img.update')}}',
                headers: {'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content},
                method: 'POST',
                maxFilesize: 1,
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 60000,
                params: {
                    id: {{$gallery->id}}
                },
                @if(count($img)>0)
                init: function () {
                    let imageDropzone = this;
                    let mockFile = {name: "{{ $img['name'] }}", size: Number("{{$img['size']}}")};
                    imageDropzone.displayExistingFile(mockFile, "{{ asset( $img['path']) }}" );
                },
                @endif
                removedfile: function(file){
                    file.previewElement.remove();
                    img.value=null;
                    RemoveImgFile(imgPath);
                    imgPath = null;
                },
                success: function (file, response) {
                    //console.log(response.success);
                    imgPath = response.success;
                    img.value = response.success;
                },
                error: function (file, response) {
                    console.log(response);
                    //return false;
                }
            });

        function RemoveImgFile(path){
            $.ajax(
                {
                    url: "/admin/gallery-img-update-remove",
                    type: 'POST',
                    data: {
                        _token: document.querySelector('meta[name=csrf-token]').content,
                        path: path,
                        id: {{$gallery->id}},
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
