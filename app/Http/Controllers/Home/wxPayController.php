<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yansongda\Pay\Pay;
use App\Models\goods_orders;
use App\Models\home\goods_carts;
use App\Models\root\goods_sku;
use App\Models\goods_orders_goods;
use DB;

class wxPayController extends Controller
{
    // 支付账号：hgnvpu3964@sandbox.com

    protected $config = [
        'app_id' => 'wx426b3015555a46be', // 公众号 APPID
        'mch_id' => '1900009851',
        'key' => '8934e7d15453e97507ef794cf7b0519d',
        // 通知的地址
        'notify_url' => 'http://mamn4q.natappfree.cc/home/notify',
    ];

    // 调用微信接口进行支付
    public function pay($sn,$money)
    {
        $data = goods_orders::where('order_code',$sn)->first();
        // dd($data['order_status']);
        if($data['order_status'] == 0)
        {
            // 调用微信接口
            $ret = Pay::wechat($this->config)->scan([
                'out_trade_no' => $sn,
                'total_fee' => $money * 100, // 单位：分
                'body' => '支付金额:'.$money.'元',
            ]);

            if($ret->return_code == 'SUCCESS' && $ret->result_code == 'SUCCESS')
            {
                return $ret->code_url;
            }
        }
        else
        {
           file_put_contents("wxpay/notify.json",$e->getMessage());
        }
    }

    public function notify()
    {
        $pay = Pay::wechat($this->config);
        try{
            $data = $pay->verify(); // 是的，验签就这么简单！
            // $log->log('验证成功，接收的数据是：' . file_get_contents('php://input'));
            if($data->result_code == 'SUCCESS' && $data->return_code == 'SUCCESS') 
            {
                DB::beginTransaction();
                $one = goods_orders::where('order_code',$data->out_trade_no)->update(['order_status'=>1]);
                $goods = goods_orders_goods::where("order_code",$data->out_trade_no)->get();
                $length = 0;
                $totalLength = count($goods);
                foreach($goods as $v){
                    $two = goods_sku::where('id',$v['sku_id'])->decrement('sku_num',$v['sku_num']);
                    if($two){
                        $length++;
                    }
                }
                if($one&&$length==$totalLength){
                        DB::commit();
                        $cart = goods_orders::select('cart_id')->where('order_code',$data->out_trade_no)->where('user_id',session('user_id'))->first();
                        $id = explode(',',$cart);
                        $three = goods_carts::whereIn('id',$id)->delete();
                }else{
                        DB::rollBack();
                }
            }
        } 
        catch (Exception $e) {
             return redirect()->route('order_fail');
        }
        
        $pay->success()->send();
    }
}
