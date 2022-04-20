@include('front.layouts.header')
<main class="container">
    @yield('breadcrumbs')
    <h1 class="main_title">@yield('h1')</h1>
    @yield('content')
</main>
@include('front.layouts.footer')
