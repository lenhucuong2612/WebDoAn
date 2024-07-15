<?php

namespace App\Http\Controllers;

use App\Models\BrandModel;
use App\Models\CategoryModel;
use App\Models\ColorModel;
use App\Models\DiscountCodeModel;
use App\Models\ProductModel;
use App\Models\ProductReviewModel;
use App\Models\SubCategoriesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function WishList()
    {
        $data['meta_title']='My Wishlist';
        $data['meta_description']='';
        $data['meta_keywords']='';
        $data['getProduct']=ProductModel::getMyWishlist(Auth::user()->id);
        return view('product.my_wishlist',$data);
    }

    public function GetProductSearch(){
        
            $data['meta_title']='Search';
            $data['meta_description']='';
            $data['meta_keywords']='';
            $getProduct=ProductModel::getProduct();
            
            //load more
            $page=0;
            if(!empty($getProduct->nextPageUrl()))
            {
                $parse_url=parse_url($getProduct->nextPageUrl());
                if(!empty($parse_url['query']))
                {
                    parse_str($parse_url['query'],$get_array);
                    $page=!empty($get_array['page'])?$get_array['page']:0;
                }
            }
            //dd($page);
            $data['page']=$page;
            
            $data['getProduct']=$getProduct;
            $data['getColor']=ColorModel::getRecordActive();
            $data['getBrand']=BrandModel::getRecordActive();
            $data['getDiscountCode']=DiscountCodeModel::getRecordActive();
            return view('product.list',$data);
    }
    public function getCategory($slug,$subslug=''){
        $getCategory=CategoryModel::getSingleSlug($slug);
        $getSubCategory=SubCategoriesModel::getSingleSlug($subslug);
        $getProductSingle=ProductModel::getSingleSlug($slug);
        $data['getColor']=ColorModel::getColorByCategories($slug);
        $data['getBrand']=BrandModel::getBrandByCategory($slug);
        $data['getDiscountCode']=DiscountCodeModel::getRecordActive();
        if($slug=="fashion"){
            $data['check']=true;
        }
        if(!empty($getProductSingle)){
            $data['meta_title']=$getProductSingle->meta_title;
            $data['meta_description']=$getProductSingle->meta_description;
            $data['meta_keywords']=$getProductSingle->meta_keywords;
            $data['getProduct']=$getProductSingle;
            $data['getReviewProduct']=ProductReviewModel::getReivewProduct($getProductSingle->id);
            $data['getRelatedProduct']=ProductModel::getRelatedProduct($getProductSingle->id,$getProductSingle->sub_category_id);
            return view('product.detail',$data);
        }
        else if(!empty($getCategory) && !empty($getSubCategory)){
            $data['meta_title']=$getSubCategory->meta_title;
            $data['meta_description']=$getSubCategory->meta_description;
            $data['meta_keywords']=$getSubCategory->meta_keywords;
            $data['getCategory']=$getCategory;
            $data['getSubCategory']=$getSubCategory;
            $getProduct=ProductModel::getProduct($getCategory->id,$getSubCategory->id);
            $page=0;
            if(!empty($getProduct->nextPageUrl()))
            {
                $parse_url=parse_url($getProduct->nextPageUrl());
                if(!empty($parse_url['query']))
                {
                    parse_str($parse_url['query'],$get_array);
                    $page=!empty($get_array['page'])?$get_array['page']:0;
                }
            }
            //dd($page);
            $data['page']=$page;
            $data['getProduct']=$getProduct;
            $data['getSubCategoryFillter']=SubCategoriesModel::getRecordSubCategory($getCategory->id);
            return view('product.list',$data);
        }
        else if(!empty($getCategory)){
            $data['meta_title']=$getCategory->meta_title;
            $data['meta_description']=$getCategory->meta_description;
            $data['meta_keywords']=$getCategory->meta_keywords;
            $data['getCategory']=$getCategory;
            $getProduct=ProductModel::getProduct($getCategory->id);
            //load more
            $page=0;
            if(!empty($getProduct->nextPageUrl()))
            {
                $parse_url=parse_url($getProduct->nextPageUrl());
                if(!empty($parse_url['query']))
                {
                    parse_str($parse_url['query'],$get_array);
                    $page=!empty($get_array['page'])?$get_array['page']:0;
                }
            }
            //dd($page);
            $data['page']=$page;
            $data['getProduct']=$getProduct;
            $data['getSubCategoryFillter']=SubCategoriesModel::getRecordSubCategory($getCategory->id);
            return view('product.list',$data);
        }else{
            abort(404);
        }
    }
    public function GetFilterCategoryAjax(){
        $getProduct = ProductModel::getProduct();
        return response()->json([
            "status" => true,
            "success" => view("product._list", [
                'getProduct' => $getProduct
            ])->render(),
        ], 200);
    }
}
