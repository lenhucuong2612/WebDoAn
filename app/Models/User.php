<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Request;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    static public function getAdmin(){
        return User::select("users.*")
        ->whereIn('is_admin',[1,2])
        ->orderBy('id','desc')
        ->get();
    }
    static public function getSingle($id){
        return User::find($id);
    }
    static public function checkEmail($email){
        return User::select('users.*')
        ->where('email','=',$email)
        ->first();
    }
    static public function getTotalUser(){
        return self::select('id')
        ->where('is_admin','=',0)
        ->count();
    }
    static public function getTotalTodaylUser(){
        return self::select('id')
        ->where('is_admin','=',0)
        ->where('created_at','=',date('Y-m-d'))
        ->count();
    }
    static public function getTotalCustomerMonth($start_date,$end_date){
        return self::select('id')
        ->where('is_admin','=',0)
        ->whereDate('created_at','>=',$start_date)
        ->whereDate('created_at','<=',$end_date)
        ->count();
    }
    static public function getCustomer()
    {
        $return= User::select("users.*");
        if(!empty(Request::get('id'))){
            $return =$return->where('id','=',Request::get('id'));
        }
        if(!empty(Request::get('name'))){
            $return =$return->where('name','like','%'.Request::get('name').'%');
        }
        if(!empty(Request::get('email'))){
            $return =$return->where('email','=',Request::get('email'));
        }
        if(!empty(Request::get('from_date'))){
            $return =$return->where('created_at','>=',Request::get('id'));
        }
        if(!empty(Request::get('to_date'))){
            $return =$return->where('created_at','<=',Request::get('name'));
        }
        $return=$return->where(['is_admin'=>0])
        ->orderBy('id','desc')
        ->paginate(2);
        
        return $return;
    }
}
