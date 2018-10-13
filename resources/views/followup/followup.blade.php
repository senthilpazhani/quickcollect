@extends('layouts.default')
@section('content')
<!-- Panel FixedHeader -->
<div class="page">
    <div class="page-content">
        <div class="panel panel-bordered">
            <div class="panel-heading"><h3 class="panel-title">{{ $page_title}}</h3>
                <ul class="panel-actions panel-actions-keep">
                    <li><button type="button" name="add" id="add_data" class="btn btn-success btn-sm">Add</button>
                    <button class="btn btn-primary" data-target="#examplePositionCenter" data-toggle="modal"
                            type="button">Generate</button></li>
                </ul>
            </div>
            <div class="panel-body">
                <div id="alertmessage"></div>
                <div class="nput-search input-group learfix">
                        <span class="input-group-addon">Customer</span>
                        <select data-plugin="select2" class="form-control"  id="customer" name="customer" placeholder="Choose Customer...">
                            <option value="">Select</option>
                            @foreach($customers as $customer)
                            <option value="{{$customer->id}}">{{$customer->name}} - {{$customer->email}} - {{$customer->mobile}}</option>
                            @endforeach
                        </select>
                        <span class="input-group-addon">
                            <button type="submit" class="input-search-btn" id="add_customer">
                                <i class="icon wb-plus-circle" aria-hidden="true"></i>
                            </button>
                        </span>
                </div>
                <input type="hidden" name="followup_customerid" value="1" id="followup_customerid" class="form-control" />
                <br/>
                <table class="table able-bordered w-full table-hover able-striped dataTable no-footer"  id="listitem_table" data-plugin="selectable" data-row-selectable="true">
                    <thead class="bg-grey-100">
                    <tr>
                        <th>#</th>
                        <th>Order Detail</th>
                        <th>Order Value</th>
                        <th>Received</th>
                        <th>Receivable</th>
                        <th>Tags</th>
                        <th class="hidden-sm-down">
                        Action
                        </th>
                    </tr>
                    </thead>
                </table>
                <form method="post" id="systemsetting_form" enctype="multipart/form-data" action="{{ route('systemsetting.postsystemsetting') }}">
                    {{ csrf_field() }}
                    <div class="panel panel-primary panel-line">
                        <div class="panel-heading" >
                            <h3 class="panel-title" style="padding-left:15px !important;">Primary Panel <small>Order Value : $ 32434343
                            Receivable : $ 3243434</small></h3>
                            <ul class="panel-actions panel-actions-keep" style="top: 60% !important; right: 210px !important;"><li><h4>Followup History</h4></li></ul>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-8" style="padding-left:0px;">
                                    <div class="row">
                                        <div class="col-md-6" >
                                            <div class="form-group " >
                                            <div class="input-group">
                                                    <span class="input-group-addon">
                                                       Followup Status
                                                    </span>
                                                    <select name="followupstatus" id="followupstatus" class="form-control" data-plugin="select2">
                                                    <option value="d-M-yy" data-subtext="teste" {{ isset($systemsetting) ? ($systemsetting->dateformat === "d-M-yy") ? "selected" : "" : "selected" }} >Paid</option>
                                                    <option value="m/d/yy"  {{ isset($systemsetting) ? ($systemsetting->dateformat === "m/d/yy") ? "selected" : "" : "" }} >In Followup</option>
                                                    <option value="m/d/yy"  {{ isset($systemsetting) ? ($systemsetting->dateformat === "m/d/yy") ? "selected" : "" : "" }} >Dropped</option>
                                                    <option value="m/d/yy"  {{ isset($systemsetting) ? ($systemsetting->dateformat === "m/d/yy") ? "selected" : "" : "" }} >Bad Debt</option>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="padding-left:0px;">
                                            <div class="form-group " >
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                       Amount Paid
                                                    </span>
                                                    <input type="text" name="amountpaid" id="amountpaid" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12" >
                                            <div class="form-group " >
                                                <label for="customer" >Comment</label>
                                                <textarea name="followupstatus" id="followupstatus" rows="5" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" >
                                            <div class="form-group " >
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        Next Followup
                                                    </span>
                                                    <input type="text" class="form-control" data-plugin="datepicker">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" >
                                            <div class="row">
                                                <div class="col-md-5" style="padding-left:0px;">
                                                    <div class="form-group " >
                                                        <div class="checkbox-custom checkbox-primary">
                                                            <input type="checkbox" name="followupchk" id="followupchk" />
                                                            <label for="followupchk">Don't Followup</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-7" style="padding-left:10px;" >
                                                    <div class="form-group " >
                                                    <div class="checkbox-custom checkbox-primary">
                                                        <input type="checkbox" name="mailchk" id="mailchk" />
                                                        <label for="mailchk">Don't Send Mail</label>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group float-right" >
                                            <input type="hidden" name="emailtemplate_id" id="emailtemplate_id" value="" />
                                            <input type="hidden" name="button_action" id="button_action" value="insert" />
                                            <button type="submit" name="submit" class="btn btn-success" id="action" >Save</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" style="border:1px solid #efefef !important;padding:5px">
                                    <!-- Widget Chat -->
                                    <div class="card-block" style="padding:0px;" >
                                        <div class="chats" style="padding:0px;height:400px;overflow:auto;"  >
                                            <div class="chat chat-left">
                                                <div class="chat-avatar">
                                                    <a class="avatar" data-toggle="tooltip" href="#" data-placement="left" title="">
                                                        <img src="../../global/portraits/5.jpg" alt="Edward Fletcher">
                                                    </a>
                                                </div>
                                                <div class="chat-body">
                                                    <div class="chat-content" data-toggle="tooltip" title="11:37:08 am">
                                                        <p>Good morning, sir.</p>
                                                        <p>What can I do for you?</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="chat">
                                                <div class="chat-avatar">
                                                    <a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title="">
                                                        <img src="../../global/portraits/4.jpg" alt="June Lane">
                                                    </a>
                                                </div>
                                                <div class="chat-body">
                                                    <div class="chat-content" data-toggle="tooltip" title="11:39:57 am">
                                                        <p>Well, I am just looking around.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="chat chat-left">
                                                <div class="chat-avatar">
                                                    <a class="avatar" data-toggle="tooltip" href="#" data-placement="left" title="">
                                                        <img src="../../global/portraits/5.jpg" alt="Edward Fletcher">
                                                    </a>
                                                </div>
                                                <div class="chat-body">
                                                    <div class="chat-content" data-toggle="tooltip" title="11:40:10 am">
                                                        <p>If necessary, please ask me.
                                                        Placuit pellat oportet sinat optimi consequi natum, naturalem monstret nominant delectatum homines inane fruentem accedunt. Cognosci regione phaedrum contenta. Putavisset fatendum laetetur inventore malit eventurum ostendis tenetur praesentium admonere. Iusto nullas odia salutatus dicturum videatur patientiamque accusamus, inmensae corporum efficerent, futuris affirmatis expeteremus meis torquato.


                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Widget Chat -->
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="followupModal" class="modal fade modal-fade-in-scale-up" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="followup_form">
                <div class="modal-header">
                    <h4 class="modal-title">Followup</h4>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <span id="followup_form_output"></span>

                    <div class="form-group" >
                        <label for="name" >Enter Order Details</label>
                        <input type="text" name="orderdetail" id="orderdetail" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Enter Order Value</label>
                        <input type="text" name="ordervalue" id="ordervalue" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Enter Received</label>
                        <input type="text" name="orderreceived" id="orderreceived" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Enter Receivable</label>
                        <input type="text" name="orderreceivable" id="orderreceivable" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="followup_id" id="followup_id" value="" />
                    <input type="hidden" name="followup_button_action" id="followup_button_action" value="insert" />
                    <button type="submit" name="submit" class="btn btn-success" id="followup_action" >Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="customerModal" class="modal fade modal-fade-in-scale-up" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="customer_form">
                <div class="modal-header">
                    <h4 class="modal-title">Add customer</h4>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <span id="customer_form_output"></span>
                    <div class="form-group" >
                        <label for="name" >Enter Name</label>
                        <input type="text" name="name" id="name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Enter Email</label>
                        <input type="text" name="email" id="email" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Enter Mobile</label>
                        <input type="text" name="mobile" id="mobile" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="customer_id" id="customer_id" value="" />
                    <input type="hidden" name="customer_button_action" id="customer_button_action" value="insert" />
                    <button type="submit" name="submit" class="btn btn-success" id="customer_action" >Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
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
<link rel="stylesheet" href="{{URL::asset('/global/fonts/web-icons/web-icons.css') }}">
<link rel="stylesheet" href="{{URL::asset('/global/vendor/bootstrap-datepicker/bootstrap-datepicker.css') }}">
<link rel="stylesheet" href="{{URL::asset('/global/vendor/jquery-labelauty/jquery-labelauty.css') }}">
<link rel="stylesheet" href="{{URL::asset('/global/vendor/asscrollable/asScrollable.css') }}">
<link rel="stylesheet" href="{{URL::asset('/assets/examples/css/advanced/scrollable.css') }}">
<link rel="stylesheet" href="{{URL::asset('/global/vendor/datatables.net-bs4/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{URL::asset('/global/vendor/datatables.net-fixedheader-bs4/dataTables.fixedheader.bootstrap4.css') }}">
<link rel="stylesheet" href="{{URL::asset('/global/vendor/datatables.net-fixedcolumns-bs4/dataTables.fixedcolumns.bootstrap4.css') }}">
<link rel="stylesheet" href="{{URL::asset('/global/vendor/datatables.net-rowgroup-bs4/dataTables.rowgroup.bootstrap4.css') }}">
<link rel="stylesheet" href="{{URL::asset('/global/vendor/datatables.net-scroller-bs4/dataTables.scroller.bootstrap4.css') }}">
<link rel="stylesheet" href="{{URL::asset('/global/vendor/datatables.net-select-bs4/dataTables.select.bootstrap4.css') }}">
<link rel="stylesheet" href="{{URL::asset('/global/vendor/datatables.net-responsive-bs4/dataTables.responsive.bootstrap4.css') }}">
<link rel="stylesheet" href="{{URL::asset('/global/vendor/datatables.net-buttons-bs4/dataTables.buttons.bootstrap4.css') }}">
<link rel="stylesheet" href="{{URL::asset('/assets/examples/css/tables/datatable.css') }}">
@endsection
@section('jsscript')

