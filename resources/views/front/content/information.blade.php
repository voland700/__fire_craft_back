@extends('front.layouts.layout')
@section('meta-title',  'Информация для дилеров, продавцев печей и каминов JOTUL и MORSO, каталоги продукции, прайслисты на официальный сайт представителя Jotul в России')
@section('meta-description', 'Каталоги продуции, прайслисты, информаия для дилеров, продавцов печей и каминов Скандинавских производителей JOTUL и Morso в регионах России.')
@section('meta-keywords',  'дилерам, каталог, прайс-лист, информация, печи, камины,jotul, morso, scan, йотул, морсо, скан, чугунные, на дровах, со стеклом, для дома, отопление, цена, фото, купить')
@section('h1', 'Информация для дилеров Jotul и Morso')

@section('breadcrumbs')
    {{ Breadcrumbs::render('content.information') }}
@endsection

@section('content')
    <div class="article" style="margin-bottom: 70px">

        <p>Расширяя дилерскую сеть, мы предлагаем сотрудничество компаниям продавцам и монтажникам печей и каминов&nbsp;в регионах Российской Федерации - стать региональными дилерами Скандинавских компаний Morso и JOTUL.
        Гарантируем информационную и рекламную поддержку, обеспечение технической документацией и каталогами в печатном и электронном виде. Так же гарантируем складскую программу и постоянное наличие основных моделей на складе.</p>
        <h3>Требования к партнерам</h3>
        <ul>
            <li>Наличие торгово-выставочного зала.</li>
            <li>Возможность предоставление услуг по монтажу, установке печей и каминов.</li>
        </ul>
       <p>Подробней узнать об условиях сотрудничества Вы можете по телефону: <a class="region-phone" href="tel:+79853088316">+7-985-308-83-16</a>. </p>
        <br>
        <div class="doc_list">
            <div class="doc_item">
                <a href="#" class="doc_link_img">
                    <img src="/images/src/doc/Jotul_catalog.jpg" alt="Документ" class="doc_img">
                </a>
                <a href="#" class="doc_link">Каталог продукции JOTUL, скачать *.pdf 11 мб</a>
            </div>
            <div class="doc_item">
                <a href="#" class="doc_link_img">
                    <img src="/images/src/doc/jotul_price.jpg" alt="Документ" class="doc_img">
                </a>
                <a href="#" class="doc_link">Прайс-лист Jotul, скачать *.pdf 1.1 мб</a>
            </div>
            <div class="doc_item">
                <a href="#" class="doc_link_img">
                    <img src="/images/src/doc/morso_catalog.jpg" alt="Документ" class="doc_img">
                </a>
                <a href="#" class="doc_link">Каталог продукции Morso, скачать *.pdf 13.9 мб</a>
            </div>
            <div class="doc_item">
                <a href="#" class="doc_link_img">
                    <img src="/images/src/doc/morso_price.jpg" alt="Документ" class="doc_img">
                </a>
                <a href="#" class="doc_link">Прайс-лист Moroso, скачать *.pdf 766 кб</a>
            </div>
        </div>

    </div>
@endsection
