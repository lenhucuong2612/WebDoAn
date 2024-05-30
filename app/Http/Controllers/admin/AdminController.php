<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //section admin
    public function ListAdmin(){
        $data['header_title']="List Admin";
        $data['getRecord']=User::getAdmin();
        return view("admin.admin.list",$data);
    }
    public function AddAdmin(){
        $data['header_title']="Add Admin";
        return view("admin.admin.add",$data);
    }
    public function InsertAdmin(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required|min:5',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:5'
        ]);
        if($validator->passes()){
            $user=new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=Hash::make($request->passwrod);
            $user->status=$request->status;
            $user->is_admin=1;
            $user->save();

            return redirect(route("admin.admin.list"))->with("success","Added admin successfully");
        }else{
            return back()
            ->withErrors($validator)
            ->withInput();
        }
        
    }
    public function EditAdmin($id){
        $data['header_title']="Edit Admin";
        $data['user']=User::getSingle($id);
        if($data['user']==null || $data['user']->is_delete=1){
            abort(404);
        }
        return view("admin.admin.edit",$data);
    }
    public function UpdateAdmin($id,Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required|min:5',
            'email'=>'required|email|unique:users,email,'.$id
        ]);
        if($validator->passes()){
            $user=User::getSingle($id);
            $user->name=$request->name;
            $user->email=$request->email;
            if(!empty($request->password)){
            $user->password=Hash::make($request->passwrod);
            }
            $user->status=$request->status;
            $user->is_admin=1;
            $user->save();
    
            return redirect(route("admin.admin.list"))->with("success","Updated admin successfully");
        }else{
            return back()
            ->withErrors($validator)
            ->withInput();
        }
       
    }
    public function RemoveAdmin($id){
        $user=User::getSingle($id);
        $user->is_delete=1;
        $user->save();
        return redirect()->back()->with("success","Deleted record successfully");
    }

    public function ListCustomer()
    {
        $data['header_title']="Customer";
        $data['getRecord']=User::getCustomer();
        return view('admin.customer.list',$data);
    }
}
