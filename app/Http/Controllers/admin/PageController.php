<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUsModel;
use App\Models\PageModel;
use App\Models\SystemSettingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class PageController extends Controller
{
    public function ContactUs()
    {
        $data['header_title']="List Contact Us";
        $data['getRecord']=ContactUsModel::getRecord();
        return view("admin.contact_us.list",$data);
    }
    public function DeleteContactUs($id)
    {
        ContactUsModel::where('id','=',$id)->delete();
        return redirect()->back()->with('success','Record Successfully Deleted');
    }
    public function Add()
    {
        $data['header_title']="Add Page";
        return view('admin.page.add',$data);
    }
    public function List(){
        $data['header_title']="List Page";
        $data['getRecord']=PageModel::getRecord();
        return view("admin.page.list",$data);
    }
    public function Edit($id)
    {
        
        $data['header_title']="Edit Page";
        $data['getRecord']=PageModel::getSingle($id);
        return view('admin.page.edit',$data);
    }
    public function Update($id, Request $request)
    {
        $page=PageModel::getSingle($id);
        $page->name=trim($request->name);
        $page->title=trim($request->title);
        $page->description=trim($request->discription);
        $page->meta_title=trim($request->meta_title);
        $page->meta_description=trim($request->meta_description);
        $page->meta_keywords=trim($request->meta_keywords);
        $page->save();
        if(!empty($request->file('image'))){
            $file=$request->file('image');
            $ext=$file->getClientOriginalExtension();
            $randomStr=$page->id.Str::random(20);
            $filename=strtolower($randomStr).'.'.$ext;
            $file->move(public_path('/upload/page/'),$filename);
            $page->image_name=trim($filename);
            $page->save();
        }
        return redirect(route('admin.page.list'))->with('success','Page successfully updated');
    }
    public function SystemSetting()
    {
        
        $data['getRecord']=SystemSettingModel::getSingle();;
        $data['header_title']="System Setting";
        return view("admin.system.system_setting",$data);
    }
    public function UpdateSetting(Request $request)
    {
        $save=SystemSettingModel::getSingle();
        $save->website_name=trim($request->website_name);
        $save->footer_description=trim($request->footer_description);
        $save->address=trim($request->address);
        $save->phone=trim($request->phone);
        $save->phone_two=trim($request->phone_two);
        $save->submit_email=trim($request->submit_email);
        $save->email=trim($request->email);
        $save->email_two=trim($request->email_two);
        $save->working_hour=trim($request->working_hour);
        $save->facebook_link=trim($request->facebook_link);
        $save->twitter_link=trim($request->twitter_link);
        $save->instagram_link=trim($request->instagram_link);
        $save->youtobe_link=trim($request->youtobe_link);
        $save->pinterest_link=trim($request->pinterest_link);
        if(!empty($request->file('logo'))){
            $file=$request->file('logo');
            $ext=$file->getClientOriginalExtension();
            $randomStr=Str::random(20);
            $filename=strtolower($randomStr).'.'.$ext;
            $file->move(public_path('/upload/setting/'),$filename);
            $save->logo=trim($filename);
            $save->save();
        }
        if(!empty($request->file('fevicon'))){
            $file=$request->file('fevicon');
            $ext=$file->getClientOriginalExtension();
            $randomStr=Str::random(20);
            $filename=strtolower($randomStr).'.'.$ext;
            $file->move(public_path('/upload/setting/'),$filename);
            $save->fevicon=trim($filename);
            $save->save();
        }
        if(!empty($request->file('footer_payment_icon'))){
            $file=$request->file('footer_payment_icon');
            $ext=$file->getClientOriginalExtension();
            $randomStr=Str::random(20);
            $filename=strtolower($randomStr).'.'.$ext;
            $file->move(public_path('/upload/setting/'),$filename);
            $save->footer_payment_icon=trim($filename);
            $save->save();
        }
        $save->save();
        return redirect()->back()->with('success','Setting successfully updated');
    }
}
