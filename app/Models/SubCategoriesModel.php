<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoriesModel extends Model
{
    use HasFactory;
    protected $table='sub_categories';
    static public function getRecord(){
        return self::select('sub_categories.*','users.name as created_by_name','categories.name as category_name')
        ->join('categories','categories.id','=','sub_categories.category_id')
        ->join('users','users.id','=','categories.created_by')
        ->where('sub_categories.is_delete','=',0)
        ->orderBy('sub_categories.id','desc')
        ->paginate(10);
    }
    static public function getSingle($id){
        return self::find($id);
    }
    static public function getSingleSlug($slug){
        return self::where('slug','=',$slug)->where('sub_categories.status','=',0)
        ->where('sub_categories.is_delete','=',0)->first();
    }
    static public function getRecordSubCategory($category_id){
        return self::select('sub_categories.*')
        ->where('sub_categories.is_delete','=',0)
        ->where('sub_categories.status','=',0)
        ->where('sub_categories.category_id','=',$category_id)
        ->orderBy('sub_categories.name','asc')
        ->get();
    }
    public function TotalProduct(){
        return $this->hasMany(ProductModel::class,'sub_category_id')
        ->where('product.is_delete','=',0)
        ->where('product.status','=',0)
        ->count();
    }
}
