<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogCategoryController extends Controller
{
    public function List(){
        $data['header_title']="List Blog Category";
        $data['getRecord']=BlogCategoryModel::getRecord();
        return view("admin.blogcategory.list",$data);
    }
    public function Add(){
        $data['header_title']="Add Blog Category";
        return view("admin.blogcategory.add",$data);
    }
    public function Insert(Request $request){
       
        $validator=Validator::make($request->all(),[
            'blog_category_name'=>'required',
            'slug'=>'required|unique:blog_category,slug'
        ]);
       if($validator->passes()){
        $blogCategory=new BlogCategoryModel();
        $blogCategory->name=trim($request->blog_category_name);
        $blogCategory->title=trim($request->title);
        $blogCategory->slug=trim($request->slug);
        $blogCategory->meta_title=trim($request->meta_title);
        $blogCategory->meta_description=trim($request->meta_description);
        $blogCategory->meta_keywords=trim($request->meta_keywords);
        $blogCategory->status=trim($request->status);
        $blogCategory->save();
        session()->flash("success","Category successfully created");
        return redirect(route("admin.blogcategory.list"));
       }else{
            return back()
            ->withErrors($validator)
            ->withInput();
        }
       
    }
    public function Edit($id){
        $data['getRecord']=BlogCategoryModel::getSingle($id);
        $data['header_title']="Edit Blog Category";
        return view("admin.blogcategory.edit",$data);
    }
    public function Update($id,Request $request){
        $validator=Validator::make($request->all(),[
            'blog_category_name'=>'required',
            'slug'=>'required|unique:blog_category,slug,'.$id
        ]);
       if($validator->passes()){
            $blogCategory=BlogCategoryModel::getSingle($id);
            $blogCategory->name=trim($request->blog_category_name);
            $blogCategory->title=trim($request->title);
            $blogCategory->slug=trim($request->slug);
            $blogCategory->meta_title=trim($request->meta_title);
            $blogCategory->meta_description=trim($request->meta_description);
            $blogCategory->meta_keywords=trim($request->meta_keywords);
            $blogCategory->status=trim($request->status);
            $blogCategory->save();
            session()->flash("success","Blog Category successfully updated");
            return redirect(route("admin.blogcategory.list"));
       }else{
            return back()
            ->withErrors($validator)
            ->withInput();
        }
       
    }
    public function Remove($id){
        $color=BlogCategoryModel::getSingle($id);
        if($color==null)
        {
            abort(404);
        }else{
            $color->delete();
        session()->flash("success","Blog category successfully deleted");
        return redirect()->back();
        }
        
    }
}
