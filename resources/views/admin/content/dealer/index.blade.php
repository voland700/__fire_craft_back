@extends('admin.layouts.layout')

@section('title', 'Админ-панель - Список региональных дилеров, партнеров')
@section('h1', 'Список дилеров')
@section('breadcrumbs')
    {{ Breadcrumbs::render('dealer.index') }}
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
                <a href="{{route('dealer.create')}}" type="button" class="btn btn-primary mb-3">Добавить</a>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 20px">№</th>
                        <th>Название</th>
                        <th style="width: 200px">Регион</th>
                        <th style="width: 20px">Active</th>
                        <th style="width: 120px">Редактировать</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($dealers as $dealer)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td>{{$dealer->name}}</td>
                            <td class="text-center" style="font-size: .85rem">{{$dealer->region->name}}</td>
                            <td class="text-center">
                                @if ($dealer->active === 0)
                                    <span class="pale-icon"><i class="far fa-check-circle"></i></span>
                                @endif
                                @if ($dealer->active === 1)
                                    <span class="green-icon"><i class="far fa-check-circle"></i></span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('dealer.edit', $dealer->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                <form method="POST" action="{{ route('dealer.destroy', $dealer->id) }}" class="formDelete">
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
            <div class="pb-4">{{ $dealers->links() }}</div>
    </div>
@endsection

