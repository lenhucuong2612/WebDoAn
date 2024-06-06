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
        ->where('blog.is_delete','=',0)
        ->where('blog.status','=',0)
        ->first();
    }
    static public function getRecord()
    {
        return self::select('blog.*')
        ->where('blog.is_delete','=',0)
        ->orderBy('blog.id','desc')
        ->paginate(20);
    }
    static public function getRecordActive()
    {
        return self::select('blog.*')
        ->where('blog.is_delete','=',0)
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
        $return=$return->where('blog.is_delete','=',0)
        ->where('blog.status','=',0)
        ->orderBy('blog.id','asc')
        ->paginate(20);
        return $return;
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
}
