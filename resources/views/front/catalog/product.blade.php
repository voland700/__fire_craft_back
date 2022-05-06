@extends('front.layouts.layout')
@section('meta-title', $product->title)
@section('meta-description', $product->descrip)
@section('meta-keywords', $product->keys)
@section('h1', $product->named)
@section('breadcrumbs')
    {{ Breadcrumbs::render('catalog.product', $category, $product) }}
@endsection

@section('content')
<div class="prodact_wrap">
    <div class="product_images_wrap" id="imagesWrap">
        @if($offer == null)
            <div class="product_img_block">
                <span class="product_label_list">
                    @if($product->hit)<span class="product_lable hit">Хит</span>@endif
                    @if($product->stock)<span class="product_lable discont">Акция</span>@endif
                    @if($product->new)<span class="product_lable new">Новинка</span>@endif
                    @if($product->advice)<span class="product_lable tip">Советуем</span>@endif
                </span>
                @if($product->img)
                <a href="{{asset($product->img)}}" class="product_img_link">
                    <img src="{{asset($product->img)}}" alt="Печь" class="product_img" id="mainImg">
                </a>
                @else
                <a class="product_img_link">
                    <img src="{{asset($product->picture)}}" alt="Печь" class="product_img" id="mainImg">
                </a>
                @endif
                @if($product->percent)<span class="product_discount">{{'-'.$product->percent.'%'}}</span>@endif
            </div>

            @if($product->images->isNotEmpty() )
            <div class="product_prev_wrap">
                <span class="product_images_next" id="ImagesSliderNext"><span class="icon-cheveron-left"></span></span>
                <div class="swiper-container product_prev_gallery" id="ImagesSlider">
                    <div class="swiper-wrapper product_prev_list">
                        @if($product->img)
                            <div class="swiper-slide product_prev active">
                                <a href="{{asset($product->picture)}}" class="product_prev_link">
                                    <img src="{{asset($product->miniature)}}" alt="{{$product->name}}" class="product_prev_img">
                                </a>
                            </div>
                        @endif
                        @foreach($product->images as $image)
                            <div class="swiper-slide product_prev">
                                <a href="{{asset($image->img)}}" class="product_prev_link">
                                    <img src="{{asset($image->thumbnail)}}" alt="{{$product->name}}" class="product_prev_img">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <span class="product_images_prev" id="ImagesSliderPrev"><span class="icon-cheveron-right"></span></span>
            </div>
            @endif
        @else
            <div class="product_img_block">
                @if($offer->img)
                    <a href="{{asset($offer->img)}}" class="product_img_link">
                        <img src="{{asset($offer->img)}}" alt="Печь" class="product_img" id="mainImg">
                    </a>
                @else
                    <a class="product_img_link">
                        <img src="{{asset($offer->photo)}}" alt="Печь" class="product_img" id="mainImg">
                    </a>
                @endif
            </div>

            @if($offer->photos->isNotEmpty() )
                <div class="product_prev_wrap">
                    <span class="product_images_next" id="ImagesSliderNext"><span class="icon-cheveron-left"></span></span>
                    <div class="swiper-container product_prev_gallery" id="ImagesSlider">
                        <div class="swiper-wrapper product_prev_list">
                            @if($offer->img)
                                <div class="swiper-slide product_prev active">
                                    <a href="{{asset($offer->img)}}" class="product_prev_link">
                                        <img src="{{asset($offer->small)}}" alt="{{$offer->name}}" class="product_prev_img">
                                    </a>
                                </div>
                            @endif
                            @foreach($offer->photos as $photo)
                                <div class="swiper-slide product_prev">
                                    <a href="{{asset($photo->img)}}" class="product_prev_link">
                                        <img src="{{asset($photo->thumbnail)}}" alt="{{$offer->name}}" class="product_prev_img">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <span class="product_images_prev" id="ImagesSliderPrev"><span class="icon-cheveron-right"></span></span>
                </div>
            @endif
        @endif
    </div><!-- IMAGES -->


    <div class="product_info_wrap">
        @if($product->summary)
        <div class="product_info_text">{!! $product->summary !!}</div>
        @endif
        <div class="product_property">
            @if($product->properties)
            <table class="product_property_tbl">
                <tbody>
                @foreach($product->properties as $property)
                    <tr><td>{{$property->name}}:</td><td>{{$property->value}}</td></tr>
                @endforeach
                </tbody>
            </table>
            @endif
        </div>

        <div class="product_offers_wrap">
            @if($offer == null)
             <div class="product_offers_info" id="offerInfo">
                @if($product->art_number)
                <span><b>Артикул</b>{{$product->art_number}}</span>
                @endif
             </div>
            @else
            <div class="product_offers_info" id="offerInfo">
                @if($offer->number)
                <span><b>Артикул</b>{{$offer->number}}</span>
                @endif
                @if($offer->color_name)
                <span><b>Цвет</b>{{$offer->color_name}}</span>
                @endif
            </div>
            <ul class="product_offers_list" id="offerList">
                @foreach($product->offers as $offerItem)
                <li class="product_offer @if($loop->index == 0) active @endif"
                    data-name="{{$offerItem->color_name}}"
                    data-number = "{{$offerItem->number}}"
                    data-offer = "{{$offerItem->id}}"
                    data-price = "{{$offerItem->cost}}"
                    data-old = "{{$offerItem->old_price}}">
                    <span class="product_offer_color" style="background-image: url({{asset($offerItem->color_file)}});"></span>
                </li>
                @endforeach
            </ul>
            @endif
        </div>

        <div class="product_price" id="priceBlock">
            @if($offer == null)
                @if($product->price>0)
                    <span class="product_price_real">{{$product->cost}} руб.</span>
                    @if($product->old_price)
                    <span class="product_price_old">{{$product->old_price}} руб.</span>
                    @endif
                @else
                    <span class="product_price_real">Цена по запросу</span>
                @endif
            @else
                @if($offer->price>0)
                    <span class="product_price_real">{{$offer->cost}} руб.</span>
                    @if($offer->old_price)
                        <span class="product_price_old">{{$offer->old_price}} руб.</span>
                    @endif
                @else
                    <span class="product_price_real">Цена по запросу</span>
                @endif
            @endif
        </div>


    </div><!-- Attribution -->
    <div class="product_contact_wrap">
        <div class="product_contact_item">
            <div class="product_contact_icon">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
							<g>
                                <path fill="#333333" d="M7.523,17.489c0-4.831-0.002-9.662,0.001-14.492c0.001-1.754,0.756-2.529,2.499-2.532c4.991-0.008,9.982-0.008,14.972,0
													c1.715,0.003,2.479,0.76,2.48,2.446c0.004,9.694,0.004,19.387,0,29.081c-0.001,1.753-0.766,2.54-2.502,2.543
													c-4.991,0.01-9.982,0.01-14.972,0c-1.727-0.003-2.476-0.79-2.477-2.553C7.521,27.15,7.523,22.319,7.523,17.489z M26.631,17.629
													c-0.001,0-0.002,0-0.003,0c0-4.833,0.002-9.666-0.001-14.499c-0.001-1.496-0.318-1.814-1.794-1.814
													c-4.897-0.002-9.794-0.002-14.691,0C8.686,1.316,8.34,1.662,8.339,3.133c-0.004,3.873-0.002,7.746-0.001,11.619
													c0,5.729-0.002,11.459,0.002,17.188c0.001,1.3,0.366,1.742,1.489,1.744c5.121,0.011,10.242,0.01,15.363,0
													c1.054-0.002,1.438-0.418,1.439-1.46C26.631,27.359,26.631,22.494,26.631,17.629z"></path>
                                <path fill="#333333" d="M9.146,16.005c0-3.551-0.002-7.101,0.001-10.652c0.001-1.616,0.31-1.935,1.883-1.936c4.318-0.003,8.637-0.003,12.955,0
													c1.59,0.001,1.886,0.303,1.886,1.925c0.002,7.133,0.002,14.267,0,21.4c-0.001,1.564-0.35,1.908-1.927,1.909
													c-4.286,0.002-8.573,0.002-12.859,0c-1.584-0.001-1.936-0.343-1.937-1.898C9.144,23.17,9.146,19.587,9.146,16.005z M25.025,16.006
													c0-3.582-0.019-7.164,0.015-10.746c0.007-0.778-0.211-1.064-1.023-1.058c-4.349,0.032-8.699,0.03-13.048,0.001
													c-0.758-0.005-0.99,0.238-0.987,0.995c0.024,7.228,0.024,14.456,0.001,21.684c-0.002,0.772,0.274,0.983,1.009,0.979
													c4.317-0.025,8.635-0.031,12.953,0.004c0.852,0.007,1.103-0.289,1.096-1.114C25.006,23.17,25.025,19.588,25.025,16.006z"></path>
                                <path fill="#333333" d="M17.722,29.337c0.989,0.006,1.843,0.845,1.859,1.826c0.017,1.023-0.872,1.891-1.908,1.863
													c-1.021-0.028-1.79-0.836-1.781-1.871C15.902,30.127,16.703,29.331,17.722,29.337z M18.883,31.459
													c0.006-0.145,0.012-0.291,0.018-0.436c-0.391-0.278-0.785-0.774-1.172-0.769c-0.344,0.005-0.868,0.513-0.976,0.894
													c-0.173,0.609,0.317,1.108,0.909,1.056C18.087,32.166,18.477,31.722,18.883,31.459z"></path>
                                <path fill="#333333" d="M17.51,2.713c-0.637-0.001-1.277,0.03-1.91-0.019c-0.193-0.015-0.369-0.25-0.553-0.385
													c0.173-0.147,0.343-0.417,0.521-0.422c1.273-0.038,2.549-0.039,3.822-0.005c0.188,0.005,0.37,0.256,0.554,0.393
													c-0.206,0.146-0.401,0.397-0.619,0.418C18.724,2.751,18.115,2.713,17.51,2.713z"></path>
                                <path fill="#333333" d="M14.156,19.685c-0.146-0.12-0.322-0.203-0.317-0.272c0.017-0.2,0.049-0.446,0.176-0.58c0.681-0.719,1.391-1.41,2.093-2.11
													c1.47-1.468,2.931-2.945,4.424-4.39c0.204-0.198,0.568-0.231,0.858-0.341c-0.101,0.314-0.111,0.718-0.318,0.928
													c-2.086,2.117-4.202,4.204-6.315,6.295C14.583,19.386,14.372,19.518,14.156,19.685z"></path>
                                <path fill="#333333" d="M16.062,13.776c-0.12,0.162-0.199,0.302-0.308,0.412c-0.855,0.862-1.701,1.732-2.586,2.562
													c-0.161,0.151-0.484,0.13-0.733,0.189c0.053-0.242,0.028-0.559,0.174-0.714c0.832-0.883,1.697-1.735,2.572-2.576
													c0.138-0.132,0.381-0.198,0.579-0.206C15.85,13.438,15.95,13.646,16.062,13.776z"></path>
                                <path fill="#333333" d="M22.765,15.211c-0.138,0.193-0.227,0.361-0.356,0.491c-0.831,0.841-1.656,1.687-2.518,2.495
													c-0.165,0.154-0.483,0.144-0.731,0.209c0.046-0.243,0.01-0.564,0.153-0.716c0.83-0.884,1.696-1.736,2.569-2.579
													c0.141-0.136,0.373-0.216,0.572-0.236C22.54,14.867,22.647,15.078,22.765,15.211z"></path>
                            </g>
						</svg>
            </div>

            <h3 class="product_contact_title">Менеджер</h3>
            <div class="product_contact_text">+7 (495) 423-69-64</div>
        </div>


        <div class="product_contact_item">
            <div class="product_contact_icon">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
							<g>
                                <path fill="#333333" d="M18.398,3.285c4.66,0.161,9.465,1.858,12.928,6.358c1.873,2.435,2.63,5.226,2.003,8.284
													c-0.161,0.784,0.226,1.003,0.775,1.315c3.454,1.963,5.094,5.064,4.154,8.429c-0.373,1.334-1.315,2.578-2.234,3.663
													c-0.519,0.612-0.785,1.083-0.647,1.842c0.149,0.824,0.274,1.655,0.347,2.489c0.03,0.343-0.105,0.7-0.165,1.05
													c-0.321-0.121-0.653-0.219-0.957-0.372c-0.181-0.091-0.329-0.258-0.476-0.407c-1.418-1.436-2.877-2.184-5.149-1.99
													c-4.006,0.342-7.486-1.114-9.832-4.664c-0.188-0.285-0.747-0.408-1.151-0.453c-1.576-0.173-3.157-0.316-4.739-0.397
													c-0.405-0.021-0.91,0.118-1.222,0.367c-1.64,1.305-3.222,2.681-4.852,3.999c-0.285,0.231-0.701,0.299-1.057,0.443
													c-0.046-0.347-0.161-0.701-0.126-1.04c0.192-1.875,0.465-3.744,0.603-5.622c0.033-0.448-0.204-1.129-0.548-1.359
													C0.58,21.553-0.801,12.323,6.512,6.835C9.782,4.381,13.503,3.297,18.398,3.285z M7.229,31.319c1.509-1.202,2.832-2.361,4.271-3.35
													c0.545-0.374,1.401-0.587,2.046-0.475c4.889,0.845,9.523,0.211,13.692-2.514c6.581-4.302,7.083-12.098,1.207-17.04
													c-5.786-4.867-16.039-4.809-21.855,0c-5.827,4.817-5.103,13.279,0.288,16.636c0.439,0.273,0.734,1.122,0.727,1.699
													C7.588,27.9,7.378,29.523,7.229,31.319z M32.973,19.803c-2.556,5.528-7.214,7.942-12.957,9.034c0.5,0.608,0.829,1.092,1.24,1.492
													c2.153,2.097,4.865,3.012,7.722,2.624c2.208-0.3,3.809,0.233,5.279,1.708c0.032,0.032,0.144-0.017,0.279-0.037
													c-0.068-0.581-0.126-1.162-0.205-1.741c-0.123-0.903,0.113-1.576,0.908-2.159c1.955-1.435,2.579-3.471,2.167-5.791
													C36.957,22.4,35.267,20.884,32.973,19.803z"></path>
                                <path fill="#333333" d="M17.922,17.881c-0.981,0.026-1.844-0.899-1.847-1.982c-0.003-1.033,0.765-1.92,1.711-1.977
													c0.993-0.06,1.88,0.823,1.912,1.903C19.729,16.905,18.909,17.855,17.922,17.881z M19.422,16.174
													c-0.278-1.158-0.664-1.762-1.583-1.73c-0.921,0.032-1.272,0.668-1.253,1.525c0.019,0.829,0.497,1.47,1.274,1.342
													C18.428,17.218,18.905,16.573,19.422,16.174z"></path>
                                <path fill="#333333" d="M24.698,13.923c0.998-0.008,1.834,0.905,1.824,1.991c-0.01,1.023-0.802,1.919-1.739,1.967
													c-0.977,0.05-1.865-0.866-1.885-1.945C22.878,14.85,23.7,13.931,24.698,13.923z M23.184,16.219
													c0.501,0.384,0.969,1.022,1.512,1.094c0.882,0.116,1.335-0.575,1.315-1.463c-0.018-0.82-0.409-1.404-1.279-1.407
													C23.794,14.44,23.428,15.062,23.184,16.219z"></path>
                                <path fill="#333333" d="M11.095,13.923c0.996,0.023,1.811,0.956,1.779,2.037c-0.032,1.069-0.943,1.985-1.912,1.92
													c-0.936-0.062-1.718-0.969-1.716-1.99C9.248,14.807,10.1,13.9,11.095,13.923z M12.591,16.19c-0.264-1.147-0.64-1.764-1.575-1.746
													c-0.87,0.017-1.249,0.612-1.256,1.429c-0.008,0.887,0.453,1.574,1.335,1.441C11.638,17.231,12.095,16.583,12.591,16.19z"></path>
                            </g>
				</svg>
            </div>

            <h3 class="product_contact_title">online</h3>
            <div class="product_contact_text">
                <a href="javascript:;" id="modalShow">Задать вопрос</a>
            </div>
        </div>


        <div class="product_contact_item">
            <div class="product_contact_icon">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
						<g>
                            <path fill="#333333" d="M19.819,38.334c-0.196-0.256-0.37-0.534-0.592-0.766c-3.971-4.136-7.538-8.564-10.091-13.741
												C6.913,19.319,6.29,14.692,8.281,9.953c1.862-4.431,5.072-7.313,9.926-8.147c0.114-0.02,0.22-0.092,0.329-0.14
												c0.978,0,1.955,0,2.933,0c0.615,0.154,1.242,0.273,1.844,0.467c5.361,1.733,8.232,5.614,9.329,10.961
												c0.757,3.686-0.105,7.142-1.708,10.453c-2.567,5.3-6.204,9.83-10.213,14.088c-0.2,0.213-0.358,0.465-0.535,0.699
												C20.064,38.334,19.941,38.334,19.819,38.334z M19.965,37.091c0.915-1.016,1.749-1.897,2.535-2.82
												c3.255-3.824,6.242-7.825,8.189-12.505c2.065-4.964,1.731-9.755-1.349-14.183C24.831,1.102,15.875,0.856,11.03,7.084
												c-3.081,3.961-3.778,8.458-2.262,13.238c1.483,4.679,4.287,8.602,7.344,12.354C17.319,34.158,18.624,35.56,19.965,37.091z"></path>
                            <path fill="#333333" d="M26.102,15.065c0.01,3.391-2.692,6.13-6.079,6.158c-3.363,0.027-6.121-2.718-6.129-6.103
												c-0.009-3.41,2.682-6.127,6.077-6.134C23.377,8.978,26.091,11.669,26.102,15.065z M25.168,15.128
												c0.009-2.909-2.295-5.204-5.236-5.213c-2.786-0.008-5.09,2.318-5.1,5.149c-0.01,2.889,2.254,5.188,5.134,5.211
												C22.827,20.298,25.158,17.993,25.168,15.128z"></path>
                        </g>
				</svg>
            </div>

            <h3 class="product_contact_title">offline</h3>
            <div class="product_contact_text"><a href="{{route('dealer.list')}}">Где купить</a></div>


        </div>
    </div><!-- CONTACTS -->
