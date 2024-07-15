<?php

namespace App\Http\Controllers;

use App\Mail\ContactUsMail;
use App\Models\BlogCategoryModel;
use App\Models\BlogModel;
use App\Models\CategoryModel;
use App\Models\ContactUsModel;
use App\Models\PageModel;
use App\Models\PartnerModel;
use App\Models\ProductModel;
use App\Models\ProductSizeModel;
use App\Models\SliderModel;
use App\Models\SystemSettingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function home(){

        $data['meta_title']='E-commerce';
        $data['meta_description']='';
        $data['keywords']='';
        $data['getSlider']=SliderModel::getRecordActive();
        $data['getPartnerLogo']=PartnerModel::getRecordActive();
        $data['getCategory']=CategoryModel::getRecordActiveHome();
        $data['getProduct']=ProductModel::getRecentArrival();
        $data['getProductTrendy']=ProductModel::productTrendy();
        $data['getBlog']=BlogModel::getRecordByHome();
        return view('home',$data);
    }
    public function SeenQuantityProduct(Request $request)
    {
        
        $size_id = $request->data[0]['size_id'];
        if(!empty($size_id)){
            $getSize=ProductSizeModel::getSingle($size_id);
            $amount=$getSize->quantity;
            $response = [
                'success' => true,
                'amount'=>$amount
            ];
        
        }else{
            $response = [
                'success' => false,
                'amount'=>0
            ];
        }
       
        return response()->json($response);
    }
    public function recent_arrival_category_product(Request $request)
    {
        $getProduct=ProductModel::getRecentArrival();
        $getCategory=CategoryModel::getSingle($request->category_id);
        return response()->json([
            'status'=>true,
            'success'=>view("product._list_recent_arrival",[
                'getProduct'=>$getProduct,
                'getCategory'=>$getCategory
            ])->render(),
            ],200);
    }
       public function Contact()
    {
        $getPage=PageModel::getSlug('contact');
        $data['getSystemSettingApp']=SystemSettingModel::getSingle();
        $data['getPage']=$getPage;
        $data['meta_title']=$getPage->meta_title;
        $data['meta_description']=$getPage->meta_description;
        $data['keywords']=$getPage->meta_keywords;
        $first_number=mt_rand(0,9);
        $second_number=mt_rand(0,9);
        $data['first_number']=$first_number;
        $data['second_number']=$second_number;
        Session::put('total_sum',$first_number+$second_number);
        return view('page.contact',$data);
    }
    public function SubmitContact(Request $request)
    {
       if(!empty($request->verification) && !empty(Session::get('total_sum')))
        {
            if(Session::get('total_sum')==$request->verification)
            {
                $save=new ContactUsModel;
                if(!empty(Auth::check()))
                {
                    $save->user_id=Auth::user()->id;
                }
                $save->name=trim($request->name);
                $save->phone=trim($request->phone);
                $save->email=trim($request->email);
                $save->subject=trim($request->subject);
                $save->message=trim($request->message);
                $save->save();
                $getSystemSetting=SystemSettingModel::getSingle();
                Mail::to($getSystemSetting->submit_email)->send(new ContactUsMail($save));
                return redirect()->back()->with('success','Submit information successfully');
            }else{
                return redirect()->back()->with('error','Verification sum is strong!');
            }
        }else{
            return redirect()->back()->with('error','Please verification sum');
        }
    }
    public function About()
    {
        $getPage=PageModel::getSlug('about-us');
        $data['getPage']=$getPage;
        $data['meta_title']=$getPage->meta_title;
        $data['meta_description']=$getPage->meta_description;
        $data['keywords']=$getPage->meta_keywords;
        return view('page.about',$data);
    }
    public function Faq()
    {
        $getPage=PageModel::getSlug('faq');
        $data['getPage']=$getPage;
        $data['meta_title']=$getPage->meta_title;
        $data['meta_description']=$getPage->meta_description;
        $data['keywords']=$getPage->meta_keywords;
        return view('page.faq',$data);
    }
    public function PaymentMethods()
    {
        $getPage=PageModel::getSlug('payment-methods');
        $data['getPage']=$getPage;
        $data['meta_title']=$getPage->meta_title;
        $data['meta_description']=$getPage->meta_description;
        $data['keywords']=$getPage->meta_keywords;
        return view('page.payment_methods',$data);
    }
    public function MoneyBackGurantee(){
        $getPage=PageModel::getSlug('money-back-guarantee');
        $data['getPage']=$getPage;
        $data['meta_title']=$getPage->meta_title;
        $data['meta_description']=$getPage->meta_description;
        $data['keywords']=$getPage->meta_keywords;
        return view('page.money_back_guarantee',$data);
    }
    public function Returns()
    {
        $getPage=PageModel::getSlug('returns');
        $data['getPage']=$getPage;
        $data['meta_title']=$getPage->meta_title;
        $data['meta_description']=$getPage->meta_description;
        $data['keywords']=$getPage->meta_keywords;
        return view('page.returns',$data);
    }
    public function Shipping()
    {
        $getPage=PageModel::getSlug('shipping');
        $data['getPage']=$getPage;
        $data['meta_title']=$getPage->meta_title;
        $data['meta_description']=$getPage->meta_description;
        $data['keywords']=$getPage->meta_keywords;
        return view('page.shipping',$data);
    }
    public function TermConditions()
    {
        $getPage=PageModel::getSlug('terms-and-conditions');
        $data['getPage']=$getPage;
        $data['meta_title']=$getPage->meta_title;
        $data['meta_description']=$getPage->meta_description;
        $data['keywords']=$getPage->meta_keywords;
        return view('page.term_conditions',$data);
    }
    public function PrivacyPolicy()
    {
        $getPage=PageModel::getSlug('privacy-policy');
        $data['getPage']=$getPage;
        $data['meta_title']=$getPage->meta_title;
        $data['meta_description']=$getPage->meta_description;
        $data['keywords']=$getPage->meta_keywords;
        return view('page.privacy_policy',$data);
    }
    public function Blog($blog_category='')
    {
        if($blog_category!='')
        {
            $getBlog=BlogModel::getBlogByCategory($blog_category);
            $data['getBlog']=$getBlog;
            $data['getPage']=BlogCategoryModel::getSingleSlug($blog_category);


        }else{
            $getPage=PageModel::getSlug('blog');
            $data['getPage']=$getPage;
            $data['meta_title']=$getPage->meta_title;
            $data['meta_description']=$getPage->meta_description;
            $data['keywords']=$getPage->meta_keywords;
            $data['getBlog']=BlogModel::getBlog();
        }
        $data['getPopular']=BlogModel::getPopular();
        $data['getBlogCategory']=BlogCategoryModel::getRecordActive();
        return view('blog.list',$data);
    }
    public function BlogDetail($slug)
    {
        $getBlog=BlogModel::getSlug($slug);
        if(!empty($getBlog)){
            $title_view=$getBlog->title_view;
            $getBlog->title_view=$title_view+1;
            $getBlog->save();
            $data['getPage']=$getBlog;
            $data['meta_title']=$getBlog->meta_title;
            $data['meta_description']=$getBlog->meta_description;
            $data['keywords']=$getBlog->meta_keywords;
            $data['getBlog']=$getBlog;
            $data['getBlogCategory']= $data['getBlogCategory']=BlogCategoryModel::getRecordActive();
            $data['getPopular']=BlogModel::getPopular();
            $data['getRalatedPost']=BlogModel::getRelatedPost($getBlog->blog_category_id,$getBlog->id);
            return view('blog.detail',$data);
        }else{
            abort(404);
        }
    }
}
