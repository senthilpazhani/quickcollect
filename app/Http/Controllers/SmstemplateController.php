<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\emailtemplate;
use App\smtp;
use App\systemsetting;
use App\smstemplate;
use Datatables;
use Auth;

class SmstemplateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list(){
        $page_title = "SMS Template";
        return view('smstemplate.list', ['page_title' => 'SMS Template']);
    }

    public function getdata(){
        $smstemplates = Smstemplate::select('id', 'name','template')->where('status', '=', 'A');
        return DataTables::of($smstemplates)->addColumn('action',function($smstemplate){
                    return '<a href="#" class="btn btn-xs btn-primary edit" data_id="'.$smstemplate->id.'" id="edit_'.$smstemplate->id.'"
                    data-trigger="hover" data-toggle="tooltip" data-placement="top" data-original-title="edit" data-container="body">
                    <i class="icon md-edit" aria-hidden="true"></i></a>
                    <a href="#" class="btn btn-xs btn-primary delete" data_id="'.$smstemplate->id.'" id="delete_'.$smstemplate->id.'"
                    data-plugin="alertify" data-type="confirm" ata-confirm-title="Are you sure to delete template "'.$smstemplate->name.'?"
                    data-placement="top" data-toggle="tooltip" data-original-title="Delete">
                    <i class="icon md-delete" aria-hidden="true"></i></a>';
                    })->make(true);
    }

    public function postdata(Request $request){
        $id = $request->get('smstemplate_id');
        $uid = isset($id) ? ',name,'.$id : '';
        $validation = Validator::make($request->all(), [
            'name' => 'bail|required|max:100|unique:smstemplates'.$uid,
            'template' => 'required|max:120',
        ]);


        $error_array = array();
        $success_output = "";
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages)
            {
                $error_array[] = $messages;
            }
        }else{
            if($request->get('button_action') == 'insert'){
                $smstemplate = new Smstemplate([
                    'name' => $request->get('name'),
                    'template' => $request->get('template'),
                ]);
                $smstemplate->save();
                $success_output = '<div class="alert alert-success">SMS Template has been Inserted</div>';
            }
            if($request->get('button_action')=='update'){
                $smstemplate = Smstemplate::find($request->get('smstemplate_id'));
                $smstemplate->name = $request->get('name');
                $smstemplate->template = $request->get('template');
                $smstemplate->save();
                $success_output = '<div class="alert alert-success">SMS Template  has been Updated</div>';
            }
        }
        $output = array(
            'error'=>$error_array,
            'success'=>$success_output,
        );
        echo json_encode($output);
    }



    public function fetchdata(Request $request){
        $id = $request->input('id');
        $smstemplate = Smstemplate::find($id);
        $output = array(
            'name'=>$smstemplate->name,
            'template'=>$smstemplate->template,
        );
        echo json_encode($output);
    }

    public function deletedata(Request $request){
        $id = $request->input('id');
        $smstemplate = Smstemplate::find($id);
        $smstemplate->status = 'D';
        $smstemplate->save();
        $output = '<div class="alert alert-success">SMS Template has been Deleted</div>';
        echo json_encode($output);
    }

    public function removedata(Request $request){
        $id = $request->input('id');
        $smstemplate = Smstemplate::find($id);
        if($smstemplate->delete()){
            $output = '<div class="alert alert-success">SMS Template has been Removed</div>';
            echo json_encode($output);
        }
    }


}
