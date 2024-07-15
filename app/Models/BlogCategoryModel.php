<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategoryModel extends Model
{
    use HasFactory;
    protected $table="blog_category";
    static public function getSingle($id)
    {
        return self::find($id);
    } 
    static public function getSingleSlug($slug){
        return self::where('slug','=',$slug)
        ->where('blog_category.status','=',0)
        ->first();
    }
    static public function getRecord()
    {
        return self::select('blog_category.*')
        ->orderBy('blog_category.id','desc')
        ->get();
    }
    static public function getRecordActive()
    {
        return self::select('blog_category.*')
        ->where('blog_category.status','=',0)
        ->orderBy('blog_category.id','asc')
        ->paginate(20);
    }
    public function getCountBlog()
    {
        return $this->hasMany(BlogModel::class,'blog_category_id')
        ->where('blog.status','=',0)
        ->count();
    }
}
