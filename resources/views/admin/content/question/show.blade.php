@extends('admin.layouts.layout')

@section('title', 'Админ-панель - Вопрос пользователя')
@section('h1', 'Вопрос пользователя')
@section('breadcrumbs')
    {{ Breadcrumbs::render('question.show', $question) }}
@endsection
@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <a href="{{route('question.index')}}" class="float-left mr-2"><i class="fas fa-arrow-alt-circle-left"></i></a>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <ul>
                    <li><b>Имя:</b> {{ $question->name }}</li>
                    <li><b>E-mail: </b> {{ $question->email }}</li>
                    <li><b>Дата:</b> {{ $question->created_at }}</li>
                    <li><b>Вопрос:</b></li>
                    <div>{{ $question->text }}</div>
                </ul>
            </div>
            <div class="card-footer">
                <p></p>
            </div>
        </div>
    </div>
@endsection
