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
                        <form method="post" id="systemsetting_form" enctype="multipart/form-data" action="{{ route('systemsetting.postsystemsetting') }}">
                            {{ csrf_field() }}
                            <div class="form-group " >
                                <label for="host" >Enter Date Format</label>
                                <select name="dateformat" id="dateformat" class="form-control" data-plugin="select2">
                                    <option value="d-M-yy"  {{ isset($systemsetting) ? ($systemsetting->dateformat === "d-M-yy") ? "selected" : "" : "selected" }} >10-Nov-2016</option>
                                    <option value="m/d/yy"  {{ isset($systemsetting) ? ($systemsetting->dateformat === "m/d/yy") ? "selected" : "" : "" }} >11/10/2016</option>
                                    <option value="m-d-yy"  {{ isset($systemsetting) ? ($systemsetting->dateformat === "m-d-yy") ? "selected" : "" : "" }} >11-10-2016</option>
                                    <option value="m.d.yy"  {{ isset($systemsetting) ? ($systemsetting->dateformat === "m.d.yy") ? "selected" : "" : "" }} >11.10.2016</option>
                                    <option value="yy/m/d"  {{ isset($systemsetting) ? ($systemsetting->dateformat === "yy/m/d") ? "selected" : "" : "" }} >2016/11/10</option>
                                    <option value="yy-m-d"  {{ isset($systemsetting) ? ($systemsetting->dateformat === "yy-m-d") ? "selected" : "" : "" }} >2016-11-10</option>
                                    <option value="yy.m.d"  {{ isset($systemsetting) ? ($systemsetting->dateformat === "yy.m.d") ? "selected" : "" : "" }} >2016.11.10</option>
                                    <option value="d/m/yy"  {{ isset($systemsetting) ? ($systemsetting->dateformat === "d/m/yy") ? "selected" : "" : "" }} >10/11/2016</option>
                                    <option value="d-m-yy"  {{ isset($systemsetting) ? ($systemsetting->dateformat === "d-m-yy") ? "selected" : "" : "" }} >10-11-2016</option>
                                    <option value="d.m.yy"  {{ isset($systemsetting) ? ($systemsetting->dateformat === "d.m.yy") ? "selected" : "" : "" }} >10.11.2016</option>
                                </select>
                            </div>
                            <div class="form-group" >
                                <label for="port" >Enter Country</label>
                                <select name="country" id="country" data-placeholder="Choose a Country..." class="form-control" data-plugin="select2">
                                    <option value="India" {{ isset($systemsetting) ? ($systemsetting->country === "India") ? "selected" : "" : "selected" }}  >India</option>
                                    <option value="United States" {{ isset($systemsetting) ? ($systemsetting->country === "United States") ? "selected" : "" : "" }}  >United States</option>
                                    <option value="Malaysia" {{ isset($systemsetting) ? ($systemsetting->country === "Malaysia") ? "selected" : "" : "" }}  >Malaysia</option>
                                    <option value="Saudi Arabia" {{ isset($systemsetting) ? ($systemsetting->country === "Saudi Arabia") ? "selected" : "" : "" }}  >Saudi Arabia</option>
                                    <option value="UAE" {{ isset($systemsetting) ? ($systemsetting->country === "UAE") ? "selected" : "" : "" }}  >UAE</option>
                                    <option value="Sri Lanka" {{ isset($systemsetting) ? ($systemsetting->country === "Sri Lanka") ? "selected" : "" : "" }}  >Sri Lanka</option>
                                    <option value="United Kingdom" {{ isset($systemsetting) ? ($systemsetting->country === "United Kingdom") ? "selected" : "" : "" }}  >United Kingdom</option>
                                    <option value="South Africa" {{ isset($systemsetting) ? ($systemsetting->country === "South Africa") ? "selected" : "" : "" }}  >South Africa</option>
                                    <option value="Canada" {{ isset($systemsetting) ? ($systemsetting->country === "Canada") ? "selected" : "" : "" }}  >Canada</option>
                                </select>
                            </div>
                            <div class="form-group" >
                                <label for="username" >Enter Currency Symbol</label>
                                <input type="text" name="currencysymbol" id="currencysymbol" value="{{ isset($systemsetting) ? $systemsetting->currencysymbol : old('currencysymbol') }}"  class="form-control" />
                            </div>
                            <div class="form-group" >
                                <label for="password" >Enter Currency Symbol Placement</label>
                                <select name="currencysymbolplacement" id="currencysymbolplacement" data-placeholder="Choose a Placement..." class="form-control" data-plugin="select2">
                                    <option value="before" {{ isset($systemsetting) ? ($systemsetting->currencysymbolplacement === "before") ? "selected" : "" : "selected" }}>Before</option>
                                    <option value="after" {{ isset($systemsetting) ? ($systemsetting->currencysymbolplacement === "after") ? "selected" : "" : "" }}>After</option>
                                </select>
                            </div>
                            <div class="form-group" >
                                <label for="encryption" >Enter Decimal Places</label>
                                <select name="decimalplace" id="decimalplace" data-placeholder="Choose a Decimal Places..." class="form-control" data-plugin="select2">
                                    <option value="0"  {{ isset($systemsetting) ? ($systemsetting->currencysymbolplacement === "after") ? "selected" : "" : "selected" }} >0</option>
                                    <option value="2"  {{ isset($systemsetting) ? ($systemsetting->currencysymbolplacement === "after") ? "selected" : "" : "" }} >2</option>
                                    <option value="3"  {{ isset($systemsetting) ? ($systemsetting->currencysymbolplacement === "after") ? "selected" : "" : "" }}>3</option>
                                </select>
                            </div>

                            <div class="form-group" >
                                <label for="encryption" >Enter Company Title</label>
                                <input type="text" name="companytitle" id="companytitle"  value="{{ isset($systemsetting) ? $systemsetting->companytitle : old('companytitle') }}"  class="form-control" />
                                <!--<select name="number_of_list"   class="form-control" data-plugin="select2">
                                    <option value="10" {{ isset($systemsetting) ? ($systemsetting->currencysymbolplacement === "10") ? "selected" : "" : "selected" }} >10</option>
                                    <option value="20" {{ isset($systemsetting) ? ($systemsetting->currencysymbolplacement === "20") ? "selected" : "" : "" }} >20</option>
                                    <option value="30" {{ isset($systemsetting) ? ($systemsetting->currencysymbolplacement === "30") ? "selected" : "" : "" }} >30</option>
                                    <option value="50" {{ isset($systemsetting) ? ($systemsetting->currencysymbolplacement === "50") ? "selected" : "" : "" }} >50</option>
                                    <option value="100" {{ isset($systemsetting) ? ($systemsetting->currencysymbolplacement === "100") ? "selected" : "" : "" }} >100</option>
                                </select>-->
                            </div>

                            <div class="form-group" >
                                <label for="encryption" >Enter Company Logo</label>
                                <input type="file" class="form-control" id="companylogo" name="companylogo" value="" >
                                <img src="{{ isset($systemsetting) ? URL::asset('images/logos/'.$systemsetting->companylogo) : '' }}" height="30"/>
                            </div>

                            <div class="form-group" >
                                <label for="bcc" >Check to BCC all mail to Admin</label>
                                <select name="bcc" id="bcc"  class="form-control" data-plugin="select2">
                                    <option value="yes" {{ isset($systemsetting) ? ($systemsetting->bcc === "yes") ? "selected" : "" : "selected" }} >Yes</option>
                                    <option value="no" {{ isset($systemsetting) ? ($systemsetting->bcc === "no") ? "selected" : "" : "" }}  >No</option>
                                </select>
                                <span class="help-block m-b-none">
                                i.Send all outgoing emails as BCC to the Admin Account<br/>
                                ii.The admin account is the account that was created with PaymentFollow.</span>
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
<link rel="stylesheet" href="{{URL::asset('/global/vendor/select2/select2.css') }}">
<link rel="stylesheet" href="{{URL::asset('/global/vendor/bootstrap-select/bootstrap-select.css') }}">
<link rel="stylesheet" href="{{URL::asset('/global/vendor/multi-select/multi-select.css') }}">
<link rel="stylesheet" href="{{URL::asset('/assets/examples/css/forms/advanced.css') }}">
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
        <script src="{{URL::asset('/global/vendor/select2/select2.full.min.js') }}"></script>
        <script src="{{URL::asset('/global/vendor/bootstrap-select/bootstrap-select.js') }}"></script>
        <script src="{{URL::asset('/global/vendor/multi-select/jquery.multi-select.js') }}"></script>
        <script src="{{URL::asset('/global/js/Plugin/select2.js') }}"></script>
        <script src="{{URL::asset('/global/js/Plugin/bootstrap-select.js') }}"></script>
        <script src="{{URL::asset('/global/js/Plugin/multi-select.js') }}"></script>
        <script src="{{URL::asset('/assets/examples/js/forms/advanced.js') }}"></script>
 @endsection
