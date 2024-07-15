<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;
    protected $table="categories";
    static public function getRecord(){
        return self::select('categories.*')
        ->orderBy('categories.id','desc')
        ->get();
    }
    static public function getSingle($id){
        return self::find($id);
    }
    static public function getSingleSlug($slug){
        return self::where('slug','=',$slug)->where('categories.status','=',0)->first();
    }
    static public function getRecordActive(){
        return self::select('categories.*')
        ->where('categories.status','=',0)
        ->orderBy('categories.name','asc')
        ->get();
    }
    static public function getRecordActiveHome(){
        return self::select('categories.*')
        ->where('categories.status','=',0)
        ->where('categories.is_home','=',1)
        ->orderBy('categories.name','asc')
        ->get();
    }
    static public function getRecordMenu(){
        return self::select('categories.*')
        ->where('categories.status','=',0)
        ->get();
    }
    public function getSubCategory(){
        return $this->hasMany(SubCategoriesModel::class,'category_id')->where('sub_categories.status','=',0);
    }
    public function getImage(){
        if(!empty($this->image_name)&&file_exists(public_path('/upload/category/'.$this->image_name))){
            return url('/upload/category/'.$this->image_name);
        }else{
            return "";
        }
    }
    static public function checkSlug($slug)
    {
        return self::where('slug','=',$slug)->count();
    }
}
