<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Storage;
use Image;
use App\Models\root\goods_sku;
use App\Models\root\goods_image;
use DB;
class goods extends Model
{
    protected $table = "goods";
    public $timestamps = false;
    protected $fillable  = ['goods_name','description','type1_id','type2_id','type3_id','brand_id','spu_price','cover'];  
    // 商品详情
    public static function getGoods($id){
        //  select b1.name as type1,b2.name as type2 ,b3.name as type3 from goods as a left join goods_type as b1 on a.type1_id = b1.id   
        //  left join goods_type as b2 on a.type2_id = b2.id
        //  left join goods_type as b3 on a.type3_id = b3.id where a.id = 49;
        return $goods = DB::table('goods')
                        ->select([  DB::raw('a.*'),DB::raw('b1.name as type1'),DB::raw('b2.name as type2'),DB::raw('b3.name as type3')])
                        ->from('goods as a')
                        ->leftJoin('goods_type as b1','a.type1_id','=','b1.id')
                        ->leftJoin('goods_type as b2','a.type2_id','=','b2.id')
                        ->leftJoin('goods_type as b3','a.type3_id','=','b3.id')
                        ->where('a.id',$id)
                        ->first();
    }
    // 获取商品
    public static function getAllList(){
        if(isset($_GET['type1_id'])){
            $data = goods::where('type1_id',$_GET['type1_id'])->paginate(20);
        }
        else if(isset($_GET['type2_id'])){
            $data = goods::where('type2_id',$_GET['type2_id'])->paginate(20);
        }
        else{
            $data = goods::where('type3_id',$_GET['type3_id'])->paginate(20);
        }
        return $data;
    }
    // 上传封面
    public static function uploadCoverImg($req,$id){
        if($req->has('cover')&&$req->cover->isValid()){
            $date = date('Y-m-d');
            $url = $req->file('cover')->store("/public/".$date. '/goods/cover');
            $path = $req->cover->path();
            $img = Image::make($path);
            $img->resize(214,242);
            $img->save(storage_path('app/'.$url));
            $url =  url('/').Storage::url($url);
            goods::where('id',$id)->update(['cover'=>$url]);
        }
    }
    // 添加商品sku
    public static function addGoodsSku($req,$id){
           $arr = $req->attr;
            for($i = 0;$i<count($arr);$i++){
                if($i%2!=0)
                {
                    $sku[$i]=$arr[$i-1].$arr[$i];
                }
            }
            sort($sku);
            $price = $req->price;
            $count = $req->count;
            for($i=0;$i<count($sku);$i++){
                goods_sku::insert(['goods_id'=>$id,'sku_attr'=>$sku[$i],'sku_price'=>$price[$i],'sku_num'=>$count[$i]]);
            }
    }
    // 上传商品图片 以及缩略图
    public static function uploadGoodsImg($req,$id){
        foreach($req->image as $k=>$v){
            if($req->has('image')&&$req->image[$k]->isValid()){
                $date = date('Y-m-d');
                $url = $req->file('image')[$k]->store("/public/".$date. '/goods/bigImg');
                $path = $req->image[$k]->path();
                Image::configure(array('driver'=>'gd'));
                $img  = Image::make($path);
                // 上传大图 等比列
                $img->resize(1200,null,function($c){
                    $c->aspectRatio();
                });
                $img->save(storage_path('app/'.$url));
                // 上传小图 等比列
                $img->resize(400,null,function($c){
                    $c->aspectRatio();
                });

                $smImg =  str_replace("public/".$date. '/goods/bigImg',"public/".$date. '/goods/smImg',$url);
                @mkdir(storage_path('app/'."public/".$date. '/goods/smImg'),0777,true);
           
                $img->save(storage_path('app/'.$smImg));
                goods_image::insert(['goods_id'=>$id,'small'=>$smImg,'big'=>$url]);
            }
        }
    }
}
