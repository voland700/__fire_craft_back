@extends('front.layouts.layout_main')
@section('meta-title', 'Фаир-Крафт: печи и камины JOTUL, MORSO, SCAN - официальный сайт представителя в России. Продажа печей-каминов JOTUL, MORSO оптом.')
@section('meta-description', 'Официальный сайт представителя производителей печей и каминов: Jotul, Morso, Scan  России, оптовая и розничная продажа Скандинавских печей и каминов. Каталог печей и ккминов в Москве')
@section('meta-keywords', 'печи, камины, jotul, morso, scan, кандинавские, чугунные, дровяные, , для печей, купить, цена, офоициальный, сайт, йотул, морсо, скан')

@section('h1', 'Официальный сайт представителя Везувий в Москве')

@section('content')
    @if($sliders)
        <div class="swiper slider" id="slider">
            <div class="swiper-wrapper slider_container">
                @foreach($sliders as $slider)
                <section class="swiper-slide slider_item">
                    <div class="slider_background" style="background-image: url({{$slider->img}})"></div>
                    <h2 class="slider_title" data-swiper-parallax-scale="0">{{$slider->name}}</h2>
                    <div class="slider-btn-wrap" data-swiper-parallax-y="-200" data-swiper-parallax-opacity="0">
                        <a href="{{route('catalog.index')}}" class="slider-btn">Каталог</a>
                        <a href="{{route('dealer.list')}}" class="slider-btn">Где купить</a>
                    </div>
                </section>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    @endif

<section class="container brend">
    <h2 class="title-line">Эксклюзивный представитель <span>компаний</span></h2>
    <div class="brend_list">
        <div class="brend_img_wrap">
            <a href="/catalog/category/peci-kaminy-jotul" class="brend_link">
                <img src="{{asset('/images/src/brend/jotul.jpg')}}" alt="Jotul" class="brend_img">
            </a>
        </div>
        <div class="brend_img_wrap">
            <a href="/catalog/category/peci-kaminy-morso" class="brend_link">
                <img src="{{asset('/images/src/brend/scan.jpg')}}" alt="Scan" class="brend_img">
            </a>
        </div>
        <div class="brend_img_wrap">
            <a href="/catalog/category/peci-kaminy-scan" class="brend_link">
                <img src="{{asset('/images/src/brend/morso.jpg')}}" alt="Morso" class="brend_img">
            </a>
        </div>

    </div>
    <div class="brend_text">Компания Файр-Крафт является эксклюзивным дилером, официальным представителем
        производителей JOTUL и MORSO в России.</div>
