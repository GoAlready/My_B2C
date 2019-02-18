<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\goods;
use App\Models\goods_brand;
use App\Models\goods_sku_attr;
use App\Models\root\goods_image;
use App\Models\root\goods_sku;
use App\Models\home\goods_carts;
class GoodsController extends Controller
{
    // search
    public function search(Request $req){
        $data = goods::getAllList();
        return view('home.index.search',[
            'data'=>$data,
            'req'=>$req
        ]);
    }
    // goods
    public function goods(){
        $id = $_GET['id'];
        $goods = goods::getGoods($id);
        $image = goods_image::where('goods_id',$id)->get();
        $attr = goods_sku_attr::getAttr($id);
        return view('home.goods.item',[
            'goods'=>$goods,
            'image'=>$image,
            'attr'=>$attr
        ]);
    }
    // ajax获取商品sku信息
    public function getGoodsSku(){
        $sku = $_GET['sku'];
        $id = $_GET['id'];
        $sku = goods_sku::where('sku_attr',$sku)->where('goods_id',$id)->first();
        return json_encode($sku);
    }
    // 添加购物车
    public function addCart(Request $req){
        $data = $req->sku;
        $cart = explode(',',$data);
            $is_set = goods_carts::where('goods_id',$cart[1])->where('goods_sku',$cart[0])->where('sku_id',$cart[2])->where('user_id',session("user_id"))->first();
            // 判断是否存在原有商品
            $sku_num = goods_sku::select('sku_num')->where('id',$cart[2])->first();
            if($is_set){
                // 添加数量
                     goods_carts::where('id',$is_set['id'])->increment('sku_num',$req->num);
            }else{
                 // 新的购物车
                $goods = goods::select('id','goods_name','cover')->where('id',$cart[1])->first();
                goods_carts::insert(['goods_sku_num'=>$sku_num['sku_num'],'goods_sku'=>$cart[0],'goods_id'=>$cart[1],'sku_id'=>$cart[2],'sku_price'=>$cart[3],'goods_cover'=>$goods['cover'],'goods_name'=>$goods['goods_name'],'sku_num'=>$req->num,'user_id'=>session('user_id')]);
            }
        return redirect()->route('cart');
    }
}
