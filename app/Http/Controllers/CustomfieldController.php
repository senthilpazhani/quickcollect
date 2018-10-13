<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\customfield;
use Datatables;
use Auth;

class CustomfieldController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list(){
        $page_title = "Custom Field";
        return view('customfield.list', ['page_title' => 'Custom Field']);
    }

    public function getdata(){
        $customfields = Customfield::select('id', 'name','datatype','required')->where('status', '=', 'A');
        return DataTables::of($customfields)->addColumn('action',function($customfield){
                    return '<a href="#" class="btn btn-xs btn-primary edit" data_id="'.$customfield->id.'" id="edit_'.$customfield->id.'"
                    data-trigger="hover" data-toggle="tooltip" data-placement="top" data-original-title="edit" data-container="body">
                    <i class="icon md-edit" aria-hidden="true"></i></a>
                    <a href="#" class="btn btn-xs btn-primary delete" data_id="'.$customfield->id.'" id="delete_'.$customfield->id.'"
                    data-plugin="alertify" data-type="confirm" ata-confirm-title="Are you sure to delete Custom fields "'.$customfield->name.'?"
                    data-placement="top" data-toggle="tooltip" data-original-title="Delete">
                    <i class="icon md-delete" aria-hidden="true"></i></a>';
                    })->make(true);
    }

    public function postdata(Request $request){
        $id = $request->get('customfield_id');
        $uid = isset($id) ? ',name,'.$id : '';
        $validation = Validator::make($request->all(), [
            'name' => 'bail|required|max:50|unique:customfields'.$uid,
            'datatype' => 'bail|required',
            'required' => 'required'
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
                $customfield = new Customfield([
                    'name' => $request->get('name'),
                    'datatype' => $request->get('datatype'),
                    'required' => $request->get('required'),
                ]);
                $customfield->save();
                $success_output = '<div class="alert alert-success">Custom field has been Inserted</div>';
            }
            if($request->get('button_action')=='update'){
                $customfield = Customfield::find($request->get('customfield_id'));
                $customfield->name = $request->get('name');
                $customfield->datatype = $request->get('datatype');
                $customfield->required = $request->get('required');
                $customfield->save();
                $success_output = '<div class="alert alert-success">Custom fields has been Updated</div>';
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
        $customfield = Customfield::find($id);
        $output = array(
            'name'=>$customfield->name,
            'datatype'=>$customfield->datatype,
            'required'=>$customfield->required
        );
        echo json_encode($output);
    }

    public function deletedata(Request $request){
        $id = $request->input('id');
        $customfield = Customfield::find($id);
        $customfield->status = 'D';
        $customfield->save();
        $output = '<div class="alert alert-success">Custom fields has been Deleted</div>';
        echo json_encode($output);
    }

    public function removedata(Request $request){
        $id = $request->input('id');
        $customfield = Customfield::find($id);
        if($customfield->delete()){
            $output = '<div class="alert alert-success">Custom fields has been Removed</div>';
            echo json_encode($output);
        }
    }
}
