@extends('layouts.default')
@section('content')
    <!-- Page -->
    <div class="page">
      <div class="page-header">
        <h1 class="page-title">{{ Auth::user()->name }}</h1>
      </div>
      <div class="page-content">
        <div class="panel">
          <div class="panel-heading">
            <h3 class="panel-title">{{ $page_title }}</h3>
          </div>
          <div class="panel-body">
            <p>PSK</p>
          </div>
        </div>
      </div>
    </div>
    <!-- End Page -->
@endsection

@section('pagescript_top')
@endsection
@section('pagescript_bot')
    <!-- Page -->
    <script src="{{URL::asset('/assets/js/Site.js') }}"></script>
    <script src="{{URL::asset('/global/js/Plugin/asscrollable.js') }}"></script>
    <script src="{{URL::asset('/global/js/Plugin/slidepanel.js') }}"></script>
    <script src="{{URL::asset('/global/js/Plugin/switchery.js') }}"></script>
@endsection
@section('jsscript')
<script>
    (function(document, window, $){
    'use strict';

    var Site = window.Site;
    $(document).ready(function(){
        Site.run();
    });
    })(document, window, jQuery);
</script>
@endsection
