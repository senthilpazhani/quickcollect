<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\tag;
use Datatables;
use Auth;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list(){
        $page_title = "Tag";
        return view('tag.list', ['page_title' => 'Tag']);
    }

    public function getdata(){
        $tags = Tag::select('id', 'tag')->where('status', '=', 'A');
        return DataTables::of($tags)->addColumn('action',function($tag){
                    return '<a href="#" class="btn btn-xs btn-primary edit" data_id="'.$tag->id.'" id="edit_'.$tag->id.'"
                    data-trigger="hover" data-toggle="tooltip" data-placement="top" data-original-title="edit" data-container="body">
                    <i class="icon md-edit" aria-hidden="true"></i></a>
                    <a href="#" class="btn btn-xs btn-primary delete" data_id="'.$tag->id.'" id="delete_'.$tag->id.'"
                    data-plugin="alertify" data-type="confirm" ata-confirm-title="Are you sure to delete template "'.$tag->name.'?"
                    data-placement="top" data-toggle="tooltip" data-original-title="Delete">
                    <i class="icon md-delete" aria-hidden="true"></i></a>';
                    })->make(true);
    }

    public function postdata(Request $request){
        $id = $request->get('tag_id');
        $uid = isset($id) ? ",'".$id . "',id" : "";
        $validation = Validator::make($request->all(), [
            'tag' => "bail|required|max:100|unique:tags,tag".$uid,
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
                $tag = new Tag([
                    'tag' => $request->get('tag'),
                ]);
                $tag->save();
                $success_output = '<div class="alert alert-success">Tag has been Inserted</div>';
            }
            if($request->get('button_action')=='update'){
                $tag = Tag::find($request->get('tag_id'));
                $tag->tag = $request->get('tag');
                $tag->save();
                $success_output = '<div class="alert alert-success">Tag  has been Updated</div>';
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
        $tag = Tag::find($id);
        $output = array(
            'tag'=>$tag->tag,
        );
        echo json_encode($output);
    }

    public function deletedata(Request $request){
        $id = $request->input('id');
        $tag = Tag::find($id);
        $tag->status = 'D';
        $tag->save();
        $output = '<div class="alert alert-success">Tag has been Deleted</div>';
        echo json_encode($output);
    }

    public function removedata(Request $request){
        $id = $request->input('id');
        $tag = Tag::find($id);
        if($tag->delete()){
            $output = '<div class="alert alert-success">Tag has been Removed</div>';
            echo json_encode($output);
        }
    }
}
