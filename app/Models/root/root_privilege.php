<?php

namespace App\Models\root;

use Illuminate\Database\Eloquent\Model;

class root_privilege extends Model
{
    //
    protected $table = "root_privilege";
    public $timestamps = false;
    protected $fillable = ['pri_name','path','parent_id'];
        //       二级分类
    public function  level2(){
        return $this->hasMany('App\Models\root\root_privilege','parent_id','id');
    }
//         取分类数据
    public static function getCategory(){
        return root_privilege::with('level2')->where('parent_id',0)->get(['id','pri_name'])->toArray();
    }
}
