<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryModel;
use App\Models\SubCategoriesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    public function ListCategories(){
        $data['header_title']="List Category";
        $data['getRecord']=CategoryModel::getRecord();
        return view("admin.category.list",$data);
    }
    public function AddCategory(){
        $data['header_title']="Add Category";
        return view("admin.category.add",$data);
    }
    public function InsertCategory(Request $request){
        $validator=Validator::make($request->all(),[
            'category_name'=>'required'
        ]);
       if($validator->passes()){
        $category=new CategoryModel();
        $name=trim($request->category_name);
        $category->name=$name;
        $category->slug=trim($request->slug);
        $category->meta_title=trim($request->meta_title);
        $category->meta_description=trim($request->meta_description);
        $category->meta_keywords=trim($request->meta_keywords);
        $category->button_name=trim($request->button_name);
        $category->is_home=!empty($request->is_home)?1:0;
        if($request->file('image_name')){
            $file=$request->file('image_name');
            $ext=$file->getClientOriginalExtension();
            $randomStr=Str::random(20);
            $filename=strtolower($randomStr).'.'.$ext;
            $file->move(public_path('/upload/category/'),$filename);
            $category->image_name=trim($filename);
        }
        $category->status=$request->status;
        $category->save();
        $slug=Str::slug($name,'-');
        $checkSlug=CategoryModel::checkSlug($slug);
        if(empty($checkSlug))
        {
            $category->slug=$slug;
            $category->save();
        }else{
            $new_slug=$slug.'-'.$category->id;
            $category->slug=$new_slug;
            $category->save();
        }
        session()->flash("success","Category successfully created");
        return redirect(route("admin.categories.list"));
       }else{
            return back()
            ->withErrors($validator)
            ->withInput();
        }
    }
    public function EditCategory($id){
        $data['getRecord']=CategoryModel::getSingle($id);
        $data['header_title']="Edit Category";
        return view("admin.category.edit",$data);
    }
    public function UpdateCategory($id,Request $request){
        $validator=Validator::make($request->all(),[
            'category_name'=>'required'
        ]);
       if($validator->passes()){
        $category=CategoryModel::getSingle($id);
        $name=trim($request->category_name);
        $category->name=$name;
       
        $category->meta_title=trim($request->meta_title);
        $category->meta_description=trim($request->meta_description);
        $category->meta_keywords=trim($request->meta_keywords);
        $category->button_name=trim($request->button_name);
        $category->is_home=!empty($request->is_home)?1:0;
        if($request->file('image_name')){
            if ($category->image_name) {
                // Đường dẫn đầy đủ tới ảnh cũ
                $oldImagePath = public_path('/upload/category/') . $category->image_name;
                
                // Kiểm tra xem file có tồn tại không và xóa nó
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $file=$request->file('image_name');
            $ext=$file->getClientOriginalExtension();
            $randomStr=Str::random(20);
            $filename=strtolower($randomStr).'.'.$ext;
            $file->move(public_path('/upload/category/'),$filename);
            $category->image_name=trim($filename);
        }
        $category->status=$request->status;
        $category->save(); 
        $slug=Str::slug($name,'-');
        $checkSlug=CategoryModel::checkSlug($slug);
        if(empty($checkSlug)){
            $category->slug=$slug;
            $category->save();
        }else{
            if(CategoryModel::getSingle($id)->slug==$slug){
                $category->slug=$slug;
                $category->save();
            }else{
                $new_slug=$slug.'-'.$category->id;
                $category->slug=$new_slug;
                $category->save();
            }
        }
        session()->flash("success","Category successfully updated");
        return redirect(route("admin.categories.list"));
       }else{
            return back()
            ->withErrors($validator) 
            ->withInput();
        }
    }
    public function RemoveCategory($id){
        $category=CategoryModel::getSingle($id);
        if($category==null)
        {
            abort(404);
        }
        else{
            $category->delete();
        session()->flash("success","Category successfully deleted");
        return redirect()->back();
        }
    }
   
}
