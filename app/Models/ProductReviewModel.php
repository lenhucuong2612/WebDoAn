<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReviewModel extends Model
{
    use HasFactory;
    protected $table='product_review';
    static public function getSingle($id)
    {
        return self::find($id);
    }
    static public function getReivew($product_id,$order_id,$user_id)
    {
       return self::select('*')
       ->where('product_id','=',$product_id)
       ->where('order_id','=',$order_id)
       ->where('user_id','=',$user_id)
       ->first();
    }
    static public function getReivewProduct($product_id)
    {
       return self::select('product_review.*','users.name')
       ->join('users','users.id','product_review.user_id')
       ->where('product_id','=',$product_id)
       ->orderBy('product_review.id','desc')
       ->paginate(20);
    }
    public function getPercent()
    {
        $raiting=$this->raiting;
        if($raiting==1){
            return 20;
        }
        elseif($raiting==2)
        {
            return 40;
        }
        elseif($raiting==3)
        {
            return 60;
        }
        elseif($raiting==4)
        {
            return 80;
        }
        elseif($raiting==5)
        {
            return 100;
        }else{
            return 0;
        }
    }
    static public function getRaitingAVG($product_id)
    {
        return self::select('product_review.raiting')
       ->where('product_id','=',$product_id)
       ->avg('product_review.raiting');
    }
}
