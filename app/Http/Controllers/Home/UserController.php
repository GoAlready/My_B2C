<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use DB;
use App\Models\user;
use App\libs\Snowflake;
use App\Models\goods;
use App\Models\goods_orders;
use App\Models\goods_orders_goods;
use App\Models\home\address;
use App\Models\root\goods_sku;
use App\Models\home\home_job;
use App\Models\home\goods_carts;
class UserController extends Controller
{
    // public function test(){
    //             $data = 279990031244849152;
    //             DB::beginTransaction();
    //             $one = goods_orders::where('order_code',$data)->update(['order_status'=>1]);
    //             $goods = goods_orders_goods::where("order_code",$data)->get();
    //             $length = 0;
    //             $totalLength = count($goods);
    //             foreach($goods as $v){
    //                 $two = goods_sku::where('id',$v['sku_id'])->decrement('sku_num',$v['sku_num']);
    //                 if($two){
    //                     $length++;
    //                 }
    //             }
    //             if($one&&$length==$totalLength){
    //                     DB::commit();
    //                      $cart = goods_orders::select('cart_id')->where('order_code',$data)->where('user_id',session('user_id'))->first();
    //                     $id = explode(',',$cart['cart_id']);
    //                     $three = goods_carts::whereIn('id',$id)->delete();
    //             }else{
    //                     DB::rollBack();
    //             }
    // }
    // 提交订单
    public function pay(){
        if(!isset($_GET['order_code'])){
            $flake = new Snowflake(1023);
            $code = $flake->nextId();
            $id = explode(',',$_GET['id']);
            $pay = $_GET['pay'];
            $goods = goods_carts::whereIn('id',$id)->get();
            $total_money=0;
            $ress_id = address::select('id')->where('user_id',session('user_id'))->where('default',1)->first();
            foreach($goods as $v){
                $total_money+=$v['sku_price']*(int)$v['sku_num'];
            }
            $order_id = goods_orders::insertGetId(['order_code'=>$code,'user_id'=>session('user_id'),'total_money'=>$total_money,'pay_type'=>$pay,'resses_id'=>$ress_id['id'],'cart_id'=>$_GET['id']]);
            foreach ($goods as $key => $value) {
                goods_orders_goods::insert([
                    'order_code'=>$code,
                    'order_id'=>$order_id,
                    'goods_id'=>$value['goods_id'],
                    'sku_id'=>$value['sku_id'],
                    'sku_num'=>$value['sku_num'],
                    'sku_name'=>$value['goods_sku'],
                    'goods_name'=>$value['goods_name'],
                    'goods_cover'=>$value['goods_cover'],
                    'sku_price'=>$value['sku_price']]);
            }
            $order = goods_orders::select('order_code','total_money')->where('id',$order_id)->where('user_id',session('user_id'))->first();
        }else{
            $code = $_GET['order_code'];
            $pay = $_GET['pay'];
            $order = goods_orders::select('order_code','total_money')->where('order_code',$code)->where('user_id',session('user_id'))->first();
            $total_money = $order['total_money'];
        }
        
        if($pay==0){
            $wx = new wxPayController;
            $erweima = $wx->pay($code,$total_money);
                return view("home.users.pay",[
                'order'=>$order,
                'code'=>$erweima,
            ]);
        }else{
            $alipay = new zfbPayController();
            return $alipay->pay($code,$total_money);
        }
    }

    public function get_order_status(){
        $codes = $_GET['code'];
        $is = goods_orders::where('order_status',1)->where('order_code',$codes)->count();
        if($is){
            return json_encode([
                'data'=>1
            ]);
        }else{
             return json_encode([
                'data'=>false
            ]);
        }
    }

    // 支付成功!
    public function order_success(){
        $money = $_GET['money'];
        $type = $_GET['type'];
        return view('home.goods.paysuccess',[
            'money'=>$money,
            'type'=>$type
        ]);
    }
    // 支付失败
    public function order_fail(){
        return view('home.goods.payfail');
    }


