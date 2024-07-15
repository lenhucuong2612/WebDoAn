<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorModel extends Model
{
    use HasFactory;
    protected $table="color";
    static public function getRecord(){
        return self::select('color.*')
        ->orderBy('color.id','desc')
        ->get();
    }
    static public function getSingle($id){
        return self::find($id);
    }
    static public function getRecordActive(){
        return self::select('color.*')
        ->where('color.status','=',0)
        ->orderBy('color.name','asc')
        ->get();
    }
    
    static public function getColorByCategories($slug)
    {
        return self::select('color.*')
        ->join('product_color','product_color.color_id','=','color.id')
        ->join('product','product.id','=','product_color.product_id')
        ->join('sub_categories','sub_categories.id','product.sub_category_id')
        ->join('categories','categories.id','=','sub_categories.category_id')
        ->where('categories.slug','=',$slug)
        ->distinct()
        ->get();
    }
}
