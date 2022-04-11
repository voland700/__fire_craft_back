@extends('admin.layouts.layout')

@section('title', 'Админ-панель - страница создания новой скидки для товаров')
@section('h1', 'Новая скидка для товаров')
@section('breadcrumbs')
    {{ Breadcrumbs::render('discounts.edit', $discount) }}
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

<form role="form" action="{{ route('discounts.update', $discount->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">

        <div class="col-md-9"><!-- Start cart -->
            <div class="card">
                <div class="card-header">
                    <a href="{{route('discounts.index')}}" class="float-left mr-2"><i class="fas fa-arrow-alt-circle-left"></i></a>
                    <h3 class="card-title">Данные скидки</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="custom-control custom-checkbox mb-3">
                                <input class="custom-control-input" type="checkbox" id="active" name="active" @if($discount->active) checked @endif >
                                <label for="active" class="custom-control-label">Скидка активна</label>
                            </div>

                            <div class="form-group col-2">
                                <label for="sort">Сортировка</label>
                                <input type="namber" class="form-control" id="sort" name="sort" value="{{$discount->sort}}">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="name">Наименование скидки</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$discount->name}}" required>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="type">Тип скидки</label>
                                    <select name="type" class="form-control">
                                        <option value="percent" @if($discount->type == 'percent') selected @endif>В процентах</option>
                                        <option value="fixed" @if($discount->type == 'fixed') selected @endif>Фиксированная сумма</option>
                                        <option value="cost" @if($discount->type == 'cost') selected @endif>Установить цену на товар</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="value">Значение скидки</label>
                                    <input type="text" class="form-control @error('value') is-invalid @enderror" name="value" value="{{$discount->value}}" required pattern="[0-9]+" title="Размер скидки - целое число">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group  col-md-6">
                                    <label for="kind">Условия скидки</label>
                                    <select name="kind" id="choiceGoods" class="form-control">
                                        <option value="goods" @if($discount->kind == 'goods') selected @endif>Скидка на товары</option>
                                        <option value="category" @if($discount->kind == 'category') selected @endif>Скидка на категорию</option>
                                    </select>
                                </div>
                                <div class="form-group  col-md-6">
                                    <label for="type">Выбрать</label>
                                    <div>
                                        <button type="button" class="btn btn-default" onclick="return ChangeUpdateGoods(this);">Выбор</button>
                                    </div>
                                </div>
                            </div>

                        </div><!-- ./COL-MD-6 -->
                        <div class="col-md-6">
                            <div class="container">
                                <div class="discount-list">
                                    <h5>Список выбранных элементов каталога</h5>
                                    <ul class="d_list" id="GoodsList">
                                        @if(count($products))
                                            @foreach($products as $product)
                                                <li>{{$product->name}}<span class="d_id">({{$product->id}})</span><span class="d_btn-del" onclick="return RemoveElem(this);">×</span><input type="hidden" name="productsID[]" value="{{$product->id}}" class="d_input"></li>
                                            @endforeach
                                        @endif
                                        @if(count($offers))
                                            @foreach($offers as $offer)
                                                <li><span class="d-offer_item">offer:</span>{{$offer->name}}<span class="d_id">({{$offer->id}})</span><span class="d_btn-del" onclick="return RemoveElem(this);">×</span><input type="hidden" name="offersID[]" value="{{$offer->id}}" class="d_offer_input"></li>
                                            @endforeach
                                        @endif
                                        @if($categories)
                                            @foreach($categories as $category)
                                                <li>{{$category->name}}<span class="d_id">({{$category->id}})</span><span class="d_btn-del" onclick="return RemoveElem(this);">×</span><input type="hidden" name="productsID[]" value="{{$category->id}}" class="d_input"></li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!-- ./Card row -->
                </div><!-- ./CARD-BODY -->
                <div class="card-footer clearfix">
                    <p></p>
                </div>
            </div>
        </div>

    </div><!-- /.END ROW -->

    <button type="submit" class="btn btn-primary mt-3 mb-5 ml-3">Обновить</button>
</form>

