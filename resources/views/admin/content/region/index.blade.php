@extends('admin.layouts.layout')

@section('title', 'Админ-панель - регоны России, региональные дилеры')
@section('h1', 'Регионы, регионы продаж')
@section('breadcrumbs')
    {{ Breadcrumbs::render('region.index') }}
@endsection

@section('content')
    <div class="col-md-9 mb-3">
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
                <a href="{{route('region.create')}}" type="button" class="btn btn-primary mb-3">Добавить</a>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px" class="text-center">N</th>
                        <th>Название региона</th>
                        <th style="width: 100px" class="text-center">Дилеры</th>
                        <th style="width: 40px" class="text-center">Редактирование</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($regions as $region)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td>{{$region->name}}</td>
                            <td class="text-center">
                                @if($region->quantity == 0)
                                    <span class="pale-icon"><i class="far fa-check-circle"></i></span>
                                @else
                                 {{ $region->quantity }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('region.edit', $region->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
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
            <div class="pb-3">{{ $regions->links() }}</div>
    </div>
@endsection

