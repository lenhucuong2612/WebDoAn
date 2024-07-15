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
use App\Rules\ValidateCart;
use Illuminate\Support\Facades\Auth;
use App\Models\ShippingChargeModel;
use App\Models\User;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Validator;
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
        
        if (Cart::getContent()->isNotEmpty()) {
            $cartContent = Cart::getContent();
        
            // Duyệt qua từng sản phẩm trong giỏ hàng
            foreach ($cartContent as $item) {
                // Tách id thành các phần tử
                $idParts = explode('-', $item->id);
        
                // Kiểm tra nếu sản phẩm có cùng product_id với request
                if ($idParts[0] == $request->product_id) {
                    // Lấy danh sách size của sản phẩm từ CSDL
                    $listProductSize = ProductSizeModel::getSize($request->product_id);
        
                    foreach ($listProductSize as $size) {
                        // Kiểm tra nếu size_id trong giỏ hàng khớp với size_id trong CSDL
                        if ($item->attributes['size_id'] == $size->id) {
                            // Tính tổng số lượng sản phẩm cùng kích thước trong giỏ hàng
                            $totalQuantityInCart = 0;
        
                            foreach ($cartContent as $innerItem) {
                                $innerIdParts = explode('-', $innerItem->id);
                                if ($innerIdParts[0] == $request->product_id && $innerItem->attributes['size_id'] == $size->id) {
                                    $totalQuantityInCart += $innerItem->quantity;
                                }
                            }
        
                            // Kiểm tra nếu số lượng tổng cộng vượt quá số lượng còn lại trong kho
                            if (($totalQuantityInCart + $request->qty) > $size->quantity) {
                                session()->flash('message', 'The product is not in sufficient quantity');
                                return redirect()->back();
                            }
                        }
                    }
                }
            }
        }
        
        $validator = Validator::make($request->all(), [
            'qty' => ['required', 'numeric', new ValidateCart($request->amount)]
        ]);
        if($validator->passes())
        {
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
       
        session()->flash('message', 'Add products to cart successfully');
        return redirect()->back();
            
        }else{
            // Xử lý lỗi validation
            return back()
            ->withErrors($validator)
            ->withInput();
             
            
        }
    }
    /*
    public function UpdateCart(Request $request){
        foreach($request->cart as $cart){
            $product_id=explode('_',$cart['id'])[0];
            $product=ProductModel::getSingle($product_id);
            if($cart['qty'] > $product->quantity){
                return redirect()->back()->with('error','The number of products placed is greater than the number of other products. Product have '.$product->quantity);
            }
            Cart::update($cart['id'],array(
                'quantity'=>array(
                    'relative'=>false,
                    'value'=>$cart['qty']
                ),
                ));
        }
        return redirect()->back();
    } 
    */
    public function UpdateCart(Request $request) {
        // Lấy giỏ hàng hiện tại
        $cartContent = Cart::getContent();
    
        foreach ($request->cart as $cart) {
            $product_id = explode('-', $cart['id'])[0];
            $size_id = explode('-', $cart['id'])[1];
            $color_id = explode('-', $cart['id'])[2];
    
            $product = ProductModel::getSingle($product_id);
            $size = ProductSizeModel::getSingle($size_id);
    
            // Kiểm tra xem sản phẩm và kích thước có tồn tại hay không
            if (!$product || !$size) {
                return redirect()->back()->with('error', 'Product or size not found.');
            }
    
            // Tính tổng số lượng của sản phẩm cùng kích thước trong giỏ hàng
            $totalQuantityInCart = 0;
            foreach ($cartContent as $item) {
                $idParts = explode('-', $item->id);
                if ($idParts[0] == $product_id && $item->attributes['size_id'] == $size_id) {
                    $totalQuantityInCart += $item->quantity;
                }
            }
    
            // Kiểm tra nếu số lượng tổng cộng vượt quá số lượng còn lại trong kho
            $currentCartItem = $cartContent->get($cart['id']);
            if (!$currentCartItem) {
                return redirect()->back()->with('error', 'Cart item not found.');
            }
    
            if (($totalQuantityInCart - $currentCartItem->quantity + $cart['qty']) > $size->quantity) {
                return redirect()->back()->with('error', 'The number of products placed is greater than the number of other products. Product have ' . $size->quantity);
            }
    
            // Cập nhật số lượng sản phẩm trong giỏ hàng
            Cart::update($cart['id'], array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $cart['qty']
                ),
            ));
        }
    
        return redirect()->back()->with('success', 'Cart updated successfully.');
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
            
            $check=true;
            foreach(Cart::getContent() as $key=>$cart)
            {
                $product_id=explode('_',$cart->id)[0];
                $parts = explode('-', $cart->id);
                if (isset($parts[1])) {
                    $size_id = $parts[1];
                } 
                $product=ProductSizeModel::getSingle($size_id);
                if($cart['quantity']>$product->quantity)
                {
                   $check=false;
                }
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
            if($check==true){
                $json['status']=true;
                $json['message']="Order success";
                $json['redirect']=url('checkout/payment?order_id='.base64_encode($order->id));
            }else{
                $json['status']=false;
                $json['message']="The product exceeds the remaining number of goods. Please update your shopping cart again.";
            }
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
                    foreach(Cart::getContent() as $item)
                    {
                        $itemId=$item->id;
                        $productSizeId = explode('-', $itemId)[1];
                        $productSize=ProductSizeModel::getSingle($productSizeId);
                        if($item->quantity>$productSize->quantity)
                        {
                            return redirect('cart')->with('error','The purchase quantity is greater than the available quantity');
                        }else{
                            $totalProduct=$productSize->quantity-$item->quantity;
                            $productSize->quantity=$totalProduct;
                            $productSize->save();

                            $product=ProductModel::getSingle(explode('-', $itemId)[0]);
                            $remainAmount=$product->quantity-$item->quantity;
                            $product->quantity=$remainAmount;
                            $product->save();
                            
                        }
                        
                    }
                    $getOrder->is_payment=1;
                    $getOrder->save();
                    Mail::to($getOrder->email)->send(new OrderInvoiceMail($getOrder));
                    Cart::clear();
                    return redirect('cart')->with('success',"Order successfully placed");
                }else if($getOrder->payment_method=='vnpay')
                {
                    /*
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
                    */
                    $vnp_TmnCode = "M9DS0GZN"; // Mã website tại VNPAY
                    $vnp_HashSecret = "6R242ON3AU1O5ISPYV8E9JRYHLR4KTYH"; // Chuỗi bí mật
            
                    $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                    $vnp_Returnurl = url('paypal/success-payment');
                    $vnp_TxnRef = $getOrder->id; // Mã đơn hàng
                    $vnp_OrderInfo = "Thanh toan don hang " . $getOrder->id;
                    $vnp_OrderType = "billpayment";
                    $vnp_Amount = $getOrder->total_amount * 23000*100; // Số tiền thanh toán (vnd)
                    $vnp_Locale = 'vn';
                    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            
                    $inputData = array(
                        "vnp_Version" => "2.1.0",
                        "vnp_TmnCode" => $vnp_TmnCode,
                        "vnp_Amount" => $vnp_Amount,
                        "vnp_Command" => "pay",
                        "vnp_CreateDate" => date('YmdHis'),
                        "vnp_CurrCode" => "VND",
                        "vnp_IpAddr" => $vnp_IpAddr,
                        "vnp_Locale" => $vnp_Locale,
                        "vnp_OrderInfo" => $vnp_OrderInfo,
                        "vnp_OrderType" => $vnp_OrderType,
                        "vnp_ReturnUrl" => $vnp_Returnurl,
                        "vnp_TxnRef" => $vnp_TxnRef,
                    );
                    ksort($inputData);
                    $query = "";
                    $i = 0;
                    $hashdata = "";
                    foreach ($inputData as $key => $value) {
                        if ($i == 1) {
                            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                        } else {
                            $hashdata .= urlencode($key) . "=" . urlencode($value);
                            $i = 1;
                        }
                        $query .= urlencode($key) . "=" . urlencode($value) . '&';
                    }
            
                    $vnp_Url = $vnp_Url . "?" . $query;
                    if (isset($vnp_HashSecret)) {
                        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
                        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
                    }
                    $getOrder->save();
                    return redirect($vnp_Url);
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
        if(!empty($request->vnp_TmnCode)&&!empty($request->vnp_SecureHash))
        {
            $getOrder=OrderModel::where('id','=',$request->vnp_TxnRef)->first();
           if($request->vnp_ResponseCode=='00')
           {
            $getOrder->is_payment=1;
            $getOrder->transaction_id=$request->vnp_SecureHash;
            $getOrder->stripe_session_id=$request->vnp_SecureHash;
            $getOrder->payment_data=json_encode($request->all());
            $getOrder->save();
            $listOrder=OrderItemModel::findProductByOrderItem($request->vnp_TxnRef);
            foreach($listOrder as $item)
            {
                $productId=$item->product_id;
                $product=ProductSizeModel::getSize($productId);
                foreach($product as $value)
                {
                    if($value->name==$item->size_name){
                        $totalProduct=$value->quantity-$item->quantity;
                        $value->quantity=$totalProduct;
                        $value->save();
                        $product=ProductModel::getSingle($value->product_id);
                        $remainAmount=$product->quantity-$item->quantity;
                        $product->quantity=$remainAmount;
                        $product->save();
                    }
                }
               
            }
            Mail::to($getOrder->email)->send(new OrderInvoiceMail($getOrder));
            Cart::clear();
            OrderModel::deleteVNpay()->delete();
            return redirect('cart')->with('success',"Order successfully placed"); 
           }else{
            $getOrder->delete();
            return redirect('checkout')->with('error', 'Due to some error please try again');
           }
        }else{
            return redirect('cart')->with('error','Due to some error please again');
        }
    }
    public function StripeSuccessPayment(Request $request)
    {
        $trans_id=Session::get('stripe_session_id');
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $getdata=\Stripe\Checkout\Session::retrieve($trans_id);
        $getOrder=OrderModel::where('stripe_session_id','=',$getdata->id)->first();
        if(!empty($getOrder) && !empty($getdata->id) && $getdata->id==$getOrder->stripe_session_id)
        {
            $listOrder=OrderItemModel::findProductByOrderItem(OrderModel::findProductByStripe($trans_id)->id);
            foreach($listOrder as $item)
            {
                $productId=$item->product_id;
                $product=ProductSizeModel::getSize($productId);
                foreach($product as $value)
                {
                    if($value->name==$item->size_name){
                        $totalProduct=$value->quantity-$item->quantity;
                        $value->quantity=$totalProduct;
                        $value->save();
                        $product=ProductModel::getSingle($value->product_id);
                        $remainAmount=$product->quantity-$item->quantity;
                        $product->quantity=$remainAmount;
                        $product->save();
                    }
                }
            }
            $getOrder->is_payment=1;
            $getOrder->transaction_id=$getdata->id;
            $getOrder->payment_data=json_encode($getdata);
            $getOrder->save();
            Mail::to($getOrder->email)->send(new OrderInvoiceMail($getOrder));
            Cart::clear();
            OrderModel::deleteStripe()->delete();
            return redirect('cart')->with('success',"Order successfully placed"); 
        }else{
            $getOrder->delete();
            return redirect('cart')->with('error','Due to some error please again');
        }
    }

}