<div class="modal fade" id="modal-xl" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Выбор товаров для скидок</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="modalBody">

            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modalCategory" style="display: none; padding-right: 17px;" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Выбор категорий каталога</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="modalBodyCategories">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnChoiceCategoriesUpdate">Выбрать</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection

@section('scripts')
<script>

    function RemoveElem(e) {
        e.parentNode.remove();
    }

    function ChangeUpdateGoods(){
        let kind = document.getElementById('choiceGoods').value;
        let arrItemsId = [];
        let arrOffersId = [];

        document.querySelectorAll('.d_input').forEach(function (item) {
            arrItemsId.push(Number(item.value));
        });
        document.querySelectorAll('.d_offer_input').forEach(function (item) {
            arrOffersId.push(Number(item.value));
        });
        //console.log(arrItemsId);
        $.ajax(
            {
                url: '{{route('discounts.goods.update')}}',
                type: 'POST',
                data: {
                    _token: document.querySelector('meta[name=csrf-token]').content,
                    'kind': kind,
                    'items_id': arrItemsId,
                    'offers_id': arrOffersId,
                },
                success: function (response) {
                    switch (kind) {
                        case 'goods':
                            let modalBody = document.getElementById('modalBody');
                            modalBody.innerHTML = response;
                            $('#modal-xl').modal('show');
                            choiceGoods();
                            selectionGoodsUpdate();
                            document.querySelectorAll('.d_update').forEach(function (item) {
                                item.addEventListener('click', ChoiceGoodsCategoryUpdate);
                            });
                            discountPaginateUpdate();
                            //selectionGoods();
                            //discountPaginate();//OLD- replace/
                            break;
                        case 'category':
                            const modalBodyCategories = document.getElementById('modalBodyCategories');
                            modalBodyCategories.innerHTML = response;
                            $('#modalCategory').modal('show');
                            document.getElementById('btnChoiceCategoriesUpdate').addEventListener('click', updateCategories);
                            break;
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            });
        //menu categories 0pen/closed
        function choiceGoods() {
            document.querySelectorAll('.d_label').forEach(function (item) {
                item.addEventListener('click', function(e){
                    let elem = e.target;
                    let ul = elem.parentNode.nextElementSibling;
                    if(elem.classList.contains('d_label-closed')){
                        elem.classList.remove('d_label-closed');
                        elem.classList.add('d_label-open');
                    }
                    else if(elem.classList.contains('d_label-open')){
                        elem.classList.remove('d_label-open');
                        elem.classList.add('d_label-closed');
                    }
                    if(ul.classList.contains('d_closed')){
                        ul.classList.remove('d_closed');
                        ul.classList.add('d_open');
                    }
                    else if(ul.classList.contains('d_open')){
                        ul.classList.remove('d_open');
                        ul.classList.add('d_closed');
                    }
                });
            });
        }

        //Переделать ---

        function selectionGoodsUpdate(){
            const GoodsList =document.getElementById('GoodsList');
            function createElem(id, name, type){
                let li = document.createElement("li");
                let btn = document.createElement("span");
                let namberId = document.createElement("span");
                let input = document.createElement("input");
                input.setAttribute('type', 'hidden');
                input.setAttribute('name', `productsID[]`);
                input.setAttribute('value', id);
                if(type == 'product') input.setAttribute('name', `productsID[]`);
                if(type == 'offer') input.setAttribute('name', `offersID[]`);
                input.className = "d_input";
                namberId.className = "d_id";
                namberId.innerText = '['+id+']';
                btn.className = "d_btn-del";
                btn.innerText = '×';
                btn.addEventListener('click', function(){
                    if(type == 'product'){
                        arrItemsId.splice(arrItemsId.indexOf(id),1);
                    }
                    if(type == 'offer'){
                        arrOffersId.splice(arrOffersId.indexOf(id),1);
                    }
                    this.parentNode.remove();
                });
                if(type == 'product') li.innerText = name;
                if(type == 'offer') li.innerHTML = '<span class="d-offer_item">offer:</span> '+name;
                li.append(namberId);
                li.append(btn);
                li.append(input);
                GoodsList.append(li);
            }


            document.querySelectorAll('.d-link').forEach(function (item) {
                item.addEventListener('click', function(e){
                    let elem = e.currentTarget;
                    let id = elem.getAttribute('data-id');
                    let name = elem.getAttribute('data-name');
                    let type = elem.getAttribute('data-type');

                    if(elem.classList.contains('d-link') && !elem.classList.contains('d-active')) {
                        elem.classList.toggle('d-link');
                        elem.classList.toggle('d-active');
                        if(type == 'product'){
                            if(!arrItemsId.includes(Number(id))){
                                arrItemsId.push(Number(id));
                                createElem(id, name, type);
                            }
                            return false;
                        }
                        if(type == 'offer'){
                            if(!arrOffersId.includes(Number(id))){
                                arrOffersId.push(Number(id));
                                createElem(id, name, type);
                            }
                            return false;
                        }

                    }
                });
            });


        }

        function updateCategories(){
            document.getElementById('GoodsList').innerText = '';
            getCategories()
        }

        function  getCategories(){
            let selected = Array.from(FormChoice.options).filter(option => option.selected);
            //.map(option => option.value);
            const GoodsList =document.getElementById('GoodsList');
            selected.forEach(function (item) {
                let id = item.value;
                let name = item.getAttribute('data-name');
                let li = document.createElement("li");
                let btn = document.createElement("span");
                let namberId = document.createElement("span");
                let input = document.createElement("input");
                input.setAttribute('type', 'hidden');
                input.setAttribute('name', `productsID[]`);
                input.setAttribute('value', id);
                namberId.className = "d_id";
                namberId.innerText = '('+id+')';
                btn.className = "d_btn-del";
                btn.innerText = '×';
                btn.addEventListener('click', function(){
                    selected.splice(selected.indexOf(id),1);
                    this.parentNode.remove();
                });
                li.innerText = name;
                li.append(namberId);
                li.append(btn);
                li.append(input);
                GoodsList.append(li);
            });
            if(!selected.length == 0){
                document.querySelector('.discount-list').style.display = 'block';
                $('#modalCategory').modal('toggle');
            }
        }
        function ChoiceGoodsCategoryUpdate(e) {
            e.preventDefault();
            let elem = e.currentTarget;
            let id = elem.getAttribute('data-id');
            let DiscountContemt = document.getElementById('DiscountContemt');
            $.ajax(
                {
                    url: '{{route('discounts.choice.categories.update')}}',
                    type: 'POST',
                    data: {
                        _token: document.querySelector('meta[name=csrf-token]').content,
                        'id': id,
                        itemsId: arrItemsId,
                    },
                    success: function (response) {
                        //location.reload();
                        //console.log(response);
                        DiscountContemt.innerHTML = response;
                        selectionGoodsUptate();
                        discountPaginateUpdate();
                    },
                    error: function (response) {
                        console.log(response);
                    }
                });
        }

        function discountPaginateUpdate(e) {
            let arrItemsId = [];
            document.querySelectorAll('.d_input').forEach(function (item) {
                arrItemsId.push(Number(item.value));
            });
            document.querySelectorAll('.d_pag').forEach(function (item) {
                item.addEventListener('click', function (e) {

                    const DiscountContemt = document.getElementById('DiscountContemt');
                    e.preventDefault();
                    let elem = e.currentTarget;
                    let category = elem.getAttribute('data-category');
                    let page = elem.getAttribute('data-page');
                    $.ajax(
                        {
                            url: '{{route('discounts.update.paginate')}}',
                            type: 'POST',
                            data: {
                                _token: document.querySelector('meta[name=csrf-token]').content,
                                'page': page,
                                'category': category,
                                itemsId: arrItemsId,
                            },
                            success: function (response) {
                                DiscountContemt.innerHTML = response;
                                selectionGoodsUptate();
                                discountPaginateUpdate();
                            },
                            error: function (response) {
                                console.log(response);
                            }
                        });
                });
            });
        }
    }


</script>
@endsection
