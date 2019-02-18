<?php

namespace App\Http\Controllers\Root;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\rootLoginRequest;
use App\Models\root\root;
use App\Models\root\root_root_role;
use Hash;//哈希 
use DB;
use App\Models\root\catagory;

class indexController extends Controller
{
    
    // 登录 
    public function login(){
       return  view('root.index.login');
    }
    // 主页
    public function rootIndex(){
        return view("root.index.index");
    }
    // 个人主页
    public function rootHome(){
        return view("root.index.home");
    }
   
    // 图片管理
        // 广告管理
        public function advertising(){
             return view("root.image.advertising");
        }
        // 分类管理
        public function Sort_ads(){
             return view("root.image.Sort_ads");
        }
    
    // 交易管理
        // 交易信息
        public function transaction(){
             return view("root.order.transaction");
        }
        // 交易订单
        public function Order_Chart(){
             return view("root.order.Order_Chart");
        }
        // 订单管理
        public function Orderform(){
             return view("root.order.Orderform");
        }
        // 订单管理
        public function order_detailed(){
             return view("root.order.order_detailed");
        }
        // 交易金额
        public function Amounts(){
             return view("root.order.Amounts");
        }
        // 订单处理
        public function Order_handling(){
             return view("root.order.Order_handling");
        }
        // 退款管理
        public function Refund(){
             return view("root.order.Refund");
        }
        // 退款详情
        public function Refund_detailed(){
             return view("root.order.Refund_detailed");
        }

    // 支付管理
        // 账户管理
        public function Cover_management(){
             return view("root.pay.Cover_management");
        }
        // 账户详情
        public function userinfo(){
             return view("root.pay.userinfo");
        }
        // 支付方式
        public function payment_method(){
             return view("root.pay.payment_method");
        }
        // 支付配置
        public function Payment_Configure(){
             return view("root.pay.Payment_Configure");
        }

   

    // 店铺管理
        // 店铺列表
        public function Shop_list(){
             return view("root.shop.Shop_list");
        }
        // 店铺审核
        public function Shops_Audit(){
             return view("root.shop.Shops_Audit");
        }
        // 审核详情
        public function shopping_detailed(){
             return view("root.shop.shopping_detailed");
        }

    // 消息管理
        // 留言列表
        public function Guestbook(){
             return view("root.news.Guestbook");
        }
        // 意见反馈
        public function Feedback(){
             return view("root.news.Feedback");
        }

    // 系统管理
        // 系统设置
        public function Systems(){
             return view("root.setup.Systems");
        }
        // 系统栏目管理
        public function System_section(){
             return view("root.setup.System_section");
        }
        // 系统日志
        public function System_Logs(){
             return view("root.setup.System_Logs");
        }

    
    // 登录表单 
    public function rootDoLogin(rootLoginRequest $req){
        $phone = $req->phone;
        $user = root::where('name',$req->name)->first();
        $captcha = $req->session()->pull('captcha');
        if($req->captcha==' '||$captcha!=$req->captcha){
            return back()->withInput()->withErrors(['captcha'=>'验证码出入错误']);
        }
        if($user){
            if(Hash::check($req->password,$user->password)){
                session()->flush();
                session([
                    'id'=>$user->id,
                    'name'=>$user->name,
                    'is_business'=>$user->is_business
                ]);
                $root = root_root_role::where('role_id',1)->where('root_id',$user->id)->count();
                    if($root>0){
                        session(['root'=>true]);
                    }else{
                        $path =root::getPath($user->id);
                        $role =root_root_role::where('root_id',$user->id)->first();
                        $role = $role['role_id'];
                        session(['path'=>$path,'role'=>$role]);
                       
                    }
                return redirect()->route('rootIndex');
            }else{
                return back()->withInput()->withErrors(['password'=>"密码输出错误"]);
            }
        }else{
            return back()->withInput()->withErrors(['name'=>'账户名不存在']);
        }
    }


}
