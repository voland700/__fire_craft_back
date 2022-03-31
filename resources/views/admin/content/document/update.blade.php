@extends('admin.layouts.layout')

@section('title', 'Админ-панель - редактирование файлов докумнтации')
@section('h1', 'Редактирование файлов документации')
@section('breadcrumbs')
    {{ Breadcrumbs::render('document.edit', $document) }}
@endsection
@section('content')
    <div class="col-md-6">
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


        <div class="card">
            <div class="card-header">
                <a href="{{route('document.index')}}" class="float-left mr-2"><i class="fas fa-arrow-alt-circle-left"></i></a>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form id="update" role="form" method="post" action="{{ route('document.update', $document->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        @if($document->file)
                        <div class="col-md-12 mb-3" id="DocInfo">
                            <div class="doc_file_wrap">
                                <a href="{{asset($document->file)}}" target="_blank" class="doc_file_icon"></a>
                                <a href="{{asset($document->file)}}" target="_blank" class="doc_file_name" id="DocPath">{{basename($document->file)}}</a>
                            </div>
                        </div>
                        @endif
                        <div class="form-group col-md-6">
                            <label for="exampleInputFile">Файл документа</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="file" value="{{$document->file}}" class="custom-file-input @error('file') is-invalid @enderror" id="file">
                                    <label class="custom-file-label" for="file">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-12 col-form-label">Описание документа</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{$document->name}}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Применить</button>

                </form>


            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <p></p>
            </div>
            <!-- /.card-footer-->
        </div>
    </div>
@endsection
