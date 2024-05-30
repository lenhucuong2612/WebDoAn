<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BrandModel;
use App\Models\CategoryModel;
use App\Models\ColorModel;
use App\Models\ProductColorModel;
use App\Models\ProductImageModel;
use App\Models\ProductModel;
use App\Models\ProductSizeModel;
use App\Models\SubCategoriesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    
    public function List(){
        $data['header_title']="List Category";
        $data['getRecord']=ProductModel::getRecord();
        return view("admin.product.list",$data);
    }
    public function Add(){
        $data['header_title']="Add New Product";
        $data['getCategory']=CategoryModel::getRecord();
        return view("admin.product.add",$data);
    }
    public function Insert(Request $request){
        $validator=Validator::make($request->all(),[
            'title'=>'required'
        ]);
       if($validator->passes()){
        $product=new ProductModel();
        $title=trim($request->title);
        $product->title=$title;
        $product->created_by=Auth::user()->id;
        $product->category_id=1;
        $product->sub_category_id=1;
        $product->brand_id=1;
        $product->created_by=1;
        $product->old_price=0;
        $product->price=0;
        $product->short_description='';
        $product->description='';
        $product->additional_information='';
        $product->shipping_returns='';
        $product->sku='';
        $product->save();

        
        $slug=Str::slug($title,'-');
        $checkSlug=ProductModel::checkSlug($slug);
        if(empty($checkSlug)){
            $product->slug=$slug;
            $product->save();
        }else{
            $new_slug=$slug.'-'.$product->id;
            $product->slug=$new_slug;
            $product->save();
        }
        session()->flash("success","Product successfully created");
        return redirect(route("admin.product.edit",$product->id));
       }else{
            return back()
            ->withErrors($validator)
            ->withInput();
        } 
    }
    public function edit($product_id){
        $product=ProductModel::getSingle($product_id);
        if(!empty($product)){
            $data['product']=$product;
            $data['getCategory']=CategoryModel::getRecordActive();
            $data['getBrand']=BrandModel::getRecordActive();
            $data['getColor']=ColorModel::getRecordActive();
            $data['getSubCategory']=SubCategoriesModel::getRecordSubCategory($product->category_id);
            $data['header_title']="Edit Product";
            return view("admin.product.edit",$data);
        }else{
            abort(404);
        }
    }
    public function Update($product_id, Request $request){
        $validator=Validator::make($request->all(),[
            'title'=>'required',
            'sku'=>'required',
            'price'=>'required|numeric',
            'old_price'=>'required|numeric'
        ]);
        $product=ProductModel::getSingle($product_id);
        if(!empty($product)){
            if($validator->passes()){
                $title=trim($request->title);
                $product->title=$title;
                $product->created_by=Auth::user()->id;
                $product->category_id=$request->category_id;
                $product->sub_category_id=$request->sub_category_id;
                $product->brand_id=$request->brand_id;
                $product->old_price=$request->old_price;
                $product->price=$request->price;
                $product->short_description=trim($request->short_description);
                $product->description=$request->input('description');
                $product->additional_information=$request->input('additional_information');
                $product->shipping_returns=$request->input('shipping_return');
                $product->status=$request->status;
                $product->sku=$request->sku;
                $product->save();
                $slug=Str::slug($title,'-');
                $checkSlug=ProductModel::checkSlug($slug);
                if(empty($checkSlug)){
                        $product->slug=$slug;
                        $product->save();
                }else{
                    if(ProductModel::getSingle($product_id)->slug==$slug){
                        $product->slug=$slug;
                        $product->save();
                    }
                   else{
                    $new_slug=$slug.'-'.$product->id;
                    $product->slug=$new_slug;
                    $product->save();
                   }
                }
                ProductColorModel::DeleteRecord($product->id);
                if(!empty($request->color_id)){

                    foreach($request->color_id as $color_id){
                        $color=new ProductColorModel;
                        $color->product_id=$product->id;
                        $color->color_id=$color_id;
                        $color->save();
                    }
                }
                ProductSizeModel::DeleteRecord($product_id);
                if(!empty($request->size)){
                    foreach($request->size as $size){
                        if(!empty($size['name'])){
                            $sizeSave=new ProductSizeModel;
                            $sizeSave->name=$size['name'];
                            $sizeSave->price=!empty($size['price'])?$size['price']:0;
                            $sizeSave->product_id=$product->id;
                            $sizeSave->save();
                        }
                    }
                }
                if(!empty($request->file('image'))){
                    foreach($request->file('image') as $value){
                        if($value->isValid()){
                            $ext=$value->getClientOriginalExtension();
                            $randomStr=$product->id.Str::random(10);
                            $filename=strtolower($randomStr).'.'.$ext;
                            $value->move(public_path('/upload/product/'),$filename);
                            $imageUpload=new ProductImageModel;
                            $imageUpload->image_name=$filename;
                            $imageUpload->image_extension=$ext;
                            $imageUpload->product_id=$product->id;
                            $imageUpload->save();
                        }
                    }
                }
                session()->flash('success',"Updated successfully");
                return redirect()->route('admin.product.list');
            }else{
                return back()->withErrors($validator)->withInput();
            }
            
        }else{
            abort(404);
        }
    }
    public function DeleteImage($id){
        $image=ProductImageModel::getSingle($id);
        if(!empty($image->getLogo())){
            unlink(public_path('/upload/product/'.$image->image_name));
        }
        $image->delete();
        return redirect()->back()->with('success','Deleted product image successfully');
    }
    public function Sortable(Request $request){
        if(!empty($request->photo_id)){
            $i=1;
            foreach($request->photo_id as $photo_id){
                $image=ProductImageModel::getSingle($photo_id);
                $image->order_by=$i;
                $image->save();
                $i++;
            }
        }
        $json['success']=true;
        echo json_encode($json);
    }
}
