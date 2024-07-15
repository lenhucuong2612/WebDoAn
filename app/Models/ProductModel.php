<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ProductModel extends Model
{
    use HasFactory;
    protected $table="product";
    static public function getRecord(){
        return self::select('product.*')
        ->orderBy('product.id','desc')
        ->paginate(50);
    }
    static public function getProduct($category_id = '', $subCategory_id = ''){
        /*
        $return = ProductModel::select('product.*')
            ->join('sub_categories', 'sub_categories.id', '=', 'product.sub_category_id')
            ->join('categories', 'categories.id', '=', 'sub_categories.category_id')->where('product.status', '=', 0);
           
        if (!empty($category_id)) {
            $return = $return->where('categories.id', '=', $category_id);
        }
        if (!empty($subCategory_id)) {
            $return = $return->where('product.sub_category_id', '=', $subCategory_id);
        }
        if (!empty(Request::get('sub_category_id'))) {
            $sub_category_id = rtrim(Request::get('sub_category_id'), ',');
            $sub_category_id_array = explode(",", $sub_category_id);
            $return = $return->whereIn('product.sub_category_id', $sub_category_id_array);
        }else{
            if (!empty(Request::get('old_category_id'))) {
                $return = $return->where('categories.id', '=', Request::get('old_category_id'));
            }
            if (!empty(Request::get('old_sub_category_id'))) {
                $return = $return->where('product.sub_category_id', '=', Request::get('old_sub_category_id'));
            }
        }
        if (!empty(Request::get('brand_id'))) {
            $brand_id = rtrim(Request::get('brand_id'), ',');
            $brand_id_array = explode(',', $brand_id);
            $return = $return
            ->whereIn('product.brand_id', $brand_id_array);
        }else{
            if (!empty(Request::get('old_category_id'))) {
                $return = $return->where('categories.id', '=', Request::get('old_category_id'));
            }
            if (!empty(Request::get('old_sub_category_id'))) {
                $return = $return->where('product.sub_category_id', '=', Request::get('old_sub_category_id'));
            }
        }
        if(!empty(Request::get('size_id'))){
            $size_id=rtrim(Request::get('size_id'), ',');
            $size_id_array=explode(',', $size_id);
            $return =$return->join('product_size','product_size.product_id', '=', 'product.id')
            ->whereIn('product_size.name',$size_id_array);
        }else{
            if (!empty(Request::get('old_category_id'))) {
                $return = $return->where('categories.id', '=', Request::get('old_category_id'));
            }
            if (!empty(Request::get('old_sub_category_id'))) {
                $return = $return->where('product.sub_category_id', '=', Request::get('old_sub_category_id'));
            }
        }
    
        if (!empty(Request::get('color_id'))) {
            $color_id = rtrim(Request::get('color_id'), ',');
            $color_id_array = explode(',', $color_id);
            $return = $return->join('product_color', 'product_color.product_id', '=', 'product.id')
                ->whereIn('product_color.color_id', $color_id_array);
        }else{
            if (!empty(Request::get('old_category_id'))) {
                $return = $return->where('categories.id', '=', Request::get('old_category_id'));
            }
            if (!empty(Request::get('old_sub_category_id'))) {
                $return = $return->where('product.sub_category_id', '=', Request::get('old_sub_category_id'));
            }
        }
        
        if(!empty(Request::get('start_price')) && !empty(Request::get('end_price'))){
            $start_price=str_replace('$','',Request::get('start_price'));
            $end_price=str_replace('$','',Request::get('end_price'));
            $return=$return->where('product.price','>=',$start_price);
            $return=$return->where('product.price','<=',$end_price);
        }else{
            if (!empty(Request::get('old_category_id'))) {
                $return = $return->where('categories.id', '=', Request::get('old_category_id'));
            }
            if (!empty(Request::get('old_sub_category_id'))) {
                $return = $return->where('product.sub_category_id', '=', Request::get('old_sub_category_id'));
            }
        }
        if(!empty(Request::get('q')))
        {
            $return=$return->where('product.title','like','%'.Request::get('q').'%');
        }
        $return = $return
            ->orderBy('product.id', 'desc')
            ->groupBy('product.id')
            ->distinct()
            ->paginate(24);
        return $return;
        */
        $return = ProductModel::select('product.*')
        ->join('sub_categories', 'sub_categories.id', '=', 'product.sub_category_id')
        ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
        ->where('product.status', '=', 0);
       
        if (!empty(Request::get('sub_category_id'))) {
            $sub_category_id = rtrim(Request::get('sub_category_id'), ',');
            $sub_category_id_array = explode(",", $sub_category_id);
            $return = $return->whereIn('product.sub_category_id', $sub_category_id_array);
        }else{
            if (!empty(Request::get('old_category_id'))) {
                $return = $return->where('categories.id', '=', Request::get('old_category_id'));
            }
            if (!empty(Request::get('old_sub_category_id'))) {
                $return = $return->where('product.sub_category_id', '=', Request::get('old_sub_category_id'));
            }
        }
    if (!empty(Request::get('brand_id'))) {
        $brand_id = rtrim(Request::get('brand_id'), ',');
        $brand_id_array = explode(',', $brand_id);
        $brand_id_array = array_map('intval', $brand_id_array); // Chuyển đổi từng phần tử thành số nguyên
        $return = $return->whereIn('product.brand_id', $brand_id_array);
    }
    if (!empty(Request::get('color_id'))) {
        $color_id = rtrim(Request::get('color_id'), ',');
        $color_id_array = explode(',', $color_id);
        $color_id_array=array_map('intval', $color_id_array);
        $return = $return->join('product_color', 'product_color.product_id', '=', 'product.id')
            ->whereIn('product_color.color_id', $color_id_array);
    }
    if(!empty(Request::get('size_id'))){
        $size_id=rtrim(Request::get('size_id'), ',');
        $size_id_array=explode(',', $size_id);
        $size_id_array=array_map('intval', $size_id_array);
        $return =$return->join('product_size','product_size.product_id', '=', 'product.id')
        ->whereIn('product_size.name',$size_id_array);
    }
    
    if (!empty(Request::get('start_price')) && !empty(Request::get('end_price'))) {
        $start_price = str_replace('$', '', Request::get('start_price'));
        $end_price = str_replace('$', '', Request::get('end_price'));
        $return=$return->whereBetween('product.price', [$start_price, $end_price]);
    }
    
    if(!empty(Request::get('q')))
    {
        $return=$return->where('product.title','like','%'.Request::get('q').'%');
    }
    if (!empty($category_id)) {
        $return = $return->where('categories.id', '=', $category_id);
    }

    if (!empty($subCategory_id)) {
        $return = $return->where('product.sub_category_id', '=', $subCategory_id);
    }

    $return = $return->orderBy('product.id', 'desc')->paginate(9);

    

    return $return;
    }
    //home screen product
    static public function getRecentArrival()
    {
        
        $return = ProductModel::select('product.*')
        ->where('product.status', '=', 0);
        if(!empty(Request::get('category_id'))){
            $return=$return->join('sub_categories','sub_categories.id','=','product.sub_category_id')
            ->join('categories','categories.id','=','sub_categories.category_id')
            ->where('categories.id','=',Request::get('category_id'));
        }
        $return = $return->groupBy('product.id')
        ->orderBy('product.id', 'desc')
        ->limit(8)
        ->get();
         return $return;
    }
    static public function getRelatedProduct($product_id,$sub_category_id){
        $return = ProductModel::select('product.*',
        'categories.name as category_name',
        'categories.slug as category_slug',
        'sub_categories.name as sub_category_name',
        'sub_categories.slug as sub_category_slug')
        ->join('sub_categories', 'sub_categories.id', '=', 'product.sub_category_id')
        ->join('categories', 'categories.id', '=', 'categories.id')
        ->where('product.status', '=', 0)
        ->where('product.sub_category_id','=',$sub_category_id)
        ->where('product.id','!=',$product_id)
        ->groupBy('product.id')
        ->orderBy('product.id', 'desc')
        ->limit(10)
        ->get();
        return $return;
    }
    static public function getMyWishlist($user_id)
    {
        return self::select('product.*')
        ->join('product_wishlist','product_wishlist.product_id','=','product.id')
        ->where('product_wishlist.user_id','=',$user_id)
        ->where('product.status','=',0)
        ->orderBy('product.id','desc')
        ->paginate(50);
    }

    static public function getSingleSlug($slug){
        return self::where('slug','=',$slug)
        ->where('status','=','0')
        ->first();
    }
    static function getIamgeSingle($product_id){
        return ProductImageModel::where('product_id','=',$product_id)->orderBy('order_by','asc')->first();
    }
    static public function getImageFull($product_id)
    {
        return ProductImageModel::where('product_id','=',$product_id)->orderBy('order_by','asc')->get();
    }
    static public function getSingle($id){
        return self::find($id);
    }
    static public function checkSlug($slug){
        return self::where('slug','=',$slug)->count();
    }
    static public function checkWishlist($product_id)
    {
        return ProductWishlistModel::checkAlready($product_id,Auth::user()->id);
    }
    public function getColor(){
        return $this->hasMany(ProductColorModel::class,'product_id');
    }
    public function getSize(){
        return $this->hasMany(ProductSizeModel::class,'product_id');
    }
    public function getImage(){
        return $this->hasMany(ProductImageModel::class,'product_id')->orderBy('order_by');
    }
    public function getCategory(){
        return $this->belongsto(CategoryModel::class,'category_id');
    }
    public function getSubCategory(){
        return $this->belongsto(SubCategoriesModel::class,'sub_category_id');
    }
    public function getTotalReview()
    {
        return $this->hasMany(ProductReviewModel::class,'product_id')
        ->join('users','users.id','product_review.user_id')
        ->count();
    }
    static public function getReviewRaiting($product_id)
    {
        $avg=ProductReviewModel::getRaitingAVG($product_id);
        if($avg>=1 && $avg<=1)
        {
            return 20;
        }elseif ($avg>=1 && $avg<=2)
        {
            return 40;
        }
        elseif ($avg>=1 && $avg<=3)
        {
            return 60;
        }
        elseif ($avg>=1 && $avg<=4)
        {
            return 80;
        }
        elseif ($avg>=1 && $avg<=5)
        {
            return 100;
        }else{
            return 0;
        }
    }

    //product trendy
    static public function productTrendy()
    {
        return self::select('product.*', self::raw('COUNT(product.id) as count'))
        ->join('orders_item', 'orders_item.product_id', '=', 'product.id')
        ->join('orders','orders.id','=','orders_item.order_id')
        ->where('orders.status','=',3)
        ->groupBy('product.id')
        ->orderByDesc('count')
        ->limit(4)
        ->get();
    }

    public function productSizes()
    {
        return $this->hasMany(ProductSizeModel::class, 'product_id');
    }
}
