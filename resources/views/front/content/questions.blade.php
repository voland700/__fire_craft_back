@extends('front.layouts.layout')
@section('meta-title',  'Часто задаваемые вопросы о печахи каминах, как топить печь, как выбрать и купить отопительную печь или камин')
@section('meta-description', 'Ответы на часто задаваемые вопросы о печах и каминах, выбор, покупка и использование отопительных печей и каминов, полезная информация об отопительных, дровяных печах и каминах')
@section('meta-keywords',  'информация, печи, камины, аксессуары, jotul, morso, scan, йотул, морсо, скан, чугунные, на дровах, со стеклом, для дома, отопление, цена, фото, купить')
@section('h1', 'Часто задаваемые вопросы')

@section('breadcrumbs')
    {{ Breadcrumbs::render('content.questions') }}
@endsection

@section('content')
<div class="_mb_3">
    <section class="faq_item">
        <div class="faq_title"><span class="faq_icon"><i></i></span>
            <h3> Что такое печь Clean Burn?</h3>
        </div>
        <div class="faq_txt">
            <p>Печь Clean Bur, с функцией чистое горение или системой двойного дожига, имеет особое устройство топки – с забором, распределением и подачей воздуха для лучшего и более полного сгорания дров. Воздух проходя по воздуховодам нагревается и под давлением подается в топку, на верхних уровнях пламени. В результате поступления дополнительного горячего воздуха топливо и образующиеся дымовые газы сгорают в полном объеме.</p>
            <p>Как правило, печи Clean Burn имеют красивое горение с завораживающей игрой огня, и высокий уровень КПД.</p>
        </div>
    </section>
    <section class="faq_item">
        <div class="faq_title"><span class="faq_icon"><i></i></span>
            <h3>Что такое теплоаккумуляционная масса для печи или камина?</h3>
        </div>
        <div class="faq_txt">
            <p>Теплоаккумуляционная масса – набор элементов в форме колец состоящих из теплоаккумуляционного материала – магнезитового бетона или клинкера, которые одеваются на трубу дымохода на выходе из топки, месте с наибольшей тепловой нагрузкой. </p>
            <p>Аккумуляционная масса нагревается, сохраняет и затем долгое время отдает тепло, повышая отопительную эффективность печи или камина.
                Так же теплоаккумуляционная масса снимает излишнюю тепловую нагрузку с топки печи и дымохода.</p>
        </div>
    </section>
    <section class="faq_item">
        <div class="faq_title"><span class="faq_icon"><i></i></span>
            <h3>В чем разница между обычной лучистой и конвекционной печью?</h3>
        </div>
        <div class="faq_txt">
            <p>Лучистое, или радиальное тепло - равномерно отдается от стенок печи или камина. Конвекционная печь, имеет пространство между стенками печи, в котором в результате нагрева, горячий воздух подымается в верх и замещается холодным. Таким образом образуются конвекционные потоки, и в результате которых конвекционная печь быстрее и равномернее прогревает помещение. </p>
            <p>Безусловно, конвекционная печь имеет более сложную конструкцию, и как правило её стоимость выше обычной радиальной печи с лучистым теплом.</p>
        </div>
    </section>
    <section class="faq_item">
        <div class="faq_title"><span class="faq_icon"><i></i></span>
            <h3>Что такое наружный воздух?</h3>
        </div>
        <div class="faq_txt">
            <p>Наружный воздух, или подвод дополнительного воздуха “из вне”, - система подачи воздуха с улицы или смежного с отапливаемым помещения, на пример из подвала. Для горения требуется кислород, который по подключенным трубам забирается с улицы, и в данном случае уровень кислорода в отапливаемом помещении всегда остается на достаточном для комфортного дыхания и хорошего самочувствия уровне.</p>
            <p>Особенно наличие возможности подвода наружного воздуха, актуально в современных, энергоэффективных домах с высоким уровнем герметичности. </p>
        </div>
    </section>
    <section class="faq_item">
        <div class="faq_title"><span class="faq_icon"><i></i></span>
            <h3>Могу ли я использовать для отопления строительный мусор из дерева?</h3>
        </div>
        <div class="faq_txt">
            <p>В качестве топлива в современных печах каминах допускается использование только сухие дрова из деревьев лиственных парод. При этом дрова должны быть предварительно высушены, до уровня влаги не превышающего 20%. Только в данном случае Вы получите красивое горение с чистым стеклом, а так же чистый дымоход и долгий срок службы камина.</p>
            <p>Категорически не допустимо использовать строительный мусор, окрашенные и обработанные обрезки досок, ДСП, дерево хвойных пород, а так же свежезаготовленные сырые дрова.</p>
        </div>
    </section>
    <section class="faq_item">
        <div class="faq_title"><span class="faq_icon"><i></i></span>
            <h3>Почему на стекле печи-камина оседает копоть и сажа?</h3>
        </div>
        <div class="faq_txt">
            <p>Многие современные печи-камины, в том числе такие как JOTUL и MORSO – имеют специальное устройство и механизм само очистки стекла. В топках данных печей, один из потоков горячего воздуха всегда направлен на стекло, для препятствия оседания копоти и сажи. </p>
            <p>Копоть на стекле может оседать в случаях:</p>
            <ul>
                <li>Использования не качественных и сырых дров;</li>
                <li>Не правильно установленного печи и дымохода, приведшего к отсутствию тяги;</li>
                <li>Длительная работа печи на низком уровне горения, тления, когда температура в печи не достаточна для сгорания сажи, а так же тяга недостаточна для полного дымоудаления.</li>
            </ul>
        </div>
    </section>
    <section class="faq_item">
        <div class="faq_title"><span class="faq_icon"><i></i></span>
            <h3>Что лучше, стальная или чугунная печь?</h3>
        </div>
        <div class="faq_txt">
            <p>Чугун более прочный и жаростойкий материал по сравнению с сталью, следовательно, чугунная печь более прочная и долговечная. Чугун обладает большим уровнем теплоемкости, то есть печь из чугуна дольше держит тепло. Так же, в отличии от стальной, печь из чугуна не выжигает кислород, оставляя воздух в отапливаемом помещении комфортным для дыхания. </p>
            <p>При покупке печи или камина для Вашего дома, выбор чугунной печи однозначно предпочтительней.</p>
        </div>
    </section>
    <section class="faq_item">
        <div class="faq_title"><span class="faq_icon"><i></i></span>
            <h3>Что лучше, чугунная или печь из кирпича?</h3>
        </div>
        <div class="faq_txt">
            <p>Чугунная и кирпичные печи имею как преимущества та и недостатки по сравнению с друг другом. </p>
            <p>Печь из кирпича долго нагревается, долго остывает и держит тепло. Такая печь идеальна при постоянном проживании в доме. Чугунная печь менее теплоемка, быстрее остывает, однако быстро нагревается и гораздо быстрее отапливает помещение. Чугунная печь предпочтительней для отопления загородного дома при периодическом посещении, когда необходимо быстро отопить остывшее помещение до комфортной температуры. </p>
            <p>Так же печь из кирпича, в отличии от чугунной, более капитальное строение, требует наличия фундамента и большого количества строительных материалов. Строительство кирпичной печи - это более сложный процесс в отличии монтажа чугунной печи и дымохода, потребует большего времени и конечно дороже. </p>
        </div>
    </section>
    <section class="faq_item">
        <div class="faq_title"><span class="faq_icon"><i></i></span>
            <h3>Могу ли я установить печь самостоятельно?</h3>
        </div>
        <div class="faq_txt">
            <p>Да, конечно установить печь и дымоход самостоятельно Вы можете, По крайне в Российской Федерации, в отличии от стран Евросоюза, это законодательно не запрещено. Однако, по ряду причин мы настоятельно не рекомендуем делать это своими руками, а прибегнуть к услугам профессионалов.</p>
            <ol>
                <li>В первую очередь по соображениям безопасности. Часто допущенные при установке печи и дымохода приводят к пожарам, и попытки сэкономить на услугах монтажа могут привести к потере всего дома и дорогостоящего имущества.</li>
                <li>Не смотря на кажущуюся простоту установки современной печи-камина и модульного дымохода, монтаж требует обладания специальными знаниями и навыками, которые помогут избежать многих проблем – отсутствия тяги в печи, проблем с растопкой камина, копоти на стекле.</li>
            </ol>
            <p>По приведенным выше причинам, многие производители печей и каминов предоставляют гарантию на свои изделия только при условии монтажа профессиональными организациями.</p>
        </div>
    </section>
    <section class="faq_item">
        <div class="faq_title"><span class="faq_icon"><i></i></span>
            <h3>Какая гарантия предоставляется на печи и камины?</h3>
        </div>
        <div class="faq_txt">
            <p>Компания JOTUL на свои изделия предоставляет гарантию - 25 лет, компания MORSO – 10 лет. </p>
            <p>Следует отметить, что все современные производители печей-каминов, в том числе JOTUL и MORSO, предоставляют гарантию на корпус изделия. Гарантия не распространяется на стекла, печной шнур в дверцах, так как они являются расходным материалом и подлежат периодической замене самостоятельно. </p>
        </div>
    </section>
    <section class="faq_item">
        <div class="faq_title"><span class="faq_icon"><i></i></span>
            <h3>Куда обращаться для получения гарантии на печи и камины?</h3>
        </div>
        <div class="faq_txt">
            <p>Вы можете получить гарантию только при условии покупки печи или камина только у официальных дилеров JOTUL и MORSO, которые представлены в разделе - Где купить на данном сайте.</p>
            <p>Производители, совместно с эксклюзивных представителем JOTUL и MORSO в России компанией FIRE-CRAFT, строго подходят в выборе региональных представителей и официальных продавцов печей и каминов. Одним из основных условий допуска к продаже изделий JOTUL и MORSO – является соблюдение гарантийных обязательств перед клиентом. Поэтому, при необходимости Вы можете обратится к продавцу печи или камина, где Вы приобретали изделие, или непосредственно в кампанию FIRE-CRAFT, представителю производителя в России. </p>
        </div>
    </section>
    <section class="faq_item">
        <div class="faq_title"><span class="faq_icon"><i></i></span>
            <h3>Где я могу получить запасные части для моей печи?</h3>
        </div>
        <div class="faq_txt">
            <p>При необходимости замены каких-либо частей печи или камина JOTUL и MORSO, Вы можете обратится либо к официальному дилеру, продавцу, где Вы приобретали изделие, либо непосредственно официальному представителю в производителей – компанию FIRE-CRAFT. </p>
            <p>При наличии необходимых запасных частей на складе “FIRE-CRAFT”, будут Вам предоставлены незамедлительно. В случае отсутствия необходимых запасных частей, они будут получены у производителя и доставлены в Россию, в течении одного месяца.</p>
        </div>
    </section>
</div>
@endsection
