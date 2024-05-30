<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountCodeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DiscountCodeController extends Controller
{
    public function List(){
        $data['header_title']="List Discount Code";
        $data['getRecord']=DiscountCodeModel::getRecord();
        return view("admin.discountcode.list",$data);
    }
    public function Add(){
        $data['header_title']="Add Discount Code";
        return view("admin.discountcode.add",$data);
    }
    public function Insert(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required|unique:discount_code,name'
        ]);
       if($validator->passes()){
        $discount_code=new DiscountCodeModel();
        $discount_code->name=trim(strtoupper($request->name));
        $discount_code->type=trim($request->type);
        $discount_code->percent_amount=trim($request->precent_amount);
        $discount_code->expire_date=trim($request->expire_date);
        $discount_code->status=trim($request->status);
        $discount_code->save();
        session()->flash("success","Discount code successfully created");
        return redirect(route("admin.discount_code.list"));
       }else{
            return back()
            ->withErrors($validator)
            ->withInput();
        }
    }
    public function Edit($id){
        $data['getRecord']=DiscountCodeModel::getSingle($id);
        $data['header_title']="Edit Discount Code";
        return view("admin.discountcode.edit",$data);
    }
    public function Update($id,Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required|unique:discount_code,name,'.$id
        ]);
       if($validator->passes()){
        $discount_code=DiscountCodeModel::getSingle($id);
        $discount_code->name=trim(strtoupper($request->name));
        $discount_code->type=trim($request->type);
        $discount_code->percent_amount=trim($request->precent_amount);
        $discount_code->expire_date=trim($request->expire_date);
        $discount_code->status=trim($request->status);
        $discount_code->save();
        session()->flash("success","Disocount code successfully updated");
        return redirect(route("admin.discount_code.list"));
       }else{
            return back()
            ->withErrors($validator)
            ->withInput();
        }
    }
    public function Remove($id){
        $discount_code=DiscountCodeModel::getSingle($id);
        $discount_code->is_delete=1;
        $discount_code->save();
        session()->flash("success","Color successfully deleted");
        return redirect()->back();
    }
}
