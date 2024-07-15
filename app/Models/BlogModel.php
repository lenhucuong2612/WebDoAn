<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class BlogModel extends Model
{
    use HasFactory;
    protected $table="blog";
    static public function getSingle($id)
    {
        return self::find($id);
    }
    static public function getSingleSlug($slug){
        return self::where('slug','=',$slug)
        ->where('blog.status','=',0)
        ->first();
    }
    static public function getSlug($slug)
    {
        return self::where('slug','=',$slug)
        ->where('blog.status','=',0)
        ->first();
    }
    static public function getRecord()
    {
        return self::select('blog.*')
        ->orderBy('blog.id','desc')
        ->paginate(20);
    }
    static public function getRecordActive()
    {
        return self::select('blog.*')
        ->where('blog.status','=',0)
        ->orderBy('blog.id','asc')
        ->get();
    }
    static public function getBlog()
    {
        $return=self::select('blog.*');
        if(!empty(Request::get('search')))
        {
            $return =$return->where('blog.title' ,'like','%'.Request::get('search').'%');
        }
        $return=$return->where('blog.status','=',0)
        ->orderBy('blog.id','asc')
        ->paginate(20);
        return $return;
    }
    static public function getPopular()
    {
        return self::select('blog.*')
        ->where('blog.status','=',0)
        ->orderBy('blog.id','desc')
        ->limit(6)
        ->get();
    }
    static public function getRelatedPost($blog_category_id, $blog_id){
        return self::select('blog.*')
        ->where('blog.blog_category_id','=',$blog_category_id)
        ->where('blog.id','!=',$blog_id)
        ->where('blog.status','=',0)
        ->orderBy('blog.id','desc')
        ->limit(6)
        ->get();
    }
    public function getImage()
    {
        if(!empty($this->image_name) && file_exists(public_path('/upload/blog/'.$this->image_name)))
        {
            return url('/upload/blog/'.$this->image_name);
        }else{
            return '';
        }
    }
    public function getCategory()
    {
        return $this->belongsTo(BlogCategoryModel::class,'blog_category_id');
    }
    public static function getBlogByCategory($slug)
    {
        return self::select('blog.*')
        ->join('blog_category','blog_category.id','=','blog.blog_category_id')
        ->where('blog_category.slug','=',$slug)
        ->where('blog.status','=',0)
        ->orderBy('blog.id','desc')
        ->paginate(10);
    }
    static public function getRecordByHome()
    {
        return self::select('blog.*')
        ->orderBy('blog.id','desc')
        ->limit(3)
        ->get();
    }
}
