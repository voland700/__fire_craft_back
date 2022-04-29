@extends('front.layouts.layout')
@section('meta-title',  'Контакты, Фаир-Крафт: адрес, телефон, как добраться, схема проезда - Фаир-Крафт, официальный представитель производителя печей и каминов JOTUL и MORSO в России')
@section('meta-description', 'Адрес, телефон, схема проезда компании Фаир-Крафт, контактная информаия, о местонахождении официального представителя  печей и каминов  JOTUL и Morso в Москве.')
@section('meta-keywords',  'фаир-крафт, адрес, телефон, схема, проезда, как добраться, где находится, официальный, сайт, печи, камины,jotul, morso, scan, йотул, морсо, скан, чугунные, на дровах, со стеклом, для дома, отопление, цена, фото, купить')
@section('h1', 'Информация для дилеров Jotul и Morso')

@section('breadcrumbs')
    {{ Breadcrumbs::render('content.contacts') }}
@endsection

@section('content')
    <div class="article" style="margin-bottom: 70px">

        <div class="contact_info_wrap">
            <div class="contact_info_item">
                <h4>Адрес:</h4>
                Офис: г. Москва, 38 км. МКАД, владение 4А, офис 210. Склад: г. Москва, 38 км. МКАД, владение 4Б.
            </div>
            <div class="contact_info_item">
                <h4>Телефон:</h4>
                +7 (495) 423-69-64
            </div>
            <div class="contact_info_item">
                <h4>Часы работы:</h4>
                будние дни с 9.00 до 18.00<br>
                суббота, воскресенье — выходные дни.
            </div>
            <div class="contact_info_item">
                <h4>Координаты для GPS навигатора:</h4>
                Долгота: 55.5971,<br>
                Широта: 37.5113
            </div>
        </div>

        <section class="_mb_3">
            <h2 class="contact_h2 _mb_2">Схема проезда к складу ООО "ФАИР-КРАФТ" под погрузку</h2>

            <div class="contact_scheme_wrap _mb_1">
                <div class="contact_scheme_item">
                    <h5>Cхема проезда с Внешней стороны МКАД</h5>
                    <a data-fancybox="gallery" href="/images/src/contact/path_out.jpg" class="contact_scheme_link">
                        <img src="/images/src/contact/path_out_thamb.jpg" alt="Cхема проезда с Внешней стороны МКАД" class="img-thumbnail">
                    </a>
                </div>
                <div class="contact_scheme_item">
                    <h5>Cхема проезда с Внутреней стороны МКАД</h5>
                    <a data-fancybox="gallery" href="/images/src/contact/path_in.jpg" class="contact_scheme_link">
                        <img src="/images/src/contact/path_in_thamb.jpg" alt="Cхема проезда с Внутреней стороны МКАД" class="img-thumbnail">
                    </a>
                </div>

            </div>
            <p>Компания "ФАИР-КРАФТ" расположена на внутренней стороне 38 км. МКАД, на территории Садового центра "Ясенево".</p>

        </section>
        <div class="img-thumbnail _mb_25" style="width: 100%">
            <script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=F3QZFUNVAMb1sUiU7-AGePSn4Jrc_Gnc&width=auto&height=450"></script>
        </div>

    </div>
@endsection
