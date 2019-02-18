<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class goods_sku_attr extends Model
{
    //
    protected $table = "goods_sku_attr";
    public $timestamps = false;
    protected $fillable  = ['attr','goods_id'];
    public function level2(){
        return $this->hasMany('App\Models\goods_sku_attr','pid','id');
    }
    public static function getAttr($id){
       return goods_sku_attr::with('level2')->where('pid',0)->where('goods_id',$id)->get(['id','attr'])->toArray();
    }
    // 增加商品属性以及属性值
    public static function addAttr($req,$id){
         $data = array_unique($req->attr);
            $color = [];
            $size = [];
            foreach($data as $v){
                if(strstr($v,"颜色")){
                    $color[]= $v;
                }else{
                    $size[] = $v;
                }
            }
        $colorId = goods_sku_attr::insertGetId(['attr'=>'颜色','pid'=>0,'goods_id'=>$id]);
        $sizeId = goods_sku_attr::insertGetId(['attr'=>'尺寸','pid'=>0,'goods_id'=>$id]);
        foreach($color as $v){
            goods_sku_attr::insert(['attr'=>$v,'pid'=>$colorId,'goods_id'=>$id]);
        }
        foreach($size as $v){
            goods_sku_attr::insert(['attr'=>$v,'pid'=>$sizeId,'goods_id'=>$id]);
        }
    }
}
