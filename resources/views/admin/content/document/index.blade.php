@extends('admin.layouts.layout')

@section('title', 'Админ-панель - Документация, файлы дкументов')
@section('h1', 'Файлы документов')
@section('breadcrumbs')
    {{ Breadcrumbs::render('document.index') }}
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
                <a href="{{route('document.create')}}" type="button" class="btn btn-primary mb-3">Добавить</a>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px" class="text-center">N</th>
                        <th>Описание документа</th>
                        <th style="width: 100px" class="text-center">Файл</th>
                        <th style="width: 30px" class="text-center">ID</th>
                        <th style="width: 40px" class="text-center">Редактирование</th>

                  </tr>
                    </thead>
                    <tbody>
                    @foreach ($documents as $document)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td>{{$document->name}}</td>
                            <td class="text-center"><a href="{{asset($document->file)}}" target="_blank">{{basename($document->file)}}</a></td>
                            <td class="text-center">{{$document->id}}</td>
                            <td>
                                <a href="{{ route('document.edit', $document->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                <form method="POST" action="{{ route('document.destroy', $document->id) }}" class="formDelete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm delete" onclick="return confirm('Подтвердите удаление')"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
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

