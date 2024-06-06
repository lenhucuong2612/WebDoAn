<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategoryModel;
use App\Models\BlogModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class BlogController extends Controller
{
    public function List(){
        $data['header_title']="List Blog";
        $data['getRecord']=BlogModel::getRecord();
        return view("admin.blog.list",$data);
    }
    public function Add(){
        $data['getBlogCategory']=BlogCategoryModel::getRecordActive();
        $data['header_title']="Add Blog";
        return view("admin.blog.add",$data);
    }
    public function Insert(Request $request){
       
        $validator=Validator::make($request->all(),[
            'title'=>'required',
            'blog_category_id'=>'required'
        ]);
       if($validator->passes()){
        $blog=new BlogModel();
        $blog->blog_category_id=$request->blog_category_id;
        $blog->title=trim($request->title);
        if(!empty($request->file('image_name')))
        {
            $file=$request->file('image_name');
            $ext=$file->getClientOriginalExtension();
            $randomStr=Str::random(20);
            $filename=strtolower($randomStr).'.'.$ext;
            $file->move(public_path('/upload/blog/'),$filename);
            $blog->image_name=trim($filename);
        }
        $blog->description=trim($request->description);
        $blog->meta_title=trim($request->meta_title);
        $blog->meta_description=trim($request->meta_description);
        $blog->meta_keywords=trim($request->meta_keywords);
        $blog->save();
        $slug=Str::slug($request->title,'-');
        $count=BlogModel::where('slug','=',$slug)->count();
        if(empty($count)){
            $blog->slug=trim($slug);
        }else{
            $blog->slug=$slug.'-'.$blog->id;
        }
        $blog->save();
        session()->flash("success","Blog successfully created");
        return redirect(route("admin.blog.list"));
       }else{
            return back()
            ->withErrors($validator)
            ->withInput();
        }
       
    }
    public function Edit($id){
        $data['getCategory']=BlogCategoryModel::getRecordActive();
        $data['getRecord']=BlogModel::getSingle($id);
        $data['header_title']="Edit Blog Category";
        return view("admin.blog.edit",$data);
    }
    public function Update($id,Request $request){
        $validator=Validator::make($request->all(),[
            'title'=>'required',
            'blog_category_id'=>'required'
        ]);
        if($validator->passes()){
        $blog=BlogModel::getSingle($id);
        $blog->blog_category_id=$request->blog_category_id;
        $blog->title=trim($request->title);
        if(!empty($request->file('image_name')))
        {
            if(!empty($blog->image_name)){
                $old_path=public_path('/upload/blog/').$blog->image_name;
                if(!empty($old_path))
                {
                    unlink($old_path);
                }
            }
            $file=$request->file('image_name');
            $ext=$file->getClientOriginalExtension();
            $randomStr=Str::random(20);
            $filename=strtolower($randomStr).'.'.$ext;
            $file->move(public_path('/upload/blog/'),$filename);
            $blog->image_name=trim($filename);
        }
        $blog->description=trim($request->description);
        $blog->meta_title=trim($request->meta_title);
        $blog->meta_description=trim($request->meta_description);
        $blog->meta_keywords=trim($request->meta_keywords);
        $blog->save();
        $slug=Str::slug($request->title);
        $count=BlogModel::where('slug','=',$slug)->count();
        if(empty($count)){
            $blog->slug=trim($slug);
        }else{
            if($blog->slug==$slug){
                $blog->slug=trim($slug);
            }
            else{
                $blog->slug=$slug.'-'.$blog->id;
            }
        }
        $blog->save();
        session()->flash("success","Blog successfully updated");
        return redirect(route("admin.blog.list"));
       }else{
            return back()
            ->withErrors($validator)
            ->withInput();
        }
       
    }
    public function Remove($id){
        $color=BlogModel::getSingle($id);
        $color->is_delete=1;
        $color->save();
        session()->flash("success","Blog category successfully deleted");
        return redirect()->back();
    }
}
