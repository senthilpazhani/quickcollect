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
                <!-- Example Table Selectable -->
                <div id="alertmessage"></div>
                <table class="table able-bordered w-full table-hover able-striped dataTable no-footer"  id="listitem_table" data-plugin="selectable" data-row-selectable="true">
                    <thead class="bg-grey-100">
                    <tr>
                        <th>#</th>
                        <th>
                        Name
                        </th>
                        <th class="hidden-sm-down">
                        Action
                        </th>
                    </tr>
                    </thead>
                </table>
                <!-- End Example Table Selectable -->
            </div>
        </div>
    </div>
</div>
<div id="emailtemplateModal" class="modal fade modal-fade-in-scale-up w-full" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="emailtemplate_form">
                <div class="modal-header">
                 <!--   <button type="button" class="close" data-dismiss="modal">&times;</button>-->
                    <h4 class="modal-title">Add Data</h4>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <span id="form_output"></span>
                    <div class="form-group" >
                        <label for="name" >Enter Name</label>
                        <input type="text" name="name" id="name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Enter Template</label>
                        <textarea name="template" id="template" class="summernote gray-bg"  data-plugin="summernote" rows="7"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="emailtemplate_id" id="emailtemplate_id" value="" />
                    <input type="hidden" name="button_action" id="button_action" value="insert" />
                    <button type="submit" name="submit" class="btn btn-success" id="action" >Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('pagescript_top')
<style>.form-group{margin-bottom:0.5rem;}</style>
    <link rel="stylesheet" href="{{URL::asset('/global/vendor/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{URL::asset('/global/vendor/datatables.net-fixedheader-bs4/dataTables.fixedheader.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{URL::asset('/global/vendor/datatables.net-fixedcolumns-bs4/dataTables.fixedcolumns.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{URL::asset('/global/vendor/datatables.net-rowgroup-bs4/dataTables.rowgroup.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{URL::asset('/global/vendor/datatables.net-scroller-bs4/dataTables.scroller.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{URL::asset('/global/vendor/datatables.net-select-bs4/dataTables.select.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{URL::asset('/global/vendor/datatables.net-responsive-bs4/dataTables.responsive.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{URL::asset('/global/vendor/datatables.net-buttons-bs4/dataTables.buttons.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{URL::asset('/assets/examples/css/tables/datatable.css') }}">
    <link rel="stylesheet" href="{{URL::asset('/global/vendor/summernote/summernote.css') }}">
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
        $(document).ready(function(){
            var table = $('#listitem_table').DataTable({
                "processing":true,
                "serverSide":true,
                "autoWidth": false,
                "ajax":"{{ route('emailtemplate.getdata') }}",
                "columns":[
                    {"data":"id"},
                    {"data":"name","width": "90%"},
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

            $('#add_data').click(function(){
                $('#emailtemplateModal').modal('show');
                $('#emailtemplate_form')[0].reset();
                $('#form_output').html('');
                $('#button_action').val('insert');
                $('.modal-title').text('Add Template');
                $('#action').html('Add');
            });
            $('#emailtemplate_form').on('submit',function(event){
                event.preventDefault();
                var form_data = $(this).serialize();

                $.ajax({
                    url:"{{ route('emailtemplate.postdata') }}",
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
                            $('#form_output').html(error_html);
                        }else{
                            $('#emailtemplateModal').modal('hide');
                            $('#alertmessage').html(data.success).fadeIn(2500).delay(3000).fadeOut(2500);
                            $('#listitem_table').DataTable().ajax.reload();
                        }
                    },
                    error:function(jqXHR, exception){
                        $('#form_output').html(jqXHR.responseText);
                    }

                });
            });

            $(document).on('click','.edit',function(){
                var id=$(this).attr("data_id");

                $.ajax({
                    url:"{{ route('emailtemplate.fetchdata') }}",
                    method:"get",
                    data:{id:id},
                    dataType:'json',
                    success:function(data){
                        $('#name').val(data.name);
                        $('#template').val(data.template);
                        $('#emailtemplate_id').val(id);
                        $('#emailtemplateModal').modal('show');
                        $('#form_output').html('');
                        $('#action').html('Edit');
                        $('.modal-title').text('Edit Template');
                        $('#button_action').val('update');
                    }
                });
            });

            $(document).on('click','.delete',function(){
                if(confirm("Are you sure to delete this Template?"))
                {
                    var id=$(this).attr("data_id");
                    $.ajax({
                        url:"{{ route('emailtemplate.deletedata') }}",
                        method:"get",
                        data:{id:id},
                        dataType:'json',
                        success:function(data){
                            $('#alertmessage').html(data).fadeIn(2500).delay(3000).fadeOut(2500);
                            $('#listitem_table').DataTable().ajax.reload();
                        }
                    });
                }else{return false;}
            });
        });
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
        <script src="{{URL::asset('global/vendor/asrange/jquery-asRange.min.js') }}"></script>
        <script src="{{URL::asset('global/vendor/bootbox/bootbox.js') }}"></script>

        <script src="{{URL::asset('assets/js/Site.js') }}"></script>
        <script src="{{URL::asset('global/js/Plugin/asscrollable.js') }}"></script>
        <script src="{{URL::asset('global/js/Plugin/slidepanel.js') }}"></script>
        <script src="{{URL::asset('global/js/Plugin/switchery.js') }}"></script>
        <script src="{{URL::asset('global/js/Plugin/datatables.js') }}"></script>
        <script src="{{URL::asset('assets/examples/js/tables/datatable.js') }}"></script>
        <script src="{{URL::asset('assets/examples/js/uikit/icon.js') }}"></script>
        <script src="{{URL::asset('/global/js/Plugin/alertify.js') }}"></script>
        <script src="{{URL::asset('/global/js/Plugin/notie-js.js') }}"></script>
        <script src="{{URL::asset('/global/js/Plugin/summernote.js') }}"></script>
        <script src="{{URL::asset('/global/vendor/summernote/summernote.min.js') }}"></script>
        <script src="{{URL::asset('/assets/examples/js/forms/editor-summernote.js') }}"></script>

        <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
 @endsection
