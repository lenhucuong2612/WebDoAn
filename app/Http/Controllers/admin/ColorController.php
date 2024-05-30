<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ColorModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    public function List(){
        $data['header_title']="List Brand";
        $data['getRecord']=ColorModel::getRecord();
        return view("admin.color.list",$data);
    }
    public function Add(){
        $data['header_title']="Add Color";
        return view("admin.color.add",$data);
    }
    public function Insert(Request $request){
        $validator=Validator::make($request->all(),[
            'color_name'=>'required',
            'code_name'=>'required|unique:color,code'
        ]);
       if($validator->passes()){
        $color=new ColorModel();
        $color->name=trim($request->color_name);
        $color->code=trim($request->code_name);
        $color->created_by=Auth::user()->id;
        $color->save();
        session()->flash("success","Color successfully created");
        return redirect(route("admin.color.list"));
       }else{
            return back()
            ->withErrors($validator)
            ->withInput();
        }
    }
    public function Edit($id){
        $data['getRecord']=ColorModel::getSingle($id);
        $data['header_title']="Edit Color";
        return view("admin.color.edit",$data);
    }
    public function Update($id,Request $request){
        $validator=Validator::make($request->all(),[
            'color_name'=>'required',
            'code_name'=>'required|unique:color,code,'.$id
        ]);
       if($validator->passes()){
        $color=ColorModel::getSingle($id);
        $color->name=trim($request->color_name);
        $color->code=trim($request->code_name);
        $color->created_by=Auth::user()->id;
        $color->save();
        session()->flash("success","Color successfully updated");
        return redirect(route("admin.color.list"));
       }else{
            return back()
            ->withErrors($validator)
            ->withInput();
        }
    }
    public function Remove($id){
        $color=ColorModel::getSingle($id);
        $color->is_delete=1;
        $color->save();
        session()->flash("success","Color successfully deleted");
        return redirect()->back();
    }
}