</div><!-- END TOP -->

<div class="product_content">
    <ul class="product_tab_ul">
        @if($product->description)<li class="product_tab_li active" data-name="discrip">Описание</li>@endif
        @if($product->accessory)<li class="product_tab_li" data-name="property">Аксессуары</li>@endif
        @if($product->documents->isNotEmpty())<li class="product_tab_li" data-name="doc">Документы</li>@endif
    </ul>

    <div class="product_tab_wrap" id="tabWrapper">
        @if($product->description)<div class="product_tab behold" data-tab="discrip">{!! $product->description !!}</div>@endif
        @if($product->accessory)<div class="product_tab" data-tab="property">{!! $product->accessory !!}</div>@endif
        @if($product->documents->isNotEmpty())
            <div class="product_tab" data-tab="doc">
                @foreach($product->documents as $document)
                <div class="product_doc_item">
                    <a href="{{asset($document->file)}}" target="_blank" class="product_doc_icon"></a>
                    <div class="product_doc_info">
                        <a href="{{asset($document->file)}}" target="_blank" class="product_doc_link">{{$document->name}}</a>
                        <span class="product_doc_size">({{$document->size}})</span>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>

</div>

<script type="application/ld+json">
    {
        "@context": "https://schema.org/",
        "@type": "Product",
        "name": "{{$product->name}}",
        "image": [
            "{{asset($product->img)}}"@if($product->images->isNotEmpty()) @foreach($product->images as $image), "{{asset($image->img)}}"@endforeach @endif
       ],
        "description": "{{ $product->summary ? strip_tags($product->summary) : substr(strip_tags($product->description), 0, 200) }}",
        @if($product->art_number)
        "sku": "{{$product->art_number}}",
        @endif
        @if($brand)
        "brand": {
            "@type": "Brand",
            "name": "{{$brand}}"
        },
        @endif
        "offers": {
            "@type": "Offer",
            "url": "{{ route('catalog.product', ['slug' => $product->slug]) }}",
            "priceCurrency": "RUB",
            "price": "{{ str_replace(' ','',$product->cost) }}",
            "priceValidUntil": "{{ Carbon\Carbon::now()->toDateString()}}",
            "itemCondition": "https://schema.org/NewCondition",
            "availability": "https://schema.org/InStock",
            "seller": {
                "@type": "Organization",
                "name": "OOO FIRE-CRAFT"
            }
        }
    }
</script>
@endsection
