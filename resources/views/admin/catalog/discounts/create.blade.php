@extends('admin.layouts.layout')

@section('title', 'Админ-панель - страница создания новой скидки для товаров')
@section('h1', 'Новая скидка для товаров')
@section('breadcrumbs')
    {{ Breadcrumbs::render('discounts.create') }}
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

<form id="create" role="form" method="post" action="{{ route('discounts.store') }}">
    @csrf
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
                                <input class="custom-control-input" type="checkbox" id="active" name="active" checked="">
                                <label for="active" class="custom-control-label">Скидка активна</label>
                            </div>

                            <div class="form-group col-2">
                                <label for="sort">Сортировка</label>
                                <input type="namber" class="form-control" id="sort" name="sort" value="10" placeholder="10">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="name">Наименование скидки</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" placeholder="Наименование скидки" required>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="type">Тип скидки</label>
                                    <select name="type" class="form-control">
                                        <option value="percent">В процентах</option>
                                        <option value="fixed">Фиксированная сумма</option>
                                        <option value="cost">Установить цену на товар</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="value">Значение скидки</label>
                                    <input type="text" class="form-control @error('value') is-invalid @enderror" name="value" value="" placeholder="Ввидите сумму" required pattern="[0-9]+" title="Размер скидки - целое число">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group  col-md-6">
                                    <label for="kind">Условия скидки</label>
                                    <select name="kind" id="choiceGoods" class="form-control">
                                        <option value="goods">Скидка на товары</option>
                                        <option value="category">Скидка на категорию</option>
                                    </select>
                                </div>
                                <div class="form-group  col-md-6">
                                    <label for="type">Выбрать</label>
                                    <div>
                                        <button type="button" class="btn btn-default" onclick="return ChangeGoods(this);">Middle</button>
                                    </div>
                                </div>
                            </div>

                        </div><!-- ./COL-MD-6 -->
                        <div class="col-md-6">
                            <div class="container">
                                <div class="discount-list">
                                    <h5>Список выбранных товаров</h5>
                                    <ul class="d_list" id="GoodsList"></ul>
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

    <button type="submit" class="btn btn-primary mt-3">Применить</button>
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
                <button type="button" class="btn btn-primary" id="btnChoiceCategories">Выбрать</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


@endsection

