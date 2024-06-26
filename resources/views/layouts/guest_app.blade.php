<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@yield('title') - {{ !empty(get_setting('site_title')) ? get_setting('site_title'): 'Mirjob'  }}</title>
    <link rel="icon" type="image/x-icon"
          href="{{ !empty(get_setting('fav_icon')) ? asset('storage/upload/'.get_setting('fav_icon')): asset('backend/assets/img/favicon.ico') }}"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('backend/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend/assets/css/plugins.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend/assets/css/authentication/form-2.css') }}" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/forms/theme-checkbox-radio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/forms/switches.css') }}">
    <link href="{{ asset('backend/assets/css/loader.css') }}" rel="stylesheet" type="text/css"/>
    <script src="{{ asset('backend/assets/js/loader.js') }}"></script>
    @stack('styles')
</head>
<body>
<!-- BEGIN LOADER -->
<div id="load_screen">
    <div class="loader">
        <div class="loader-content">
            <div class="spinner-grow align-self-center"></div>
        </div>
    </div>
</div>
<!--  END LOADER -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3 px-2 justify-content-between border-bottom-0">
    <div class="container justify-content-between">
        <a class="navbar-brand" href="{{ route('home') }}">
            @if(!empty(get_setting('site_logo')))
                <img src="{{ asset('storage/upload/'.get_setting('site_logo'))  }}" alt="Logo" width="100">
            @else
                {{ get_setting('site_title') }}
            @endif

        </a>
        <button class="navbar-toggler border-0 text-white" type="button" data-toggle="collapse"
                data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="feather feather-menu">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </button>
        <div class="collapse navbar-collapse flex-grow-0" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
                </li>
                <li class="nav-item {{ request()->routeIs('login') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                <li class="nav-item {{ request()->routeIs('register') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="min-vh-80">
    @section('content')
    @show
</div>

<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @include('layouts.partials.footer')
            </div>
        </div>
    </div>
</div>
<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset('backend/assets/js/libs/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('backend/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('backend/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- END GLOBAL MANDATORY SCRIPTS -->
@stack('scripts')
</body>
</html>
