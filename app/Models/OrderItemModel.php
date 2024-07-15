<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class OrderItemModel extends Model
{
    use HasFactory;
    protected $table='orders_item';
    public function getProduct()
    {
        return $this->belongsTo(ProductModel::class,'product_id');
    }
    static public function getReview($product_id,$order_id)
    {
        return ProductReviewModel::getReivew($product_id,$order_id,Auth::user()->id);
    }
    public static function findProductByOrderItem($id)
    {
        return self::where('order_id','=',$id)->get();
    }
   
}
