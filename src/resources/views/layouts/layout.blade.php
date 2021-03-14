<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" dir="{{config('app.locale')==='ar'?'rtl':'ltr'}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
{{--    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">--}}
{{--    <meta name="author" content="Creative Tim">--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! app('seotools')->generate() !!}
    <!-- Favicon -->
    <link rel="icon" href="{{asset('vendor/dashboard/img/brand/favicon.png')}}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('vendor/dashboard/vendor/nucleo/css/nucleo.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('vendor/dashboard/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">
    <!-- Page plugins -->
    <!-- Argon CSS -->
    @if (config('app.locale')==='ar')
        <link rel="stylesheet" href="{{asset('vendor/dashboard/css/argon.rtl.css')}}" type="text/css">
    @else
        <link rel="stylesheet" href="{{asset('vendor/dashboard/css/argon.css')}}" type="text/css">
    @endif
    @stack('css')
</head>

<body class="{{isset($auth)? 'bg-default':''}} g-sidenav-show g-sidenav-pinned" data-gr-c-s-loaded="true">
@if (!isset($auth))
    @include('dashboard::layouts.sidebar')
    <div class="main-content" id="panel">
    @include('dashboard::layouts.header')
    <!-- Header -->
    @stack('header')

    <!-- Page content -->
        <div class="container-fluid mt--6">
            @yield('content')
            @include('dashboard::layouts.footer')
        </div>
    </div>
@else
    <div class="main-content" id="panel">
        @yield('content')
    </div>
@endif

@stack('model')

<!-- Argon Scripts -->
<!-- Core -->
<script src="{{asset('vendor/dashboard/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('vendor/dashboard/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/dashboard/vendor/js-cookie/js.cookie.js')}}"></script>
<script src="{{asset('vendor/dashboard/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
<script src="{{asset('vendor/dashboard/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
@include('sweetalert::alert')

<!-- Optional JS -->
@stack('library')
<!-- Argon JS -->
<script src="{{asset('vendor/dashboard/js/argon.js?v=1.2.0')}}"></script>
@stack('js')
<script>
    $(function(){
        $('#sidenav-collapse-main .navbar-nav .nav-item .nav-link').map(function(i,element){
            if (i===0){
                if(window.location.href===($(element).attr('href').toString())) $(element).addClass('active')

            }else
            if(window.location.href.match($(element).attr('href').toString())) $(element).addClass('active')
        });
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function readURL(input,id) {

        if (input.files.length>0) {

            var reader = new FileReader();

            reader.onload = function(e) { $('#'+id).attr('src', e.target.result); };

            reader.readAsDataURL(input.files[0]); // convert to base64 string

        }

    }
</script>
</body>

</html>
