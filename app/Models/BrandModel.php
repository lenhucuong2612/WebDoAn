<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandModel extends Model
{
    use HasFactory;
    protected $table='brand';
    static public function getRecord(){
        return self::select('brand.*')
        ->orderBy('brand.id','desc')
        ->get();
    }
    static public function getRecordActive(){
        return self::select('brand.*')
        ->where('brand.status','=',0)
        ->orderBy('brand.name','asc')
        ->get();
    }
    static public function getSingle($id){
        return self::find($id);
    }
    static public function getBrandByCategory($slug)
    {
        return self::select('brand.*')
        ->join('product','product.brand_id','=','brand.id')
        ->join('sub_categories','sub_categories.id','product.sub_category_id')
        ->join('categories','categories.id','=','sub_categories.category_id')
        ->where('categories.slug','=',$slug)
        ->distinct()
        ->get();
    }
}
