@extends('front.layouts.layout')
@section('meta-title',  'О компании Фаир-Крафт - официальный сайт, эксклюзивный представитель Jotul и Morso в России')
@section('meta-description', 'Информациф о компании Фаир-Крафт: официальном предстаителе Скандинавских производителей печей и каминов:  JOTUL, MORSO, SCAN в России - продажа оптом и в Розницу на территории России')
@section('meta-keywords',  'фаир-крафт, о компнии, информация, адрес, время работы, фото, каталог, печи, камины, аксессуары, jotul, morso, scan, йотул, морсо, скан, чугунные, на дровах, со стеклом, для дома, отопление, цена, фото, купить')
@section('h1', 'О компании FIRE-CRAFT')

@section('breadcrumbs')
    {{ Breadcrumbs::render('content.about') }}
@endsection

@section('content')

    <div class="photo_wrap _mb_3">
        <div class="pfoto_1">
            <a class="photo_link" href="{{asset('images/src/certificate.jpg')}}" data-fancybox="FIRE-CRAFT - официальный представитель JOTUL в России">
                <img src="{{asset('images/src/certificate.jpg')}}" class="photo_item" alt="Официальный представитель JOTUL в Росс"></a>
        </div>
    </div>
    <div class="article">
        <h3>О нас - галерея магазина</h3>

        <div class="gallery_shop_wrap _mb_3">
            <div class="gallery_shop_item">
                <a href="/images/src/about/1.jpg" data-fancybox="gallery2" class="gallery_shop_link">
                    <img src="/images/src/about/1_p.jpg" alt="About" class="gallery_shop_img">
                </a>
            </div>
            <div class="gallery_shop_item">
                <a href="/images/src/about/2.jpg" data-fancybox="gallery2" class="gallery_shop_link">
                    <img src="/images/src/about/2_p.jpg" alt="About" class="gallery_shop_img">
                </a>
            </div>
            <div class="gallery_shop_item">
                <a href="/images/src/about/3.jpg" data-fancybox="gallery2" class="gallery_shop_link">
                    <img src="/images/src/about/3_p.jpg" alt="About" class="gallery_shop_img">
                </a>
            </div>
            <div class="gallery_shop_item">
                <a href="/images/src/about/4.jpg" data-fancybox="gallery2" class="gallery_shop_link">
                    <img src="/images/src/about/4_p.jpg" alt="About" class="gallery_shop_img">
                </a>
            </div>
            <div class="gallery_shop_item">
                <a href="/images/src/about/5.jpg" data-fancybox="gallery2" class="gallery_shop_link">
                    <img src="/images/src/about/5_p.jpg" alt="About" class="gallery_shop_img">
                </a>
            </div>
            <div class="gallery_shop_item">
                <a href="/images/src/about/6.jpg" data-fancybox="gallery2" class="gallery_shop_link">
                    <img src="/images/src/about/6_p.jpg" alt="About" class="gallery_shop_img">
                </a>
            </div>
            <div class="gallery_shop_item">
                <a href="/images/src/about/7.jpg" data-fancybox="gallery2" class="gallery_shop_link">
                    <img src="/images/src/about/7_p.jpg" alt="About" class="gallery_shop_img">
                </a>
            </div>
        </div>


        <div class="_mb_3">
                <p> <strong>Уважаемые партнеры! </strong> </p>
                <p style="text-align:justify;"> <!--Компания <strong>ФАИР КРАФТ</strong> — является эксклюзивным представителем норвежской компании Jotul Group в Центральном регионе России по продаже печей, каминов и аксессуаров <strong>JOTUL</strong>, <strong>SCAN</strong>. Компания ФАИР КРАФТ с момента основания достигла хороших показателей в сфере оптовой торговли, ориентируясь на максимальное представление своей продукции в каждом регионе нашей страны. <br>-->
                    Компания ФАИР КРАФТ располагает большими складскими запасами продукции Скандинавский производителей печей и каминов Jotul и Morso Всегда на складе полный ассортимент продукции JOTUL, SCAN и MORSO что делает возможным поддержание конкурентно привлекательных цен.<br>
                    Сотрудничая с компанией ФАИР КРАФТ, вы обретаете надежного партнера и гарантированный экономический рост для Вашей компании. </p>
                <p> Почему именно ФАИР КРАФТ: </p>
                <ul>
                    <li> Наличие продукции на складе в 99% случаев.</li>
                    <li> Выгодные условия приобретения выстовояных образцов печей и каминов.</li>
                    <li> Быстрое решение гарантийных случаев с производителем</li>
                    <li> Гарантия стабильного дохода.</li>
                    <li> Современные узнаваемые бренды</li>
                    <li> Наиболее гибкие формы делового сотрудничества.</li>
                    <li> Работа с персональным менеджером.</li>
                    <li> Большой опыт работы в сфере оптовых продаж</li>
                    <li> Стабильно надежное качество продукции</li>
                    <li>Яркий узнаваемый стиль и привлекательный дизайн.</li>
                    <li> Возможность оказания поддержки в расширении бизнеса.</li>
                </ul>
                <p> В соответствии со стратегией развития бизнеса, мы ищем партнеров на всей территории России. Наши ожидания от кандидатов на получение статуса официального дилера: </p>
                <ul>
                    <li> Опыт работы на рынке печей и каминов</li>
                    <li> Профессиональный коллектив</li>
                    <li> Эффективная управленческая команда</li>
                    <li> Стабильное финансовое положение</li>
                    <li> Инвестиционный потенциал</li>
                </ul>
                <p> С уважением,<br>
                    команда ФАИР КРАФТ </p>
        </div>
    </div>
    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "Organization",
        "name": "Фаир-Крафт",
        "description": "ООО Фаир-Крафт -  официальный представитель JOTUL, MORSO и SCAN в Росии - Скандинаских производителей печей и каминов. Оптовая и розничная продажа печей и каминов Jotul - Норвегия и Morso - Дания",
        "url": "https://fire-craf.ru",
        "logo": "{{asset('/images/src/icons/logo.svg')}}",
        "email": "support@link-assistant.com",
        "address": {
                        "@type": "PostalAddress",
                        "addressCountry": "RU",
                        "postalCode": "117574",
                        "addressLocality": "Москва, Россия",
                        "streetAddress": "МКАД, 38-й километр, 4Б, стр. 1, "
        },
        "founder": {
                        "@type": "Person",
                        "name": "Косиор Татьяна Васильевна",
                        "gender": "женский",
                        "jobTitle": "Генеральный директор"
        },
        "foundingDate": "21.03.2015",
        "contactPoint" : [
            {
                "@type" : "ContactPoint",
                "contactType" : "обслуживание клиентов",
                "email": "info@fire-craft.ru",
                "url": "https://fire-craft.ru"
            }
        ]
    }
</script>
@endsection
