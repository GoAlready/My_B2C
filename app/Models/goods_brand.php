<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Storage;
class goods_brand extends Model
{
    //
    protected $table = "goods_brand";
    public $timestamps = false;
    protected $fillable  = ['brand_name','brand_logo','type3'];
    public static function getLogoUrl($req){
        if($req->has('brand_logo')&& $req->brand_logo->isValid()){
            $date = date('Ymd');
            $avatar = $req->file('brand_logo')->store("/public/". date("Y-m-d") . '/goods/logo');
            return $avatar;
        }
    }
}
