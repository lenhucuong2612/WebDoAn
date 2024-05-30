<?php

namespace App\Http\Controllers;

use App\Models\OrderModel;
use App\Models\ProductReviewModel;
use App\Models\ProductWishlistModel;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function Dashboard(){
        $data['meta_title']='Dashboard';
        $data['meta_description']='';
        $data['keywords']='';
        $data['TotalOrder']=OrderModel::getTotalOrderUser(Auth::user()->id);
        $data['TotalTodayOrder']=OrderModel::getTotalTodayOrderUser(Auth::user()->id);
        $data['TotalAmount']=OrderModel::getTotalAmountUser(Auth::user()->id);
        $data['TotalTodayAmount']=OrderModel::getTotalTodayAmountUser(Auth::user()->id);

        $data['TotalPendding']=OrderModel::getTotalStatusUser(Auth::user()->id,0);
        $data['TotalInprogress']=OrderModel::getTotalStatusUser(Auth::user()->id,1);
        $data['TotalCompleted']=OrderModel::getTotalStatusUser(Auth::user()->id,3);
        $data['TotalCanccelled']=OrderModel::getTotalStatusUser(Auth::user()->id,4);
        return view('user.dashboard',$data);
    }
    public function Orders(){
        $data['getRecord']=OrderModel::getRecordUser(Auth::user()->id);
        $data['meta_title']='Orders';
        $data['meta_description']='';
        $data['keywords']='';
        return view('user.orders',$data);
    }
    public function OrderDetail($id){
        $data['getRecord']=OrderModel::getSingleUser(Auth::user()->id,$id);
       if(!empty($data['getRecord']))
       {
        $data['meta_title']='Order Detail';
        $data['meta_description']='';
        $data['keywords']='';
        return view('user.order_detail',$data);
       }else{
        abort(404);
       }
    }
    public function EditProfile(){
        $data['meta_title']='Edit Profile';
        $data['meta_description']='';
        $data['keywords']='';
        $data['getRecord']=User::getSingle(Auth::user()->id);
        return view('user.edit-profile',$data);
    }
    public function ChangePassword()
    {
        $data['meta_title']='Change Password';
        $data['meta_description']='';
        $data['keywords']='';
        return view('user.change-password',$data);
    }

    public function UpdateProfile(Request $request)
    {
        $user=User::getSingle(Auth::user()->id);
        $first_name=trim($request->first_name);
        $last_name=trim($request->last_name);
        $name=$first_name.' '.$last_name;
        $user->company_name=trim($request->company_name);
        $user->country=trim($request->country);
        $user->address_one=trim($request->address_one);
        $user->address_two=trim($request->address_two);
        $user->city=trim($request->city);
        $user->state=trim($request->state);
        $user->postcode=trim($request->postcode);
        $user->phone=trim($request->phone);
        $user->save();
        return redirect()->back()->with('success','Profile succesfully created');
    }
    public function UpdatePassword(Request $request)
    {
        $user=User::getSingle(Auth::user()->id);
        $validator=Validator::make($request->all(),[
            'old_password'=>'required',
            'password'=>'required|min:5',
            'confirm_password'=>'required'
        ]);
        if($validator->passes()){
            if(Hash::check($request->old_password,$user->password))
        {
            if($request->password==$request->confirm_password)
            {
                $user->password=$request->password;
                $user->save();
                return redirect()->back()->with('success','Passwor updated successfully');
            }else{
                return redirect()->back()->with('error','Old password and confirm password does not match');
            }
        }else{
            return redirect()->back()->with('error','Old password is not correct');
        }
        }else{
            return back()->withErrors($validator)->withInput();
        }
    }
    public function AddToWishlist(Request $request){
        $check=ProductWishlistModel::checkAlready($request->product_id,Auth::user()->id);
        if(empty($check))
        {
            $save=new ProductWishlistModel();
            $save->product_id=$request->product_id;
            $save->user_id=Auth::user()->id;
            $save->save();
            $json['is_wishlist']=1;
        }
        else{
            ProductWishlistModel::DeleteRecord($request->product_id,Auth::user()->id);
            $json['is_wishlist']=0;
        }

        $json['status']=true;
        echo json_encode($json);
    }
    public function submit_review(Request $request)
    {
        $save=new ProductReviewModel;
        $save->product_id=$request->product_id;
        $save->raiting=$request->raiting;
        $save->order_id=$request->order_id;
        $save->user_id=Auth::user()->id;
        $save->review=trim($request->review);
        $save->save();
        return redirect()->back()->with('success','Thank you for your review');
    }
}