</section>

    @if($favoriteCategories)

        <div class="container main_category">
            <div class="main_category_list">
                @foreach($favoriteCategories as $cat)
                <div class="main_category_item" onclick="location.href='{{ route('catalog.category', ['slug' => $cat->slug]) }}';">
                    <a href="{{ route('catalog.category', ['slug' => $cat->slug]) }}" class="main_category_item_title">{{$cat->name}}</a>
                    <img src="{{ asset($cat->photo)}}" alt="{{$cat->name}}" class="main_category_item_img">
                    <div class="main-category-item-bottom">
                        <a href="{{ route('catalog.category', ['slug' => $cat->slug]) }}" class="main-category-item-bottom-btn">➠</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    @endif

    <section class="container why">
        <h2 class="title-line">Наши продукты неподвласны времени</h2>
        <p class="subtitle_txt">Связывают прошлое с настоящим и гармоничны с архитектурной эстетикой современных интерьеров. Норвежское ремесло обработки чугуна, а также функциональный и современный дизайн приводят к тому, что наши камины выделяются на фоне краткосрочных тенденций.</p>

        <div class="why_list">
            <div class="why_item">
                <h3 class="why_item_title">Покупка камина</h3>
                <p class="why_txt"> У Jøtul есть самая широкая дистрибуционная сеть, а также программа обучения, которая обеспечивает высокий уровень знаний продавцов. Центр обучения находится в Норвегии, но ежегодно проводятся также семинары в большей части стран, в которых продаеются продукты Jøtul.
                </p>
                <a href="{{route('content.delivery')}}" class="why_item_link">Точки продаж</a>
            </div>

            <div class="why_item">
                <h3 class="why_item_title">Почему чугун</h3>
                <p class="why_txt"> Чугун обладает экстремальными свойствами, благодаря которым это делает его подходящим материалом для производства каминов. Но что такое чугун и почему в Jøtul мы продолжаем поддерживать его Норвежскую традицию?
                </p>
                <a href="{{route('content.iron')}}" class="why_item_link">Описание изделий</a>
            </div>

            <div class="why_item">
                <h3 class="why_item_title">Розжиг камина</h3>
                <p class="why_txt">Не сложно приобрести камин или дровяную печь, но есть некоторые нюансы, которые нужно знать перед тем как приступить к его эксплуатации. Ниже ты узнаешь больше о том, какое использовать топливо и как растопить камин правильно, а так же как продлить его срок службы.
                </p>
                <a href="{{route('content.ignition')}}" class="why_item_link">Первый розжиг</a>
            </div>

        </div>

    </section>

    <div class="paralax">
        <div class="paralax-head">
            <a href="{{route('catalog.index')}}" class="paralax-head-btn">Каталог</a>
        </div>
        <div class="paralax-head-wrap" style="background-image:url({{asset('/images/src/section-bg.jpg')}});">
            <div class="container paralax-head-content">
                <h3 class="paralax-head-title">Обогрев по-Норвежски</h3>
                <div class="paralax-head-txt">
                    Опыт жизни в условиях скандинавского климата научил нас тому, что обогреть нужно больше, чем можно было бы измерить термометром. Наша продукция обогревает теплом в любых измерениях – это и звук трещащего пламени, и вид идеального огня, и оптимизированный расход топлива для эффективного и сбалансированного обогрева, и наш неподвластный времени дизайн.
                </div>
            </div>
        </div>
    </div>

    @if($advicesProducts)
        <section class="container showcase">
            <h2 class="title-line">Акции и спецпредложения</h2>
            <div class="showcase_list">
                @foreach($advicesProducts as $product)
                    @if($product->offers->isEmpty())
                        <div class="item_wrap">
                            <div class="item_img_wrap">
                                <a href="{{ route('catalog.product', ['slug' => $product->slug]) }}" class="item_link_img">
					            <span class="item_lable_wrap">
                                    @if($product->hit)<span class="item_lable hit">Хит</span>@endif
                                    @if($product->stock)<span class="item_lable discont">Акция</span>@endif
                                    @if($product->new)<span class="item_lable new">Новинка</span>@endif
                                    @if($product->advice)<span class="item_lable tip">Советуем</span>@endif
					            </span>
                                    <img src="{{asset($product->small)}}" alt="{{$product->name}}" class="item_img">
                                    @if($product->percent)<span class="item_discont">{{'-'.$product->percent.'%'}}</span>@endif
                                </a>
                            </div>
                            <h3 class="item_title">
                                <a href="{{ route('catalog.product', ['slug' => $product->slug]) }}" class="item_titl_link">{{$product->name}}</a>
                            </h3>
                            <div class="item_price">
                                @if($product->price>0)
                                    <span class="item_price_real">{{ $product->cost.' руб' }}</span>
                                    @if($product->old_price)<span class="item_price_old">{{$product->old_price.' руб'}}</span>@endif
                                @else
                                    <span class="item_price_real">Цена: по запросу</span>
                                @endif
                            </div>
                        </div>
                    @else
                        @php $offer = $product->offers->sortBy('sort')->first(); @endphp
                        <div class="item_wrap">
                            <div class="item_img_wrap">
                                <a href="{{ route('catalog.product', ['slug' => $product->slug]) }}" class="item_link_img">
					            <span class="item_lable_wrap">
                                    @if($offer->hit)<span class="item_lable hit">Хит</span>@endif
                                    @if($offer->stock)<span class="item_lable discont">Акция</span>@endif
                                    @if($offer->new)<span class="item_lable new">Новинка</span>@endif
                                    @if($offer->advice)<span class="item_lable tip">Советуем</span>@endif
					            </span>
                                    <img src="{{asset($offer->small)}}" alt="{{$product->name}}" class="item_img">
                                    @if($offer->percent)<span class="item_discont">{{'-'.$offer->percent.'%'}}</span>@endif
                                </a>
                            </div>
                            <h3 class="item_title">
                                <a href="{{ route('catalog.product', ['slug' => $product->slug]) }}" class="item_titl_link">{{$product->name}}</a>
                            </h3>
                            <div class="item_price">
                                @if($offer->price>0)
                                    <span class="item_price_real">{{ $offer->cost.' руб' }}</span>
                                    @if($offer->old_price)<span class="item_price_old">{{$offer->old_price.' руб'}}</span>@endif
                                @else
                                    <span class="item_price_real">Цена: по запросу</span>
                                @endif
                            </div>
                            <div class="item_offers">
                                @foreach($product->offers as $itemOffer)
                                <a href="javascript:void(0)" class="item_offer_link @if($loop->index == 0) active @endif" data-product="{{$product->id}}" data-offer="{{$itemOffer->id}}"
                                   style="background-image:url({{asset($itemOffer->color_file)}});"></a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                @endforeach
            </div>
        </section>
    @endif
@endsection

