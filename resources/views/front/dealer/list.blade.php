@extends('front.layouts.layout')
@section('meta-title',  'Офицальные дилеры JOTUL, MORSO в России, продавцы печей и каминов Jotul, Morso  в Регионах России')
@section('meta-description', 'Официальные дилеры, продавцы печи и каминов JOTUL, MORSO, SCAN в России, региональные представители - Фаир-Крафт, Скандинавские камины - продажа оптом и в Розницу на территории России')
@section('meta-keywords',  'каталог, печи, камины, аксессуары, jotul, morso, scan, йотул, морсо, скан, чугунные, на дровах, со стеклом, для дома, отопление, цена, фото, купить')
@section('h1', 'Регональные представители')

@section('breadcrumbs')
    {{ Breadcrumbs::render('dealer.list') }}
@endsection

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script>
        let data_obj = @json($data);
        let ObjectNew = {};
        let objRegions = @json($regions);
        console.log(objRegions);

    </script>
    <div class="map_rf">
        <div id="vmap" class="map"></div>
        <div class="vmap__info">
            <div class="vmap__info-yes"> <span></span></span>
                <p>- в регионе есть дилеры</p>
            </div>
            <div class="vmap__info-no"><span></span></span>
                <p>- в регионе нет дилеров</p>
            </div>
        </div>
        <div id="selectRegion" class="vmap__select">
            <div class="vmap__select-form">
                <label><span>Введите Ваш регион:</span> <input type="text" v-model="regionName" /></label>
                <label><span>Или выберете из списка:</span>
                    <select v-model="selecteRegion" @change="getRegion">
                        <option v-for="region in regions" v-bind:value="region">@{{region.name}}</option>
                    </select>

                </label>
            </div>
            <ul class="vmap__select-list">
                <li v-for="elemRegion in filteredList"><a v-bind:href="'/partners/'+elemRegion.item+'/'" v-bind:id="elemRegion.item">@{{ elemRegion.name }}</a></li>
            </ul>
        </div>
    </div>

    <script>

        var reg = new Vue({
            el: '#selectRegion',
            data: {
                regionName: '',
                selecteRegion: '',
                //selecteRegionUrl: '',
                regions: objRegions
            },
            computed: {
                filteredList: function () {
                    var comp = this.regionName;
                    return this.regions.filter(function (elem) {
                        if (comp === '') return false;
                        else {
                            return elem.name.toLowerCase().indexOf(comp.toLowerCase()) > -1;
                        }
                    })
                }
            },
            methods: {
                getRegion: function () {
                    window.location.href = '/dealers/region/' + this.selecteRegion.item + '/';
                }
            }
        })
    </script>
    <hr class="hr_separator _mt_3">
    <div class="dealer_wrap">
        @if($dealers->isNotEmpty())
            @foreach($dealers as $dealer)
            <section class="dealer_item">
                <h3 class="dealer_name"><a href="{{route('dealer.detail', $dealer->slug)}}" class="dealer_link">{{$dealer->name}}</a></h3>
                <ul class="dealer_list">
                    @if($dealer->address)<li><b>Адрес</b>: {{$dealer->address}}</li>@endif
                    @if($dealer->time)<li><b>Время работы: </b>{{$dealer->time}}</li>@endif
                    @if($dealer->phone)<li><b>Тел:</b> {{$dealer->phone}}</li>@endif
                    @if($dealer->mail)<li><b>E-mail:</b> {{$dealer->mail}}</li>@endif
                    @if($dealer->site)<li><b>Сайт:</b> <a href="{{$dealer->site}}"  target="_blank">{{$dealer->site}}</a></li>@endif
                </ul>
            </section>
            @endforeach
        @endif
    </div>
    {{$dealers->onEachSide(2)->links('front.layouts.pagination')}}
@endsection

@section('scripts')
    <script src="/js/map.js"></script>
@endsection
