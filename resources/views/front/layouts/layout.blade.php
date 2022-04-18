@include('front.layouts.header')
<div class="container">
    <h1 class="title">@yield('h1')</h1>
    @yield('breadcrumbs')
    <div class="grid_wrap">
        <div class="grid_content">
            @yield('content')
        </div>
    </div>
</div>
@include('front.layouts.footer')