@section('scripts')
<script>

    async function getData(url = '', data = {}) {
        const response = await fetch(url, {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json'
            },
            redirect: 'follow', // manual, *follow, error
            referrerPolicy: 'no-referrer', // no-referrer, *client
            body: JSON.stringify(data) // body data type must match "Content-Type" header
        });
        return await response.text(); // parses JSON response into native JavaScript objects
    }


    function ChangeGoods() {
        let kind = document.getElementById('choiceGoods').value;

        $.ajax(
            {
                url: '{{route('discounts.goods.create')}}',
                type: 'POST',
                data: {
                    _token: document.querySelector('meta[name=csrf-token]').content,
                    'kind': kind
                },
                success: function (response) {
                    switch (kind) {
                        case 'goods':
                            let modalBody = document.getElementById('modalBody');
                            modalBody.innerHTML = response;
                            $('#modal-xl').modal('show');
                            choiceGoods();
                            selectionGoods();
                            discountPaginate();
                            break;
                        case 'category':
                            const modalBodyCategories = document.getElementById('modalBodyCategories');
                            modalBodyCategories.innerHTML = response;
                            $('#modalCategory').modal('show');
                            document.getElementById('btnChoiceCategories').addEventListener('click', getCategories);
                            break;
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            });

        //Категории  - left sidebar
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
    }

    //AJAX - выбор категории
    function ChoiceGoodsCategory(id) {
        let DiscountContemt = document.getElementById('DiscountContemt');
        $.ajax(
            {
                url: '{{route('discounts.choice.categories')}}',
                type: 'POST',
                //type: 'GET',
                data: {
                    _token: document.querySelector('meta[name=csrf-token]').content,
                    'id': id
                },
                success: function (response) {
                    //location.reload();
                    console.log(response);
                    DiscountContemt.innerHTML = response;
                    selectionGoods();
                    discountPaginate();
                },
                error: function (response) {
                    console.log(response);
                }
            });
    }

    //Выбор товара или предложения для скидки
    function selectionGoods(){
        let arrProductID = [];
        let arrOfferID = [];
        document.querySelectorAll('.d-link').forEach(function (item) {
            item.addEventListener('click', function(e){
                let elem = e.currentTarget;
                const GoodsList =document.getElementById('GoodsList');
                if(elem.classList.contains('d-link') && !elem.classList.contains('d-active')){
                    elem.classList.add('d-active');

                    let id = elem.getAttribute('data-id');
                    let name = elem.getAttribute('data-name');
                    let type = elem.getAttribute('data-type');

                    let li = document.createElement("li");
                    let btn = document.createElement("span");
                    let namberId = document.createElement("span");
                    let input = document.createElement("input");

                    input.setAttribute('type', 'hidden');
                    input.setAttribute('value', id);
                    if(type == 'product') input.setAttribute('name', `productsID[]`);
                    if(type == 'offer') input.setAttribute('name', `offersID[]`);

                    namberId.className = "d_id";
                    namberId.innerText = '('+id+')';
                    btn.className = "d_btn-del";
                    btn.innerText = '×';

                    btn.addEventListener('click', function(){
                        if(type == 'product'){
                            arrProductID.splice(arrProductID.indexOf(id),1);
                        }
                        if(type == 'offer'){
                            arrOfferID.splice(arrOfferID.indexOf(id),1);
                        }
                        this.parentNode.remove();
                    });

                    if(type == 'product') li.innerText = name;
                    if(type == 'offer') li.innerHTML = '<span class="d-offer_item">offer:</span> '+name;

                    li.append(namberId);
                    li.append(btn);
                    li.append(input);
                    if(!arrProductID.includes(id) && type == 'product' ){
                        arrProductID.push(id);
                        GoodsList.append(li);
                        document.querySelector('.discount-list').style.display = 'block';
                    }
                    if(!arrOfferID.includes(id) && type == 'offer' ){
                        arrOfferID.push(id);
                        GoodsList.append(li);
                        document.querySelector('.discount-list').style.display = 'block';
                    }
                }

            });
        });
    }





    /*
     function ChoiceGoodsCategory(id){
         let DiscountContent = document.getElementById('DiscountContemt');


         getData('{{route('discounts.choice.categories')}}', {
            _method: "POST",
            _token: document.querySelector('meta[name=csrf-token]').content


            }).then((data) => {
                console.log(data);

            DiscountContemt.innerHTML = data;
            selectionGoods();
            discountPaginate();
        });

        function ProductDown(){
            let product = document.getElementById('product');
            document.getElementById('detailClosed').onclick = function (e){
                e.preventDefault();
                getProductClosed();
            }
            document.getElementById('detailBack').onclick = function (e){
                e.preventDefault();
                getProductClosed();
            }
            function getProductClosed() {
                if (product.classList.contains('show')) {
                    product.classList.toggle('show');
                    product.classList.toggle('hide');
                }
                setTimeout(function () {
                    product.remove();
                }, 700);
            }
        }
    }

*/

/*
    function selectionGoods(){
        let arrID = [];
        document.querySelectorAll('.d_btn').forEach(function (item) {
            item.addEventListener('click', function(e){
                let elem = e.currentTarget;
                const GoodsList =document.getElementById('GoodsList');
                if(elem.classList.contains('btn-default') && !elem.classList.contains('btn-success')){
                    elem.classList.remove('btn-default');
                    elem.classList.add('btn-success');
                }
                let id = elem.getAttribute('data-id');
                let name = elem.getAttribute('data-name');
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
                    arrID.splice(arrID.indexOf(id),1);
                    this.parentNode.remove();
                });
                li.innerText = name;
                li.append(namberId);
                li.append(btn);
                li.append(input);
                if(!arrID.includes(id)){
                    arrID.push(id);
                    GoodsList.append(li);
                    document.querySelector('.discount-list').style.display = 'block';
                }
            });
        });
    }
*/
    function discountPaginate() {
        const DiscountContemt = document.getElementById('DiscountContemt');
        document.querySelectorAll('.dis_link').forEach(function (item) {
            item.addEventListener('click', function(e){
                e.preventDefault();
                const url =e.currentTarget.getAttribute('href');
                let params = url.substr(url.indexOf('?')+1).split('&').reduce(function(p,e){
                        var a = e.split('=');
                        p[ decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
                        return p;
                    },
                    {}
                );
                $.ajax(
                    {
                        url: '{{route('discounts.create.paginate')}}',
                        type: 'GET',
                        data: {
                            _token: document.querySelector('meta[name=csrf-token]').content,
                            'page': params.page,
                            'category': params.category
                        },
                        success: function (response) {
                            DiscountContemt.innerHTML = response;
                            selectionGoods();
                            discountPaginate();
                        },
                        error: function (response) {
                            console.log(response);
                        }
                    });
            });
        });
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
</script>
@endsection
