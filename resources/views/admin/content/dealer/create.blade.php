@extends('admin.layouts.layout')

@section('title', 'Админ-панель - создание новых нового дилера - регионального представителя')
@section('h1', 'Новая региональный пертнер')
@section('breadcrumbs')
    {{ Breadcrumbs::render('dealer.create') }}
@endsection
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

    <form role="form" method="post" action="{{ route('dealer.store') }}">
        @csrf
        <div class="row">

            <div class="col-md-6"><!-- Start cart -->
                <div class="card">
                    <div class="card-header">
                        <a href="{{route('dealer.index')}}" class="float-left mr-2"><i class="fas fa-arrow-alt-circle-left"></i></a>
                        <h3 class="card-title">Общие данные</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="active" name="active" checked="">
                                <label for="active" class="custom-control-label">Дилер активен</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sort" class="col-sm-2 col-form-label">Сортировка</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control @error('sort') is-invalid @enderror" id="sort"  name="sort" value="50" placeholder="50">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Наименование</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"   value="{{ old('name') }}" placeholder="Название партнера">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="slug" class="col-sm-2 col-form-label">URL - чпу slag</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}">
                            </div>
                        </div>

                        <div class="form-group  col-md-6">
                            <div class="form-group">
                                <label for="region_id">Регион партнера</label>
                                <select class="form-control select2" name="region_id" style="width: 100%;">
                                    @foreach($regions as $region)
                                        <option value="{{$region->id}}" @if($loop->index == 0)selected="selected" @endif>{{$region->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="address" class="col-sm-2 col-form-label">Адрес</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address"   value="{{ old('address') }}" placeholder="Адресс магазина">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="time" class="col-sm-2 col-form-label">Время работы</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('time') is-invalid @enderror" id="time" name="time"   value="{{ old('time') }}" placeholder="Время работы">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-sm-2 col-form-label">Телефон</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"   value="{{ old('phone') }}" placeholder="Телефон">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="site" class="col-sm-2 col-form-label">Сайт</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('site') is-invalid @enderror" id="site" name="site"   value="{{ old('site') }}" placeholder="www.pechnik.su">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mail" class="col-sm-2 col-form-label">E-mail address</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('mail') is-invalid @enderror" id="mail" name="mail"   value="{{ old('mail') }}" placeholder="E-mail">
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <p></p>
                    </div><!-- /.card-footer-->
                </div>
            </div>



            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">SEO данные партнера</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="form-group">
                            <label for="h1">Заголовок H1</label>
                            <input type="text" class="form-control" id="h1" name="h1" value="{{ old('h1') }}" placeholder="Заголовок H1">
                        </div>

                        <div class="form-group">
                            <label for="meta_title">Meta TITLE</label>
                            <input class="form-control"  name="meta_title" value="{{ old('meta_title') }}" placeholder="Enter ...">
                        </div>


                        <div class="form-group">
                            <label for="meta_keywords">Meta KEYWORDS</label>
                            <input class="form-control"  name="meta_keywords" value="{{ old('meta_keywords') }}" placeholder="Enter ...">
                        </div>
                        <div class="form-group">
                            <label for="meta_description">Meta DESCRIPTION</label>
                            <textarea class="form-control" rows="3" name="meta_description" placeholder="Enter ...">{{ old('meta_description') }}</textarea>
                        </div>

                    </div>
                    <div class="card-footer clearfix">
                        <p></p>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Описание партнера</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <textarea class="form-control" rows="7" name="description" id="description">{!! old('description') !!}</textarea>
                        </div>

                    </div>
                    <div class="card-footer clearfix">
                        <p></p>
                    </div>
                </div>
            </div>

        </div><!-- /.END ROW -->

        <button type="submit" class="btn btn-primary mb-5">Применить</button>
    </form>
@endsection
@section('scripts')
    <script>
        $('.select2').select2();
    </script>
@endsection
