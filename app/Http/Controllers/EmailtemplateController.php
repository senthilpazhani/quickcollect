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
use Datatables;
use Auth;

class EmailtemplateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list(){
        $page_title = "Email Template";
        return view('emailtemplate.list', ['page_title' => 'Email Template']);
    }

    public function getdata(){
        $emailtemplates = Emailtemplate::select('id', 'name','template')->where('status', '=', 'A');
        return DataTables::of($emailtemplates)->addColumn('action',function($emailtemplate){
                    return '<a href="#" class="btn btn-xs btn-primary edit" data_id="'.$emailtemplate->id.'" id="edit_'.$emailtemplate->id.'"
                    data-trigger="hover" data-toggle="tooltip" data-placement="top" data-original-title="edit" data-container="body">
                    <i class="icon md-edit" aria-hidden="true"></i></a>
                    <a href="#" class="btn btn-xs btn-primary delete" data_id="'.$emailtemplate->id.'" id="delete_'.$emailtemplate->id.'"
                    data-plugin="alertify" data-type="confirm" ata-confirm-title="Are you sure to delete template "'.$emailtemplate->name.'?"
                    data-placement="top" data-toggle="tooltip" data-original-title="Delete">
                    <i class="icon md-delete" aria-hidden="true"></i></a>';
                    })->make(true);
    }

    public function postdata(Request $request){
        $id = $request->get('emailtemplate_id');
        $uid = isset($id) ? ',name,'.$id : '';
        $validation = Validator::make($request->all(), [
            'name' => 'bail|required|max:100|unique:emailtemplates'.$uid,
            'template' => 'required',
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
                $emailtemplate = new Emailtemplate([
                    'name' => $request->get('name'),
                    'template' => $request->get('template'),
                ]);
                $emailtemplate->save();
                $success_output = '<div class="alert alert-success">Email Template has been Inserted</div>';
            }
            if($request->get('button_action')=='update'){
                $emailtemplate = Emailtemplate::find($request->get('emailtemplate_id'));
                $emailtemplate->name = $request->get('name');
                $emailtemplate->template = $request->get('template');
                $emailtemplate->save();
                $success_output = '<div class="alert alert-success">Email Template  has been Updated</div>';
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
        $emailtemplate = Emailtemplate::find($id);
        $output = array(
            'name'=>$emailtemplate->name,
            'template'=>$emailtemplate->template,
        );
        echo json_encode($output);
    }

    public function deletedata(Request $request){
        $id = $request->input('id');
        $emailtemplate = Emailtemplate::find($id);
        $emailtemplate->status = 'D';
        $emailtemplate->save();
        $output = '<div class="alert alert-success">Email Template has been Deleted</div>';
        echo json_encode($output);
    }

    public function removedata(Request $request){
        $id = $request->input('id');
        $emailtemplate = Emailtemplate::find($id);
        if($emailtemplate->delete()){
            $output = '<div class="alert alert-success">Email Template has been Removed</div>';
            echo json_encode($output);
        }
    }

    public function smtp(){
        $page_title = "SMTP Settings";
        $smtp = Smtp::where('status','=', 'A')->first();
        return view('emailtemplate.smtp', ['page_title' => $page_title])->with('smtp',$smtp);
    }

    public function postsmtp(Request $request){
        $validation = Validator::make($request->all(), [
            'host' => 'bail|required|max:100',
            'port' => 'required|max:10',
            'username' => 'required|max:100',
            'password' => 'required|max:100',
            'encryption' => 'required|max:10',
        ]);


        $error_array = array();
        $error_array[0] = '0';
        $success_output = "";
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages)
            {
                $error_array[] = $messages;
            }
        }else{
            $smtp = Smtp::where('status','=', 'A')->first();
            $smtp->port = $request->get('port');
            $smtp->host = $request->get('host');
            $smtp->username = $request->get('username');
            $smtp->password = $request->get('password');
            $smtp->encryption = $request->get('encryption');
            $smtp->save();
            $success_output = 'SMTP Setting  has been Updated';
        }
        $smtp = Smtp::where('status','=', 'A')->first();
        $page_title = "SMTP Settings";
        $output = array(
            'error'=>$error_array,
            'success'=>$success_output,
        );
        //return view('emailtemplate.smtp', ['page_title' => 'SMTP Settings','output'=>json_encode($output)])->with('smtp',$smtp);
        return view('emailtemplate.smtp', ['page_title' => 'SMTP Settings','success_output'=>$success_output])->with('smtp',$smtp)->withErrors($validation);
    }

    public function systemsetting(){
        $page_title = "System Settings";
        $systemsetting = Systemsetting::where('status','=', 'A')->first();
        return view('emailtemplate.systemsetting', ['page_title' => $page_title])->with('systemsetting',$systemsetting);
    }

    public function postsystemsetting(Request $request){
        $validation = Validator::make($request->all(), [
            'dateformat' => 'bail|required|max:100',
            'country' => 'required|max:100',
            'currencysymbol' => 'required|max:100',
            'currencysymbolplacement' => 'required|max:100',
            'decimalplace' => 'required|max:100',
            //'listitems' => 'required|max:100',
            'companytitle' => 'required|max:100',
            'companylogo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bcc' => 'required|max:100',
        ]);


        $error_array = array();
        $error_array[0] = '0';
        $success_output = "";
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages)
            {
                $error_array[] = $messages;
            }
        }else{
            $systemsetting = Systemsetting::where('status','=', 'A')->first();
            if ($request->hasFile('companylogo'))
            {   $image = $request->file('companylogo');
                $input['imagename'] = time().'_'. $image->getClientOriginalName();//getClientOriginalExtension();
                $destinationPath = public_path('/images/logos');
                $image->move($destinationPath, $input['imagename']);
                $systemsetting->companylogo = $input['imagename'];
            }
            $systemsetting->dateformat = $request->get('dateformat');
            $systemsetting->country = $request->get('country');
            $systemsetting->currencysymbol = $request->get('currencysymbol');
            $systemsetting->currencysymbolplacement = $request->get('currencysymbolplacement');
            $systemsetting->decimalplace = $request->get('decimalplace');
            $systemsetting->listitems = $request->get('listitems');
            $systemsetting->companytitle = $request->get('companytitle');
            $systemsetting->bcc = $request->get('bcc');
            $systemsetting->save();
            $success_output = 'System Setting  has been Updated';
        }
        $systemsetting = Systemsetting::where('status','=', 'A')->first();
        $page_title = "System Settings";
        $output = array(
            'error'=>$error_array,
            'success'=>$success_output,
        );
        return view('emailtemplate.systemsetting', ['page_title' => 'System Settings','success_output'=>$success_output])->with('systemsetting',$systemsetting)->withErrors($validation);
    }
}
