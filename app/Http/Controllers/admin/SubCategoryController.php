<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\SubCategoriesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    public function List(){
        $data['header_title']="List Category";
        $data['getRecord']=SubCategoriesModel::getRecord();
        return view("admin.sub_category.list",$data);
    }
    public function Add(){
        $data['header_title']="Add Sub Category";
        $data['getCategory']=CategoryModel::getRecord();
        return view("admin.sub_category.add",$data);
    }
    public function Insert(Request $request){
        $validator=Validator::make($request->all(),[
            'sub_category_name'=>'required',
            'slug'=>'required|unique:sub_categories',
            'category_name' => 'required',
        ]);
       if($validator->passes()){
        $category=new SubCategoriesModel();
        $category->name=trim($request->sub_category_name);
        $category->slug=trim($request->slug);
        $category->meta_title=trim($request->meta_title);
        $category->meta_description=trim($request->meta_description);
        $category->meta_keywords=trim($request->meta_keywords);
        $category->created_by=Auth::user()->id;
        $category->category_id=$request->category_name;
        $category->save();
        session()->flash("success","Sub Category successfully created");
        return redirect(route("admin.sub_categories.list"));
       }else{
            return back()
            ->withErrors($validator)
            ->withInput();
        }
    }
    public function Edit($id){
        $data['header_title']="Add Sub Category";
        $data['getCategory']=CategoryModel::getRecord();
        $data['getRecord']=SubCategoriesModel::getSingle($id);
        return view("admin.sub_category.edit",$data);
    }
    public function Update($id,Request $request){
        $validator=Validator::make($request->all(),[
            'sub_category_name'=>'required',
            'slug'=>'required|unique:sub_categories,slug,'.$id,
            'category_name' => 'required',
        ]);
       if($validator->passes()){
        $category=SubCategoriesModel::getSingle($id);
        $category->name=trim($request->sub_category_name);
        $category->slug=trim($request->slug);
        $category->meta_title=trim($request->meta_title);
        $category->meta_description=trim($request->meta_description);
        $category->meta_keywords=trim($request->meta_keywords);
        $category->created_by=Auth::user()->id;
        $category->category_id=$request->category_name;
        $category->save();
        session()->flash("success","Sub Category successfully updated");
        return redirect(route("admin.sub_categories.list"));
       }else{
            return back()
            ->withErrors($validator)
            ->withInput();
        }
    }
    public function Remove($id){
        $category=SubCategoriesModel::getSingle($id);
        $category->is_delete=1;
        $category->save();
        session()->flash("success","Sub Category successfully deleted");
        return redirect(route("admin.sub_categories.list"));
    }
    public function Get_Sub_Category(Request $request){
        $category_id=$request->id;
        $get_sub_category=SubCategoriesModel::getRecordSubCategory($category_id);
        $html='';
        $html=' <option value="">Select</option>';
        foreach($get_sub_category as $value){
            $html .='<option value="'.$value->id.'">'.$value->name.'</option>';
        }
        $json['html']=$html;
        echo json_encode($json);
    }
}
