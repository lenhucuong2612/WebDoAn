<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PartnerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class PartnerController extends Controller
{
    public function List(){
        $data['header_title']="List Partner";
        $data['getRecord']=PartnerModel::getRecord();
        return view("admin.partner.list",$data);
    }
    public function Add(){
        $data['header_title']="Add Parter";
        return view("admin.partner.add",$data);
    }
    public function Insert(Request $request){
       
        $partner=new PartnerModel();
        $partner->button_link=trim($request->button_link);
        $file=$request->file('image_name');
        $ext=$file->getClientOriginalExtension();
        $randomStr=Str::random(20);
        $filename=strtolower($randomStr).'.'.$ext;
        $file->move(public_path('/upload/partner/'),$filename);
        $partner->image_name=trim($filename);
        $partner->status=trim($request->status);
        $partner->save();
        session()->flash("success","Partner successfully created");
        return redirect(route("admin.partner.list"));
       
    }
    public function Edit($id){
        $data['getRecord']=PartnerModel::getSingle($id);
        $data['header_title']="Edit Partner ";
        return view("admin.partner.edit",$data);
    }
    public function Update($id,Request $request){
       
        $partner=PartnerModel::getSingle($id);
        $partner->button_link=trim($request->button_link);
        if($request->file('image_name')){
            if ($partner->image_name) {
                // Đường dẫn đầy đủ tới ảnh cũ
                $oldImagePath = public_path('/upload/partner/') . $partner->image_name;
                
                // Kiểm tra xem file có tồn tại không và xóa nó
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $file=$request->file('image_name');
            $ext=$file->getClientOriginalExtension();
            $randomStr=Str::random(20);
            $filename=strtolower($randomStr).'.'.$ext;
            $file->move(public_path('/upload/partner/'),$filename);
            $partner->image_name=trim($filename);
        }
        $partner->status=trim($request->status);
        $partner->save();
        session()->flash("success","Shipping charge successfully updated");
        return redirect(route("admin.partner.list"));
      
    }
    public function Remove($id){
        $partner=PartnerModel::getSingle($id);
        $partner->is_delete=1;
        $partner->save();
        session()->flash("success","Partner successfully deleted");
        return redirect()->back();
    }
}
