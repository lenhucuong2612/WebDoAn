<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSettingModel extends Model
{
    use HasFactory;
    protected $table='system_setting';
    static public function getSingle()
    {
        return self::find(1);
    }
    public function getLogo(){
        if(!empty($this->logo)&&file_exists(public_path('/upload/setting/'.$this->logo))){
            return url('/upload/setting/'.$this->logo);
        }else{
            return "";
        }
    }
    public function getFevicon(){
        if(!empty($this->fevicon)&&file_exists(public_path('/upload/setting/'.$this->fevicon))){
            return url('/upload/setting/'.$this->fevicon);
        }else{
            return "";
        }
    }
    public function getFooterpayment(){
        if(!empty($this->footer_payment_icon)&&file_exists(public_path('/upload/setting/'.$this->footer_payment_icon))){
            return url('/upload/setting/'.$this->footer_payment_icon);
        }else{
            return "";
        }
    }
}