        // 个人主页
    public function user(){
        $orders = goods_orders::where('user_id',session('user_id'))->orderBy('id','desc')->get();
        foreach ($orders as $k => $v) {
            $code  = goods_orders_goods::where('order_code',$v['order_code'])->get();
            $orders[$k]['goods'] = $code;
        }
        return view('home.users.user',[
            'orders'=>$orders
        ]);
    }

    // 订单中心
        // 待付款
    public function order_pay(){
        return view('home.users.order_pay');
    }
        // 待发货
    public function order_send(){
        return view('home.users.order_send');
    }
        // 待收货
    public function order_receive(){
        return view('home.users.order_receive');
    }
        // 待评价
    public function order_evaluate(){
        return view('home.users.order_evaluate');
    }

    // 我的中心
        // 我的收藏
    public function person_collect(){
        return view('home.users.person_collect');
    }
        // 我的足迹
    public function person_footmark(){
        return view('home.users.person_footmark');
    }

     // 设置项
        // 个人信息
    public function setting_info(){
        $user = user::find(session('id'));
        $job = home_job::get();
        return view('home.users.setting_info',[
            'job'=>$job,
            'user'=>$user
        ]);
    }
    // 用户信息
    public function userInfo(Request $req){
        $id = session('id');
        $user = user::find($id);
        $user->fill($req->all());
        if($req->hasFIle('headImg')){
            $img  = user::img($req);
            session(['user_headImg'=>$img]);
            $user->headImg = $img;
        }
        $user->save();
        return redirect()->route('setting_info');
    }
        // 地址管理
    public function setting_address(){
        $data = address::get();
        return view('home.users.setting_address',[
            'data'=>$data
        ]);
    }
        // 添加地址
    public function doAdd_address(Request $req){
        address::create($req->all());
        return redirect()->route('setting_address');
    }
    // 删除地址
    public function del_address(){
        address::destroy($_GET['id']);
        echo json_encode(['data'=>1]);
    }
    // 设置默认地址
    public function initAddress(){
        $id = $_GET['id'];
        address::where('default',1)
            ->update(['default'=>0]);
        address::where('id',$id)
                ->update(['default'=>1]);
        // return redirect()->route('setting_address');
        return back();
    }
        // 安全管理
    public function setting_safe(){
        return view('home.users.setting_safe');
    }
    // 修改密码
    public function passwordEdit(Request $req){
        $req->validate(
            [
            'password'=>'required|min:6|unique:user,password|confirmed']
        ,   [
            'password.required'=>'密码不能为空',
            'password.min'=>'密码长度不能少于六个字符',
            'password.unique'=>'密码不能于近期相同',
            'password.confirmed'=>'两次密码输出有误'
            ]);
        $password = $req->password;
        user::where('id',session('id'))
            ->update([
                'password'=>Hash::make($password)
            ]);
        return redirect()->route('successPass');
    }
    // successPass
    public function successPass(){
        return view("home.users.successPass");
    }
    // 购物车
    public function cart(){
        $sku = goods_carts::get();
        return view("home.users.cart",[
            'sku'=>$sku
        ]);
    }
    // 删除购物车
    public function delCart(){
        $id = $_GET['id'];
        goods_carts::destroy($id);
    }
    // ajax add 修改数量
    public function add_sku_num(){
        $id = $_GET['id'];
        goods_carts::where('id',$id)->increment('sku_num');
    }
     // ajax jian修改数量
    public function jian_sku_num(){
        $id = $_GET['id'];
        goods_carts::where('id',$id)->decrement('sku_num');
    }
    // 结算页
    public function getOrderInfo(){
        $cart_id = $_GET['id'];
        $id = explode(',',$cart_id);
        $carts = goods_carts::whereIn('id',$id)->get();
        foreach ($carts as $key => $value) {
           $cover = goods::select('cover')->where('id',$value['goods_id'])->first();
           $sku = goods_sku::select('sku_num')->where('id',$value['sku_id'])->first();
           $carts[$key]['cover'] = $cover['cover'];
            $carts[$key]['sku_sku_num'] = $sku['sku_num'];
        }
        $ress = address::where('user_id',session('user_id'))->get();
        return view("home.users.getOrderInfo",[
            'ress'=>$ress,
            'carts'=>$carts,
            'id'=>$_GET['id']
        ]); 
    }
 
  
}
