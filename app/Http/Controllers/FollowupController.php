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
use App\customer;
use App\followup;
use App\user;
use App\tag;
use Datatables;
use Auth;

class FollowupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function followup(){
        $page_title = "Followup";
        $customers = Customer::select('id', 'name','mobile','email')->where('status', '=', 'A')->get();
        return view('followup.followup', compact('customers',$customers))->with('page_title','Followup');

    }

    public function getdata(){
        $followups = Followup::select('id', 'name','')->where('status', '=', 'A');
        return DataTables::of($followups)->addColumn('action',function($followup){
                    return '<a href="#" class="btn btn-xs btn-primary edit" data_id="'.$followup->id.'" id="edit_'.$followup->id.'"
                    data-trigger="hover" data-toggle="tooltip" data-placement="top" data-original-title="edit" data-container="body">
                    <i class="icon md-edit" aria-hidden="true"></i></a>
                    <a href="#" class="btn btn-xs btn-primary delete" data_id="'.$followup->id.'" id="delete_'.$followup->id.'"
                    data-plugin="alertify" data-type="confirm" ata-confirm-title="Are you sure to delete  "'.$followup->name.'?"
                    data-placement="top" data-toggle="tooltip" data-original-title="Delete">
                    <i class="icon md-delete" aria-hidden="true"></i></a>';
                    })->make(true);
    }

    public function postdata(Request $request){
        $id = $request->get('followup_id');
        $uid = isset($id) ? ',name,'.$id : '';
        $validation = Validator::make($request->all(), [
            'name' => 'bail|required|max:100|unique:followups'.$uid,
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
                $followup = new Followup([
                    'name' => $request->get('name'),
                ]);
                $followup->save();
                $success_output = '<div class="alert alert-success">Followup has been Inserted</div>';
            }
            if($request->get('button_action')=='update'){
                $followup = Followup::find($request->get('followup_id'));
                $followup->name = $request->get('name');
                $followup->save();
                $success_output = '<div class="alert alert-success">Followup has been Updated</div>';
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
        $followup = Followup::find($id);
        $output = array(
            'name'=>$followup->name,
        );
        echo json_encode($output);
    }

    public function deletedata(Request $request){
        $id = $request->input('id');
        $followup = Followup::find($id);
        $followup->status = 'D';
        $followup->save();
        $output = '<div class="alert alert-success">Followup has been Deleted</div>';
        echo json_encode($output);
    }

    public function removedata(Request $request){
        $id = $request->input('id');
        $followup = Followup::find($id);
        if($followup->delete()){
            $output = '<div class="alert alert-success">Followup has been Removed</div>';
            echo json_encode($output);
        }
    }

    // Customer details
    public function getcustomerlist(){
        $customers = Customer::select('id', 'name','mobile','email')->where('status', '=', 'A')->get();
        return view('followup.followup', compact('customers',$customers))->with('page_title','Followup');
    }

    public function postcustomer(Request $request){
        $id = $request->get('customer_id');
        $uid = isset($id) ? ',email,'.$id : '';
        $validation = Validator::make($request->all(), [
            'name' => 'bail|required|max:100',
            'mobile' => 'bail|required|max:100',
            'email' => 'bail|required|email|max:100|unique:customers'.$uid,
        ]);


        $error_array = array();
        $success_output = "";
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages)
            {
                $error_array[] = $messages;
            }
        }else{
            if($request->get('customer_button_action') == 'insert'){
                $customer = new Customer([
                    'name' => $request->get('name'),
                    'email' => $request->get('email'),
                    'mobile' => $request->get('mobile'),
                ]);
                $customer->save();
                $customers = Customer::select('id', 'name','mobile','email')->where('status', '=', 'A')->get();
                $success_output = json_encode($customers);
                // = '<div class="alert alert-success">Customer has been Inserted</div>';
            }
            if($request->get('customer_button_action')=='update'){
                $customer = Customer::find($request->get('customer_id'));
                $customer->name = $request->get('name');
                $customer->email = $request->get('email');
                $customer->mobile = $request->get('mobile');
                $customer->save();
                $customers = Customer::select('id', 'name','mobile','email')->where('status', '=', 'A')->get();
                //echo json_encode($customers);
                $success_output = json_encode($customers);
                //'<div class="alert alert-success">Customer has been Updated</div>';
            }
        }
        $output = array(
            'error'=>$error_array,
            'success'=>$success_output,
        );
        echo json_encode($output);
    }



    public function fetchcustomer(Request $request){
        $id = $request->input('id');
        $customer = Customer::find($id);
        $output = array(
            'name'=>$customer->name,
            'email'=>$customer->email,
            'mobile'=>$customer->mobile,
        );
        echo json_encode($output);
    }

    public function deletecustomer(Request $request){
        $id = $request->input('id');
        $customer = Customer::find($id);
        $customer->status = 'D';
        $customer->save();
        $output = '<div class="alert alert-success">Customer has been Deleted</div>';
        echo json_encode($output);
    }

    public function removecustomer(Request $request){
        $id = $request->input('id');
        $customer = Customer::find($id);
        if($customer->delete()){
            $output = '<div class="alert alert-success">Customer has been Removed</div>';
            echo json_encode($output);
        }
    }
    // Followup details
    //public function getfollowupitem($cid){
    public function getfollowupitem(Request $request){
        $id = $request->input('id');
       // $followups = Followup::select('id', 'tags')->where([['status', '=', 'A'],['followup_customerid','=',$cid]]);
       $followups = Followup::select('id', 'orderdetail','ordervalue','orderreceived','receivable','tags')->where([['status', '=', 'A'],['followup_customerid','=',$id]]);
       //$followups = Followup::select('id', 'orderdetail','ordervalue','orderreceived','orderreceivable','tags')->where('followup_customerid','=',$cid);
       return DataTables::of($followups)->addColumn('action',function($followup){
                   return '<a href="#" class="btn btn-xs btn-primary edit" data_id="'.$followup->id.'" id="edit_'.$followup->id.'"
                   data-trigger="hover" data-toggle="tooltip" data-placement="top" data-original-title="edit" data-container="body">
                   <i class="icon md-edit" aria-hidden="true"></i></a>
                   <a href="#" class="btn btn-xs btn-primary delete_followup" data_id="'.$followup->id.'" id="delete_'.$followup->id.'"
                   data-plugin="alertify" data-type="confirm" ata-confirm-title="Are you sure to delete template "'.$followup->orderdetail.'?"
                   data-placement="top" data-toggle="tooltip" data-original-title="Delete">
                   <i class="icon md-delete" aria-hidden="true"></i></a>';
                   })->make(true);
    }

    public function postfollowupitem(Request $request){
        $id = $request->get('followup_id');
        $validation = Validator::make($request->all(), [
            'followup_customerid' => 'bail|required|max:100',
            'orderdetail' => 'bail|required|max:100',
            'ordervalue' => 'bail|required|max:100',
            'orderreceived' => 'bail|required|max:100',
            'orderreceivable' => 'bail|required|max:100',
            'tags' => 'max:100',
        ]);


        $error_array = array();
        $success_output = "";
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages)
            {
                $error_array[] = $messages;
            }
        }else{
            if($request->get('followup_button_action') == 'insert'){
                $followup = new Followup([
                    'followup_customerid' => $request->get('followup_customerid'),
                    'orderdetail' => $request->get('orderdetail'),
                    'ordervalue' => $request->get('ordervalue'),
                    'orderreceived' => $request->get('orderreceived'),
                    'orderreceivable' => $request->get('orderreceivable'),
                    'tags' => $request->get('tags'),
                ]);
                $followup->save();
                $followups = Followup::select('id', 'followup_customerid', 'orderdetail','ordervalue','orderreceived','orderreceivable','tags')->where([['status', '=', 'A'],['followup_customerid','=',$request->get('followup_customerid')]])->get();
                $success_output = '<div class="alert alert-success">Followup has been Inserted</div>';
            }
            if($request->get('followup_button_action')=='update'){
                $followup = Followup::find($request->get('followup_id'));
                $followup->followup_customerid = $request->get('followup_customerid');
                $followup->orderdetail = $request->get('orderdetail');
                $followup->ordervalue = $request->get('ordervalue');
                $followup->orderreceived = $request->get('orderreceived');
                $followup->orderreceivable = $request->get('orderreceivable');
                $followup->tags = $request->get('tags');
                $followup->save();
                $followups = Followup::select('id', 'followup_customerid', 'orderdetail','ordervalue','orderreceived','orderreceivable','tags')->where([['status', '=', 'A'],['followup_customerid','=',$request->get('followup_customerid')]])->get();
                //echo json_encode($customers);
                $success_output = '<div class="alert alert-success">Followup has been Updated</div>';
            }
        }
        $output = array(
            'error'=>$error_array,
            'success'=>$success_output,
        );
        echo json_encode($output);
    }



    public function fetchfollowupitem(Request $request){
        $id = $request->input('id');
        $followup = Followup::find($id);
        $output = array(
            'followup_customerid' => $followup->followup_customerid,
            'orderdetail' => $followup->orderdetail,
            'ordervalue' => $followup->ordervalue,
            'orderreceived' => $followup->orderreceived,
            'orderreceivable' => $followup->orderreceivable,
            'tags' => $followup->tags,
        );
        echo json_encode($output);
    }

    public function deletefollowupitem(Request $request){
        $id = $request->input('id');
        $followup = Followup::find($id);
        $followup->status = 'D';
        $followup->save();
        $output = '<div class="alert alert-success">Followup has been Deleted</div>';
        echo json_encode($output);
    }

}
