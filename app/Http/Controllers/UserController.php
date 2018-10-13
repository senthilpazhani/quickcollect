<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\user;
use Datatables;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list(){
        $page_title = "User";
       // $users = User::where('status', '=', 'A')->paginate(2);
        return view('user.list', ['page_title' => 'User']);
    }

    public function getdata(){
        $users = User::select('id', 'name','email','mobile','password')->where('status', '=', 'A');
        return DataTables::of($users)->addColumn('action',function($user){
                    return '<a href="#" class="btn btn-xs btn-primary edit" data_id="'.$user->id.'" id="edit_'.$user->id.'"
                    data-trigger="hover" data-toggle="tooltip" data-placement="top" data-original-title="edit" data-container="body">
                    <i class="icon md-edit" aria-hidden="true"></i></a>
                    <a href="#" class="btn btn-xs btn-primary delete" data_id="'.$user->id.'" id="delete_'.$user->id.'"
                    data-plugin="alertify" data-type="confirm" ata-confirm-title="Are you sure to delete user "'.$user->name.'?"
                    data-placement="top" data-toggle="tooltip" data-original-title="Delete"
                    ata-success-message="You have clicked OK" ata-error-message="You have clicked Cancel">
                    <i class="icon md-delete" aria-hidden="true"></i></a>';
                    })->make(true);
    }

    public function postdata(Request $request){
        $id = $request->get('user_id');
        $uid = isset($id) ? ',email,'.$id : '';
        $validation = Validator::make($request->all(), [
            'name' => 'bail|required|max:50',
            'email' => 'bail|required|email|max:100|unique:users'.$uid,
            'mobile' => 'bail|required|numeric|digits_between:10,15',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6'
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
                $user = new User([
                    'name' => $request->get('name'),
                    'email' => $request->get('email'),
                    'mobile' => $request->get('mobile'),
                    'password' => Hash::make($request->get('password')),
                ]);
                $user->save();
                $success_output = '<div class="alert alert-success">User has been Inserted</div>';
            }
            if($request->get('button_action')=='update'){
                $user = User::find($request->get('user_id'));
                $user->name = $request->get('name');
                $user->email = $request->get('email');
                $user->mobile = $request->get('mobile');
                $user->save();
                $success_output = '<div class="alert alert-success">User has been Updated</div>';
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
        $user = User::find($id);
        $output = array(
            'name'=>$user->name,
            'email'=>$user->email,
            'mobile'=>$user->mobile
        );
        echo json_encode($output);
    }

    public function deletedata(Request $request){
        $id = $request->input('id');
        $user = User::find($id);
        $user->status = 'D';
        $user->save();
        $output = '<div class="alert alert-success">User has been Deleted</div>';
        echo json_encode($output);
    }

    public function removedata(Request $request){
        $id = $request->input('id');
        $user = User::find($id);
        if($user->delete()){
            $output = '<div class="alert alert-success">User has been Removed</div>';
            echo json_encode($output);
        }
    }
}
