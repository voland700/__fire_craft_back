@include('front.layouts.header')
<div class="container">
    @yield('breadcrumbs')
    <h1 class="main_title">@yield('h1')</h1>
    @yield('content')
</div>
@include('front.layouts.footer')
