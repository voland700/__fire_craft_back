@extends('admin.layouts.layout')

@section('title', 'Админ-панель - Каталог товаров, разделы и товары каталога')
@section('h1', 'Каталог товаров')

@section('content')
    <div class="col-md-12">
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
                <a href="{{route('product.create', $id)}}" type="button" class="btn btn-primary mb-3">Создать товар</a>
                <a href="{{route('category.create')}}" type="button" class="btn btn-primary mb-3">Создать раздел</a>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">Тип</th>
                        <th>Название</th>
                        <th style="width: 20px">Опции</th>
                        <th style="width: 20px">Active</th>
                        <th style="width: 20px">Sort</th>
                        <th  style="width: 10px">ID</th>
                        <th style="width: 120px">Редактировать</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($id !== null)
                        <tr>
                            <td class="text-center"><a href="{{ route('product.list', $parentId) }}"><i class="fas fa-arrow-alt-circle-left"></i></a></td>
                            <td colspan="5"></td>
                        </tr>
                    @endif
                    @foreach ($categories as $category)
                        <tr>
                            <td class="text-center"><i class="far fa-folder"></i></td>
                            <td><a href="{{ route('product.list', $category->id) }}" class="mr-3">{{$category->name}}</a></td>
                            <td></td>
                            <td>
                                @if ($category->active === 0)
                                    <span class="pale-icon"><i class="far fa-check-circle"></i></span>
                                @endif
                                @if ($category->active === 1)
                                    <span class="green-icon"><i class="far fa-check-circle"></i></span>
                                @endif
                            </td>
                            <td>{{$category->sort}}</td>
                            <td>{{$category->id}}</td>
                            <td>
                                <a href="{{ route('category.edit', $category->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                <form method="POST" action="{{ route('category.destroy', $category->id) }}" class="formDelete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm delete" onclick="return confirm('Подтвердите удаление')"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                        @if(count($category->children)>0)
                            @foreach ($category->children as $childCategory)
                                @include('admin.catalog.product.child_categories_list', ['childCategory' => $childCategory])
                            @endforeach
                        @endif
                    @endforeach
                    @if($products)
                        @foreach($products as $product)
                            <tr>
                                <td class="text-center"><i class="fas fa-shopping-bag"></i></td>
                                <td><a href="{{route("product.edit", $product->id)}}">{{$product->name}}</a></td>
                                <td>
                                    @if(!$product->offers->isEmpty())
                                        <a href="{{route("offer.list", $product->id)}}" class="green-icon"><i class="fas fa-exclamation-circle"></i></a>
                                    @endif
                                </td>
                                <td>
                                    @if ($product->active === 0)
                                        <span class="pale-icon"><i class="far fa-check-circle"></i></span>
                                    @endif
                                    @if ($product->active === 1)
                                        <span class="green-icon"><i class="far fa-check-circle"></i></span>
                                    @endif
                                </td>
                                <td class="text-center">{{$product->sort}}</td>
                                <td class="text-center">{{$product->id}}</td>
                                <td>
                                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                    <form method="POST" action="{{ route('product.destroy', $product->id) }}" class="formDelete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm delete" onclick="return confirm('Подтвердите удаление')"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <p></p>
            </div>
            <!-- /.card-footer-->
        </div>
        {{ $products->links() }}
    </div>
@endsection
