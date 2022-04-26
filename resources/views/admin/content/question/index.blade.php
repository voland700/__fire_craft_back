@extends('admin.layouts.layout')
@section('title', 'Админ-панель - Вопросы посетителей, список вопросов')
@section('h1', 'Вопросы пользователей ')
@section('breadcrumbs')
    {{ Breadcrumbs::render('question.index') }}
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
               <p></p>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 50px">№</th>
                        <th style="width: 120px">Дата</th>
                        <th style="width: auto">Имя</th>
                        <th style="width: 200px;">E-mail</th>
                        <th style="width: 100px">Редакт.</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($questions as $question)
                        <tr>
                            <td class="text-center">
                                @if($question->shown == 0)
                                    <span class="new-icon"><i class="fas fa-circle fa-xs"></i></span>
                                @else
                                    <span class="old-icon"><i class="far fa-circle fa-xs"></i></span>
                                @endif
                                {{$question->id}}</td>
                            <td>{{$question->created_at}}</td>
                            <td>{{$question->name}}</td>
                            <td style="font-weight: 500">{{$question->email}}</td>
                            <td>
                                <a href="{{ route('question.show', $question->id) }}" class="btn btn-info btn-sm"><i class="far fa-eye"></i></a>
                                <form method="POST" action="{{ route('question.destroy', $question->id) }}" class="formDelete">
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
        <div class="pb-4">{{$questions->links() }}</div>
    </div>
@endsection

