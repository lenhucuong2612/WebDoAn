<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingChargeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShippingChargeController extends Controller
{
    public function List(){
        $data['header_title']="List Shipping Charge";
        $data['getRecord']=ShippingChargeModel::getRecord();
        return view("admin.shippingcharge.list",$data);
    }
    public function Add(){
        $data['header_title']="Add Discount Code";
        return view("admin.shippingcharge.add",$data);
    }
    public function Insert(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required'
        ]);
       if($validator->passes()){
        $shipping_charge=new ShippingChargeModel();
        $shipping_charge->name=trim($request->name);
        $shipping_charge->price=trim($request->price);
        $shipping_charge->status=trim($request->status);
        $shipping_charge->save();
        session()->flash("success","Discount code successfully created");
        return redirect(route("admin.shipping_charge.list"));
       }else{
            return back()
            ->withErrors($validator)
            ->withInput();
        }
    }
    public function Edit($id){
        $data['getRecord']=ShippingChargeModel::getSingle($id);
        $data['header_title']="Edit Shipping Charge";
        return view("admin.shippingcharge.edit",$data);
    }
    public function Update($id,Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required'
        ]);
       if($validator->passes()){
        $shipping_charge=ShippingChargeModel::getSingle($id);
        $shipping_charge->name=trim($request->name);
        $shipping_charge->price=trim($request->price);
        $shipping_charge->status=trim($request->status);
        $shipping_charge->save();
        session()->flash("success","Shipping charge successfully updated");
        return redirect(route("admin.shipping_charge.list"));
       }else{
            return back()
            ->withErrors($validator)
            ->withInput();
        }
    }
    public function Remove($id){
        $shipping_charge=ShippingChargeModel::getSingle($id);
        $shipping_charge->is_delete=1;
        $shipping_charge->save();
        session()->flash("success","Shipping Charge successfully deleted");
        return redirect()->back();
    }
}
