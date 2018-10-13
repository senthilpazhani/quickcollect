@extends('layouts.default')
@section('content')
<!-- Panel FixedHeader -->
<div class="page">
    <!--<div class="page-header">
        <h1 class="page-title"></h1>
    </div>-->
    <div class="page-content">
        <div class="panel panel-bordered">
            <div class="panel-heading"><h3 class="panel-title">{{ $page_title}}</h3>
                <ul class="panel-actions panel-actions-keep">
                    <li><button type="button" name="add" id="add_data" class="btn btn-success btn-sm">Add</button></li>
                </ul>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <span id="form_output">
                            {!! isset($success_output) ? ($success_output !== '') ? '<div class="alert alert-success">'.$success_output.'</div>' : '' : '' !!}
                            @if(count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>You have some errors:</strong>
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </span>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <form method="post" id="smtp_form" action="{{ route('smtp.postsmtp') }}">
                            {{ csrf_field() }}
                            <div class="form-group " >
                                <label for="host" >Enter Host</label>
                                <input type="text" name="host" id="host" value="{{ isset($smtp) ? $smtp->host : old('host') }}" class="form-control" />
                            </div>
                            <div class="form-group" >
                                <label for="port" >Enter Port</label>
                                <input type="text" name="port" id="port"  value="{{ isset($smtp) ? $smtp->port : old('port') }}" class="form-control" />
                            </div>
                            <div class="form-group" >
                                <label for="username" >Enter User Name</label>
                                <input type="text" name="username" id="username" value="{{ isset($smtp) ? $smtp->username : old('username') }}"  class="form-control" />
                            </div>
                            <div class="form-group" >
                                <label for="password" >Enter Password</label>
                                <input type="text" name="password" id="password"  value="{{ isset($smtp) ? $smtp->password : old('password') }}"  class="form-control" />
                            </div>
                            <div class="form-group" >
                                <label for="encryption" >Enter Encryption</label>
                                <input type="text" name="encryption" id="encryption"  value="{{ isset($smtp) ? $smtp->encryption : old('encryption') }}"  class="form-control" />
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="submit" class="btn btn-success" id="action" >Save</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('pagescript_top')
<style>.form-group{margin-bottom:0.5rem;}</style>
@endsection
@section('jsscript')

<script type="text/javascript">
    (function(document, window, $){
    'use strict';

    var Site = window.Site;
    $(document).ready(function(){
        Site.run();
    });
    })(document, window, jQuery);

</script>
@endsection
@section('pagescript_bot')
   <!-- Page -->
        <script src="{{URL::asset('global/vendor/bootbox/bootbox.js') }}"></script>
        <script src="{{URL::asset('assets/js/Site.js') }}"></script>
        <script src="{{URL::asset('global/js/Plugin/asscrollable.js') }}"></script>
        <script src="{{URL::asset('global/js/Plugin/slidepanel.js') }}"></script>
        <script src="{{URL::asset('/global/js/Plugin/alertify.js') }}"></script>
        <script src="{{URL::asset('/global/js/Plugin/notie-js.js') }}"></script>
 @endsection
