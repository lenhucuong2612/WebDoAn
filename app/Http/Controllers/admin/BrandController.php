<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BrandModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function List(){
        $data['header_title']="List Brand";
        $data['getRecord']=BrandModel::getRecord();
        return view("admin.brand.list",$data);
    }
    public function Add(){
        $data['header_title']="Add Brand";
        return view("admin.brand.add",$data);
    }
    public function Insert(Request $request){
        $validator=Validator::make($request->all(),[
            'brand_name'=>'required',
            'slug'=>'required|unique:brand'
        ]);
       if($validator->passes()){
        $category=new BrandModel();
        $category->name=trim($request->brand_name);
        $category->slug=trim($request->slug);
        $category->meta_title=trim($request->meta_title);
        $category->meta_description=trim($request->meta_description);
        $category->meta_keywords=trim($request->meta_keywords);
        $category->created_by=Auth::user()->id;
        $category->save();
        session()->flash("success","Brand successfully created");
        return redirect(route("admin.brand.list"));
       }else{
            return back()
            ->withErrors($validator)
            ->withInput();
        }
    }
    public function Edit($id){
        $data['getRecord']=BrandModel::getSingle($id);
        $data['header_title']="Edit Brand";
        return view("admin.brand.edit",$data);
    }
    public function Update($id,Request $request){
        $validator=Validator::make($request->all(),[
            'brand_name'=>'required',
            'slug'=>'required|unique:brand,slug,'.$id
        ]);
       if($validator->passes()){
        $category=BrandModel::getSingle($id);
        $category->name=trim($request->brand_name);
        $category->slug=trim($request->slug);
        $category->meta_title=trim($request->meta_title);
        $category->meta_description=trim($request->meta_description);
        $category->meta_keywords=trim($request->meta_keywords);
        $category->created_by=Auth::user()->id;
        $category->save();
        session()->flash("success","Brand successfully updated");
        return redirect(route("admin.brand.list"));
       }else{
            return back()
            ->withErrors($validator)
            ->withInput();
        }
    }
    public function Remove($id){
        $category=BrandModel::getSingle($id);
        $category->is_delete=1;
        $category->save();
        session()->flash("success","Brand successfully deleted");
        return redirect()->back();
    }
}