<script type="text/javascript">

    (function(document, window, $){
    'use strict';

        var Site = window.Site;
        $(document).ready(function(){
            Site.run();
            loadtable();
            function loadtable(){
                if ($('#followup_customerid').val() != '') {

                    var table = $('#listitem_table').DataTable({
                        "destroy": true,
                        "processing":true,
                        //"serverSide":true, //Uncaught Error: DataTables warning: table id=listitem_table - Ajax error. For more information about this error, please see http://datatables.net/tn/7
                        "autoWidth": false,
                        "ajax":{
                            "url":"{{ route('followupitem.getfollowupitem') }}",
                            "type":'GET',
                            "data":{"id":$('#followup_customerid').val()},
                        },
                        "columns":[
                            {"data":"id"},
                            {"data":"orderdetail"},
                            {"data":"orderdetail"},
                            {"data":"ordervalue"},
                            {"data":"orderreceived"},
                            //{"data":"receivable"},
                            {"data":"tags"},
                            {"data":"action",orderable:false,searchable:false,"width": "10%"},
                        ],
                        "rowCallback": function (nRow, aData, iDisplayIndex) {
                            var oSettings = this.fnSettings ();
                            $("td:first", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
                            return nRow;
                        },
                        "columnDefs": [ {
                            "searchable": false,
                            "orderable": false,
                            "targets": 0
                        } ],
                        "order": [[ 1, 'asc' ]],
                        responsive: true,
                    });
                    new $.fn.dataTable.FixedHeader( table );
                    $.fn.dataTable.ext.errMode = 'throw';
                }
            }


            $('#customer').on('change',function(){
                $('#followup_customerid').val($(this).val());
                if ($('#followup_customerid').val() != '') {
                    loadtable();
                }
                //$('#listitem_table').DataTable().ajax.reload();
            });

            $('#add_customer').click(function(){
                $('#customerModal').modal('show');
                $('#customer_form')[0].reset();
                $('#customer_form_output').html('');
                $('#customer_button_action').val('insert');
                $('#customer_action').html('Add');
            });
            $('#customer_form').on('submit',function(event){
                event.preventDefault();
                var form_data = $(this).serialize();

                $.ajax({
                    url:"{{ route('customer.postcustomer') }}",
                    method:"POST",
                    data:form_data,
                    dataType:"json",
                    success:function(data){
                        if(data.error.length > 0){
                            var error_html = '<div class="alert alert-danger">';
                            for(var count=0;count<data.error.length;count++){
                                error_html += ''+data.error[count]+'<br/>';
                            }
                            error_html += '</div>';
                            $('#customer_form_output').html(error_html);
                        }else{
                            $('#customerModal').modal('hide');
                            $('#alertmessage').html('<div class="alert alert-success">Customer has been added</div>').fadeIn(2500).delay(3000).fadeOut(2500);

                            var jsondata = JSON.parse(data.success);

                            var html = '<option value="">Choose Customer</option>';
                            for (var i = 0; i < jsondata.length; i++) {
                                    html += '<option value="' + jsondata[i]['id'] + '"';
                                    if ($('#email').val() == jsondata[i]['email'])
                                    {   html += 'selected=selected>' + jsondata[i]['name'] + ' <i>- ' + jsondata[i]['email'] + ' - ' + jsondata[i]['mobile'] + '</i></option>';
                                        $('#followup_customerid').val(jsondata[i]['id']);
                                    }else{
                                        html += '>' + jsondata[i]['name']  + ' <i>- ' + jsondata[i]['email'] + ' - ' + jsondata[i]['mobile'] + '</i></option>';
                                    }

                            }
                            $("select[name='customer']").html(html);
                            $('#user_form')[0].reset();
                        }
                    },
                    error:function(jqXHR, exception){
                        $('#customer_form_output').html(jqXHR.responseText);
                    }

                });
            });

            //followup_customerid

            $('#add_followup').click(function(){
                $('#followupModal').modal('show');
                //$('#followup_form')[0].reset();
                $('#orderdetail').val('');
                $('#ordervalue').val('');
                $('#orderreceived').val('');
                $('#orderreceivable').val('');
                $('#followup_form_output').html('');
                $('#followup_button_action').val('insert');
                $('#followup_action').html('Add');
            });

            $('#followup_form').on('submit',function(event){
                event.preventDefault();
                var form_data = $(this).serialize();

                $.ajax({
                    url:"{{ route('followupitem.postfollowupitem') }}",
                    method:"POST",
                    data:form_data,
                    dataType:"json",
                    success:function(data){
                        if(data.error.length > 0){
                            var error_html = '<div class="alert alert-danger">';
                            for(var count=0;count<data.error.length;count++){
                                error_html += ''+data.error[count]+'<br/>';
                            }
                            error_html += '</div>';
                            $('#followup_form_output').html(error_html);
                        }else{
                            $('#followupModal').modal('hide');
                            $('#alertmessage').html(data.success).fadeIn(2500).delay(3000).fadeOut(2500);
                            $('#listitem_table').DataTable().ajax.reload();
                        }
                    },
                    error:function(jqXHR, exception){
                        $('#followup_form_output').html(jqXHR.responseText);
                    }

                });
            });

            $(document).on('click','.edit_followup',function(){
                var id=$(this).attr("data_id");

                $.ajax({
                    url:"{{ route('followupitem.fetchfollowupitem') }}",
                    method:"get",
                    data:{id:id},
                    dataType:'json',
                    success:function(data){
                        $('#followup_customerid').val(data.followup_customerid);
                        $('#orderdetail').val(data.orderdetail);
                        $('#ordervalue').val(data.ordervalue);
                        $('#orderreceived').val(data.orderreceived);
                        $('#orderreceivable').val(data.orderreceivable);
                        $('#tags').val(data.tags);
                        $('#followup_id').val(id);
                        $('#followupModal').modal('show');
                        $('#followup_form_output').html('');
                        $('#followup_action').html('Edit');
                        //$('.modal-title').text('Edit Template');
                        $('#followup_button_action').val('update');
                    }
                });
            });

            $(document).on('click','.delete_followup',function(){
                if(confirm("Are you sure to delete this Followup?"))
                {
                    var id=$(this).attr("data_id");
                    $.ajax({
                        url:"{{ route('followupitem.deletefollowupitem') }}",
                        method:"get",
                        data:{id:id},
                        dataType:'json',
                        success:function(data){
                            $('#alertmessage').html(data).fadeIn(2500).delay(3000).fadeOut(2500);
                            $('#listitem_table').DataTable().ajax.reload();
                            if (id != '') {
                                loadtable();
                            }
                        }
                    });
                }else{return false;}
            });


        });
    })(document, window, jQuery);

</script>
@endsection
@section('pagescript_bot')
   <!-- Page -->

   <script src="{{URL::asset('global/vendor/datatables.net/jquery.dataTables.js') }}"></script>
        <script src="{{URL::asset('global/vendor/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
        <script src="{{URL::asset('global/vendor/datatables.net-fixedheader/dataTables.fixedHeader.js') }}"></script>
        <script src="{{URL::asset('global/vendor/datatables.net-fixedcolumns/dataTables.fixedColumns.js') }}"></script>
        <script src="{{URL::asset('global/vendor/datatables.net-rowgroup/dataTables.rowGroup.js') }}"></script>
        <script src="{{URL::asset('global/vendor/datatables.net-scroller/dataTables.scroller.js') }}"></script>
        <script src="{{URL::asset('global/vendor/datatables.net-responsive/dataTables.responsive.js') }}"></script>
        <script src="{{URL::asset('global/vendor/datatables.net-responsive-bs4/responsive.bootstrap4.js') }}"></script>
        <script src="{{URL::asset('global/vendor/datatables.net-buttons/dataTables.buttons.js') }}"></script>
        <script src="{{URL::asset('global/vendor/datatables.net-buttons/buttons.html5.js') }}"></script>
        <script src="{{URL::asset('global/vendor/datatables.net-buttons/buttons.flash.js') }}"></script>
        <script src="{{URL::asset('global/vendor/datatables.net-buttons/buttons.print.js') }}"></script>
        <script src="{{URL::asset('global/vendor/datatables.net-buttons/buttons.colVis.js') }}"></script>
        <script src="{{URL::asset('global/vendor/datatables.net-buttons-bs4/buttons.bootstrap4.js') }}"></script>

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
        <script src="{{URL::asset('/global/vendor/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
        <script src="{{URL::asset('/global/js/Plugin/bootstrap-datepicker.js') }}"></script>
        <script src="{{URL::asset('/global/js/Plugin/jquery-labelauty.js') }}"></script>
        <script src="{{URL::asset('/global/vendor/jquery-labelauty/jquery-labelauty.js') }}"></script>
        <script src="{{URL::asset('/assets/examples/js/advanced/scrollable.js') }}"></script>
        <script src="{{URL::asset('global/js/Plugin/datatables.js') }}"></script>
        <script src="{{URL::asset('assets/examples/js/tables/datatable.js') }}"></script>

        <script src="{{URL::asset('global/vendor/asrange/jquery-asRange.min.js') }}"></script>
        <script src="{{URL::asset('global/vendor/bootbox/bootbox.js') }}"></script>
 @endsection
