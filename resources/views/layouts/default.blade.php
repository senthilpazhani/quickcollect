<!-- {{ Config::get('app.locale') }}{{ __('passwords.password') }} -->
<!-- @lang('passwords.password',['name'=>'my name']) :name
{{ trans_choice('header.item',2) }} 'item'=>'Item (:count) | Items (:count)' -->
@include('layouts.header')
<!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
@include('layouts.menu')
@include('layouts.sidemenu')
@yield('content')
@include('layouts.footer')

