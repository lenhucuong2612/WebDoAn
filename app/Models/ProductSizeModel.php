<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSizeModel extends Model
{
    use HasFactory;
    protected $table="product_size";
    static public function DeleteRecord($product_id){
        self::where('product_id','=',$product_id)->delete();
    }
    static public function getSingle($id)
    {
        return self::find($id);
    }
    static public function getSingleName($id)
    {
        return self::where('id','=',$id)->first();
    }
    public static function getSize($product_id)
    {
        return self::where('product_id', $product_id)->get(); // Lấy ra một collection của các bản ghi dựa trên size_id
    }
    public static function getQuantity($id)
    {
        return self::select('quantity')->where('id',$id)->first();
    }
    public function productColors()
    {
        return $this->hasMany(ProductColorModel::class, 'product_id')->count();
    }

    
}
