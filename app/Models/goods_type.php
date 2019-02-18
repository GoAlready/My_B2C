<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class goods_type extends Model
{
        //
    protected $table = "goods_type";
    public $timestamps = false;
    protected $fillable  = ['name','pid'];  
            //       三级分类
    public function level3(){
        return $this->hasMany('App\Models\goods_type','pid','id');
    }
    //        二级分类
    public function  level2(){
        return $this->hasMany('App\Models\goods_type','pid','id')->with('level3');
    }
    //         取分类数据
    public static function  getCategory(){
        return goods_type::with('level2')->where('pid',0)->get(['id','name'])->toArray();
    }
    //         找到所属下级
    public static function delCate($id){
        return goods_type::with('level2')->where('pid',$id)->get(['id','name'])->toArray();
    }
}
