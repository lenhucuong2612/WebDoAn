<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SliderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class SliderController extends Controller
{
    public function List(){
        $data['header_title']="List Shipping Charge";
        $data['getRecord']=SliderModel::getRecord();
        return view("admin.slider.list",$data);
    }
    public function Add(){
        $data['header_title']="Add Discount Code";
        return view("admin.slider.add",$data);
    }
    public function Insert(Request $request){
       
        $slider=new SliderModel();
        $slider->title=trim($request->title);
        $slider->button_name=trim($request->button_name);
        $slider->button_link=trim($request->button_link);
        $file=$request->file('image_name');
        $ext=$file->getClientOriginalExtension();
        $randomStr=Str::random(20);
        $filename=strtolower($randomStr).'.'.$ext;
        $file->move(public_path('/upload/slider/'),$filename);
        $slider->image_name=trim($filename);
        $slider->status=trim($request->status);
        $slider->save();
        session()->flash("success","Slider successfully created");
        return redirect(route("admin.slider.list"));
       
    }
    public function Edit($id){
        $data['getRecord']=SliderModel::getSingle($id);
        $data['header_title']="Edit Slider ";
        return view("admin.slider.edit",$data);
    }
    public function Update($id,Request $request){
       
        $slider=SliderModel::getSingle($id);
        $slider->title=trim($request->title);
        $slider->button_name=trim($request->button_name);
        $slider->button_link=trim($request->button_link);
        if($request->file('image_name')){
            if ($slider->image_name) {
                // Đường dẫn đầy đủ tới ảnh cũ
                $oldImagePath = public_path('/upload/slider/') . $slider->image_name;
                
                // Kiểm tra xem file có tồn tại không và xóa nó
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $file=$request->file('image_name');
            $ext=$file->getClientOriginalExtension();
            $randomStr=Str::random(20);
            $filename=strtolower($randomStr).'.'.$ext;
            $file->move(public_path('/upload/slider/'),$filename);
            $slider->image_name=trim($filename);
        }
        $slider->status=trim($request->status);
        $slider->save();
        session()->flash("success","Shipping charge successfully updated");
        return redirect(route("admin.slider.list"));
      
    }
    public function Remove($id){
        $slider=SliderModel::getSingle($id);
       if($slider==null)
       {
        abort(4040);
       }else{
        $slider->delete();
        session()->flash("success","Slider successfully deleted");
        return redirect()->back();
       }
    }
}
