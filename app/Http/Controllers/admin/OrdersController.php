<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\OrderStatusMail;
use App\Models\OrderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{
    public function List()
    {
        $data['getRecord']=OrderModel::getRecord();
        $data['header_title']="Orders";
        return view('admin.order.list',$data);
    }
    public function Detail($id)
    {
        $data['getRecord']=OrderModel::getSingle($id);
        $data['header_title']="Order Detail";
        return view("admin.order.detail",$data);
    }
    public function OrderStatus(Request $request)
    {
        $getOrder=OrderModel::getSingle($request->order_id);
        $getOrder->status=$request->status;
        $getOrder->save();
        Mail::to($getOrder->email)->send(new OrderStatusMail($getOrder));
        $check=true;
        if($request->status==4 && $getOrder->payment_method=="cash"){
            $getOrder->delete();
            $check==true;
        }else if($request->status==4 && $request->payment_method!="cash"){
            $check==false;
        }else 
        {
            $check =true;
        }

        if($check)
        {
            $json['message']="Status successfully updated";
        }else{
            $json['message']="Status no successfully updated";
        }
        echo json_encode($json);
    }
}
