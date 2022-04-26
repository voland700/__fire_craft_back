
<li class="nav-header">Каталог</li>

<li class="nav-item">
    <a href="{{route('product.list')}}" class="nav-link">
        <i class="fas fa-box-open nav-icon"></i>
        <p>Товары</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{route('category.index')}}" class="nav-link">
        <i class="fas fa-boxes nav-icon"></i>
        <p>Категории</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('color.index')}}" class="nav-link">
        <i class="nav-icon fas fa-palette"></i>
        <p>Цвета товаров</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('property.index')}}" class="nav-link">
        <i class="fas fa-bars nav-icon"></i>
        <p>Характеристики</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('discounts.index')}}" class="nav-link">
        <i class="nav-icon fas fa-percent"></i>
        <p>Скидки</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('currency.index')}}" class="nav-link">
        <i class="nav-icon fab fa-btc"></i>
        <p>Курсы валют</p>
    </a>
</li>

<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-file-export"></i>
        <p>
            Экспорт в EXCEL
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview" style="display: none;">
        <li class="nav-item">
            <a href="{{route('product.price.export.show')}}" class="nav-link">
                <i class="fas fa-tags nav-icon"></i>
                <p>Экспорт цен товаров</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview" style="display: none;">
        <li class="nav-item">
            <a href="{{route('offer.price.export.show')}}" class="nav-link">
                <i class="far fa-arrow-alt-circle-down nav-icon"></i>
                <p>Экспорт цен опций</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-file-import"></i>
        <p>
            Импорт из EXCEL
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview" style="display: none;">
        <li class="nav-item">
            <a href="{{route('product.import.show')}}" class="nav-link">
                <i class="nav-icon fas fa-download"></i>
                <p>Импорт товаров</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-arrow-alt-circle-down"></i>
                <p>Обновление цен</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{route('offer.import.show')}}" class="nav-link">
                <i class="nav-icon far fa-arrow-alt-circle-down"></i>
                <p>Импорт опций</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-angle-double-down"></i>
                <p>Обновление опций</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-header">Контент</li>
<li class="nav-item">
    <a href="{{route('slider.index')}}" class="nav-link">
        <i class="nav-icon far fa-image"></i>
        <p>Слайдер Top</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{route('gallery.index')}}" class="nav-link">
        <i class="nav-icon far fa-images"></i>
        <p>Слайдер Bottom</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{route('document.index')}}" class="nav-link">
        <i class="nav-icon fas fa-paste"></i>
        <p>Документы</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{route('region.index')}}" class="nav-link">
        <i class="nav-icon fas fa-map-marked-alt"></i>
        <p>Регионы</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('dealer.index')}}" class="nav-link">
        <i class="nav-icon fas fa-handshake"></i>
        <p>Партнеры</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('question.index')}}" class="nav-link">
        <i class="nav-icon far fa-question-circle"></i>
        <p>Вопросы</p>
    </a>
</li>

