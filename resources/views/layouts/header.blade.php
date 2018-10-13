<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="{{ config('app.meta_description', 'PSK Description') }}">
    <meta name="author" content="{{ config('app.meta_author', 'PSK') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Quick Collect') }} - {{ $page_title }}</title>

    <link rel="apple-touch-icon" href="{{URL::asset('/images/logo.png')}}">
    <link rel="shortcut icon" href="{{URL::asset('/images/faviconNew.ico')}}">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{URL::asset('/global/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/global/css/bootstrap-extend.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/assets/css/site.min.css')}}">

    <!-- Plugins -->

    <link rel="stylesheet" href="{{URL::asset('/global/vendor/animsition/animsition.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/global/vendor/waves/waves.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/global/vendor/asscrollable/asScrollable.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/global/vendor/switchery/switchery.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/global/vendor/intro-js/introjs.css')}}">

    <link rel="stylesheet" href="{{URL::asset('/global/vendor/slidepanel/slidePanel.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/global/vendor/flag-icon-css/flag-icon.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/global/vendor/waves/waves.css')}}">

    @yield('pagescript_top')

    <!-- Fonts -->
    <link rel="stylesheet" href="{{URL::asset('/global/fonts/material-design/material-design.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/global/fonts/brand-icons/brand-icons.min.css')}}">
    <link rel='stylesheet' ref='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito" type="text/css">

    <!--[if lt IE 9]>
    <script src="{{URL::asset('/global/vendor/html5shiv/html5shiv.min.js')}}"></script>
    <![endif]-->

    <!--[if lt IE 10]>
    <script src="{{URL::asset('/global/vendor/media-match/media.match.min.js')}}"></script>
    <script src="{{URL::asset('/global/vendor/respond/respond.min.js')}}"></script>
    <![endif]-->

    <!-- Scripts -->
    <script src="{{URL::asset('/global/vendor/breakpoints/breakpoints.js')}}"></script>
    <script>
      Breakpoints();
    </script>

</head>
<body class="animsition site-menubar-unfold site-menubar-keep">
