<?php

namespace App\Http\Controllers;

use App\Mail\OrderInvoiceMail;
use App\Mail\RegisterMail;
use App\Models\ColorModel;
use App\Models\DiscountCodeModel;
use App\Models\OrderItemModel;
use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\ProductSizeModel;
use Illuminate\Support\Facades\Auth;
use App\Models\ShippingChargeModel;
use App\Models\User;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Stripe\Climate\Product;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function ApplyDiscoutCode(Request $request){
        $getDiscount=DiscountCodeModel::CheckDiscount($request->discount_code);
        if(!empty($getDiscount)){
            $total=Cart::getSubTotal();
            if($getDiscount->type=="Amount"){
                $discount_amount=$getDiscount->percent_amount;
                $payable_total=$total-$getDiscount->percent_amount;
            }else{
                $discount_amount=($total * $getDiscount->percent_amount)/100;
                $payable_total=$total-$discount_amount;
            }
            $json['discount_amount']=number_format($discount_amount,2);
            $json['payable_total']=$payable_total;
            $json['status']=true;
            $json['message']="Success Code Invalid";
        }else{
            $json['discount_amount']='0.00';
            $json['payable_total']=Cart::getSubTotal();
            $json['status']=false;
            $json['message']="Discount Code Invalid";
        }
        echo json_encode($json);
    }
    public function Cart(){
        $data['meta_title']='Cart';
        $data['meta_description']='';
        $data['meta_keywords']='';
        return view('payment.cart',$data);
    }
    public function CheckOut(){
        $data['meta_title']='Cart';
        $data['meta_description']='';
        $data['meta_keywords']='';
        $data['getShipping']=ShippingChargeModel::getRecordActive();
        return view('payment.checkout',$data);
    }
    public function AddToCart(Request $request){
        $getproduct = ProductModel::getSingle($request->product_id);
        $total = $getproduct->price;
        $size_id = !empty($request->size_id) ? $request->size_id : 0;
        $getSize = ProductSizeModel::getSingle($size_id);
        $size_price = !empty($getSize->price) ? $getSize->price : 0;
        $total = $total + $size_price;
        $color_id = !empty($request->color_id) ? $request->color_id : 0;
    
        // Tạo một ID duy nhất cho mỗi phiên bản của sản phẩm, kết hợp cả product_id và size_id
        $product_unique_id = $getproduct->id . '-' . $size_id .'-'. $color_id;
        // Thêm sản phẩm vào giỏ hàng với ID duy nhất
        Cart::add([
            'id' => $product_unique_id,
            'name' => 'Product',
            'price' => $total,
            'quantity' => $request->qty,
            'attributes'=> [
                'size_id' => $size_id,
                'color_id' => $color_id
            ]
        ]);
       
        return redirect()->back();
    }
    public function UpdateCart(Request $request){
        foreach($request->cart as $cart){
            Cart::update($cart['id'],array(
                'quantity'=>array(
                    'relative'=>false,
                    'value'=>$cart['qty']
                ),
                ));
        }
        return redirect()->back();
    }
    public function DeleteCart($id){
        Cart::remove($id);
        return redirect()->back();
    }
    public function PlaceOrder(Request $request){
        $validate=0;
        $message='';
        if(!empty(Auth::user()))
        {
            $user_id=Auth::user()->id;
        }
        else{
            if(!empty($request->is_create))
            {
                $checkEmail=User::checkEmail($request->email);
                $name = $request->first_name . ' ' . $request->last_name;
                if(!empty($checkEmail))
                {
                    $message="This email already register please choose another";
                    $validate=1;
                }else{
                    $save=new User;
                    $save->name=trim($name);
                    $save->email=trim($request->email);
                    $save->password=Hash::make($request->password);
                    $save->save();
                    $user_id=$save->id;
                }
            }else{
                $user_id='';
            }
        }
       
        if(empty($validate)){
            $getShipping=ShippingChargeModel::getSingle($request->shipping);
            $discount_amount=0;
            $discount_code='';
            $payable_total=Cart::getSubTotal();
            if(!empty($request->discount_code)){
                $getDiscount=DiscountCodeModel::CheckDiscount($request->discount_code);
                if(!empty($getDiscount))
                {
                    $discount_code=$request->discount_code;
                    if($getDiscount->type=='Amount')
                    {
                        $discount_amount=$getDiscount->percent_amount;
                        $payable_total=$payable_total-$getDiscount->percent_amount;
                    }else{
                        $discount_amount=($payable_total*$getDiscount->percent_amount)/100;
                        $payable_total=$payable_total-$discount_amount;
                    }
                }
            }
            $shipping_amount=!empty($getShipping->price)?$getShipping->price:0;
            $total_amount=$payable_total+$shipping_amount;
            $order=new OrderModel();
            if(!empty($user_id))
            {
                $order->user_id=$user_id;
            }
            $order->order_number=mt_rand(100000000,999999999);
            $order->first_name=trim($request->first_name);
            $order->last_name=trim($request->last_name);
            $order->company_name=trim($request->company_name);
            $order->country=trim($request->country);
            $order->address_one=trim($request->address_one);
            $order->address_two=trim($request->address_two);
            $order->city=trim($request->city);
            $order->state=trim($request->state);
            $order->postcode=trim($request->postcode);
            $order->phone=trim($request->phone);
            $order->email=trim($request->email);
            $order->note=trim($request->note);
            $order->shipping_id=$request->shipping;
            $order->discount_code=trim($discount_code);
            $order->discount_amount=$discount_amount;
            $order->total_amount=$total_amount;
            $order->shipping_amount=$shipping_amount;
            $order->payment_method=trim($request->payment_method);
            $order->save();
    
            foreach(Cart::getContent() as $key=>$cart)
            {
                
                $product_id=explode('_',$cart->id)[0];
                $order_item=new OrderItemModel();
                $order_item->order_id=$order->id;
                $order_item->product_id=$product_id;
                $order_item->quantity=$cart->quantity;
                $order_item->price=$cart->price;
                $color_id=$cart->attributes->color_id;
                $size_id=$cart->attributes->size_id;
                if(!empty($color_id)){
                    $getColor=ColorModel::getSingle($color_id);
                    $order_item->color_name=$getColor->name;
                }
                if(!empty($size_id)){
                    $getSize=ProductSizeModel::getSingle($size_id);
                    $order_item->size_name=$getSize->name;
                    $order_item->size_amount=$getSize->price;
                }
                $order_item->total_price=$cart->price*$cart->quantity;
                $order_item->save();
                
            }
            $json['status']=true;
            $json['message']="Order success";
            $json['redirect']=url('checkout/payment?order_id='.base64_encode($order->id));
        }
        else
        {
            $json['status']=false;
            $json['message']=$message;
        }
        echo json_encode($json);
    }
    public function CheckOutPayment(Request $request)
    {
        if(!empty(Cart::getContent()) && !empty($request->order_id))
        {
            $order_id=base64_decode($request->order_id);
            $getOrder=OrderModel::getSingle($order_id);
            if(!empty($getOrder))
            {
                if($getOrder->payment_method=='cash'){
                    $getOrder->is_payment=1;
                    $getOrder->save();
                    Mail::to($getOrder->email)->send(new OrderInvoiceMail($getOrder));
                    Cart::clear();
                    return redirect('cart')->with('success',"Order successfully placed");
                }else if($getOrder->payment_method=='paypal')
                {
                    $query=array();
                    $query['business']='sb-hhxcw30879002@business.example.com';
                    $query['cmd']='_xclick';
                    $query['item_name']='E-commerce';
                    $query['no_shipping']='1';
                    $query['item_number']=$getOrder->id;
                    $query['amount']=$getOrder->total_amount;
                    $query['currency_code']='USD';
                    $query['cancel_return']=url('checkout');
                    $query['return']=url('paypal/success-payment');

                    $query_string=http_build_query($query);
                    header('Location: https://www.sandbox.paypal.com/cgi-bin/webscr?'. $query_string);
                    exit();
                }else if($getOrder->payment_method=='stripe'){
                    Stripe::setApiKey(env('STRIPE_SECRET'));
                    $finalPrice=$getOrder->total_amount*100;
                    $session=\Stripe\Checkout\Session::create([
                        'customer_email'=>$getOrder->email,
                        'payment_method_types'=>['card'],
                        'line_items'=>[[
                            'price_data'=>[
                                'currency'=>'usd',
                                'product_data'=>[
                                    'name'=>'E-commerce',
                                ],
                                'unit_amount'=>intval($finalPrice),
                            ],
                            'quantity'=>1,
                        ]],
                        'mode'=>'payment',
                        'success_url'=>url('stripe/payment-success'),
                        'cancel_url'=>url('checkout')
                    ]);

                    $getOrder->stripe_session_id=$session['id'];
                    $getOrder->save();
                    $data['session_id']=$session['id'];
                    Session::put('stripe_session_id',$session['id']);
                    $data['setPublicKey']=env('STRIPE_KEY');

                    return view('payment.stripe_charge',$data);
                }
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
    }
    public function PaySuccessPayment(Request $request)
    {
        dd($request->all());
    }
    public function StripeSuccessPayment(Request $request)
    {
        $trans_id=Session::get('stripe_session_id');
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $getdata=\Stripe\Checkout\Session::retrieve($trans_id);
        $getOrder=OrderModel::where('stripe_session_id','=',$getdata->id)->first();
        if(!empty($getOrder) && !empty($getdata->id) && $getdata->id==$getOrder->stripe_session_id)
        {
            $getOrder->is_payment=1;
            $getOrder->transaction_id=$getdata->id;
            $getOrder->payment_data=json_encode($getdata);
            $getOrder->save();
            Mail::to($getOrder->email)->send(new OrderInvoiceMail($getOrder));
            Cart::clear();
            return redirect('cart')->with('success',"Order successfully placed"); 
        }else{
            return redirect('cart')->with('error','Due to some error please again');
        }
    }

}
