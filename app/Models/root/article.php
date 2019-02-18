<?php

namespace App\Models\root;

use Illuminate\Database\Eloquent\Model;

class article extends Model
{
    //
    protected $table = "article";
    public $timestamps = false;
    protected $fillable  = ['title','contents','cat_id','article_introduce'];
    public function article_type(){
        return $this->belongsTo('App\Models\article_type','cat_id');
    }
    // 分页搜索排序
    public  static function getAll($id,$req){
        if($id==0){
             $data = article::with('article_type');
            if(isset($req->feach)){
                $data->where(function($q) use($req){
                    $q->where('article_introduce','like',"%$req->feach%")
                    ->orwhere('title','like',"%$req->feach%");
                });
            }
                $data->orderBy('created_at',$req->ob);
                $data = $data->paginate(3);
        }else {
            $data = article::where('cat_id',$id);
            $data ->with('article_type');
            if(isset($req->feach)){ 
                $data->where(function($q) use($req){
                    $q->where('article_introduce','like',"%$req->feach%")
                    ->orwhere('title','like',"%$req->feach%");
                });
            }
                $data->orderBy('created_at',$req->od);
                $data = $data->paginate(3);
        }
        return $data;
    }
    // 获取文章数量
    public static function getNum(){
        return $data = article::get();
    }
    //  修改文章
    public static function articleEdit($id,$req){
        $article = article::find($id);
        $article->fill($req);
        return $article->save();
         
    }
}
