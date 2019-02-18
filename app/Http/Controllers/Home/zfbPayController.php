<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yansongda\Pay\Pay;
use Yansongda\Pay\Log;
use App\Models\goods_orders;
use App\Models\home\goods_carts;
use App\Models\root\goods_sku;
use App\Models\goods_orders_goods;
use DB;
class zfbPayController extends Controller
{
    
    // 支付账号： hgnvpu3964@sandbox.com
    // 配置 
    public $config = [
        'app_id' => '2016091600527626',
        // 支付宝公钥
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAzcDiUmAFgiaBi2PzVpP+GdyPNLQuja3B26Z/3tcDDiuWbndLaA4o45J+Xj6KZ2GgQpZe5a9ZGoasas7YLGxPA5Z91eTooqmVwfPsaTUx4JHJlhiS+3R4738kA7BCXvmVKAHjG52ExwjwM4XWh+zN0jldPaS+4EtZnCrciDQtUk7IU7hbjDwqe6mUzwpI0zgyGQ0CPvug1VJBLdRgOlIaGNwVn1WbwqkrXYkHXMKHZhgT/WF4UTr+X4TpFIyA24ZVl2BtLchvFvf9C0+Ui8pWjfxjD6uE1VHtVQNEJ4MIaisfXpDMgQgkqClYDQN/udub7mq/CQUGsm9ZN5SUJEUXLwIDAQAB',
        // 商户应用密钥
        'private_key' => 'MIIEpAIBAAKCAQEAuoy1DMW1bDvNQc7CZOALVRERL+wcVV3UhbP59ICtpBx+zGiEsDuOmAFAcEPDwGNk4NhXdAkN9n/1jGiSZaKwfkBNU3tmyuYVLH0shgGzWL/S4XG51EwonUH2a6rVaI2OaiAjUXcYPfxbnpo/52PwiF8B/bfezUp+G6pjC0UbxruO2tE8nyfCq0cz1qYNGBulmECPyG5y69ECtiwVvw/+cK3rm+lxlSCUXp5cqB+HaGgd+trXLOJxZONd/fPkmKEts1pllCkTsDTxT77O0ZLtM5+D1e7VE68OMiIQvNRyl1p+HNQjsUNVX62cNfRb3cjtET5wqUT56AOeJgl9qVDDFwIDAQABAoIBAQCoy9C2sd6rBKGBPjifVipq2nqWxioNBE3cfTFaj2SO7km9Y4VMgVdRKzDHZEmnt0f8O0VGdTrxJG9mkOiGlmLkmgJd23bzeKUIEGtNBhTl5QxHecQP2KmXQaxbV8SqSgvm8xWCDSUeUU4FgMT59nAatPz0On+beiAJoG7mL64mbtuW8YsUB0wIFhTwe1T1+Q9qTO+YEh4ejteXZc1flGahjGDJbzCWwErmMILAAopiNaLNDcgx3AXeqf+ddP6jK32MikXhddYSDogX7/BXIMkOg7co5gXCG/aXMueMKsuR2wWC+pUZfxl7VBM8IEBfR8ptq9DIE8QcfMWYml4qpPNhAoGBAOZ0twlxxPGthlJ1q1EWdUy6qGD/yzHvVY0TEW4dXTJNqBv4GyF0sQktDRG0FCQtqk1lzbOHcbsEz737xwn9EpuJGWqFB4gy3Z1e77Dr5qM6bXScm5HSPX7MfC99H6cu4uxogrGLqlgE/S7OO0bNFEU4nFNcaASqZjcH9C82P1FTAoGBAM86If8Sk1tYm/TqT8p9IB2ww8+mNwZo7AVrTgYvmampRPfDX0UrmrlkdZLJVbdxYLNexmu+AwsvS3XXknWNyPf6UXqELPYNO9y+0VNusNRl03UabW4Czf5QWZPSlC0bu8xbBjVUA3O761XMfBbPtS7/X41wn3/4w1T2eGVyPjqtAoGAOMiBYR5bPIFZG3BK6gvykxla66ubUY57MeuE2/D4SbDAv0N+y9uI0436LmaEn/VwhOmUqaux5jblSRaEkH1+3DwHuytUE8cUu/XscVdu2MFIvvbnjiKTbG7OGpVl+zeeSknmCgEz08RG7gV6rZNSb0vnmNKn/p5N2TlofUmMiGkCgYApXKgWeoWxEOGoI/CjMRBs/LBIzRtkiyK4/i8Hqw6Xv7KFZZipfMeYQ4X4M3mJcPblNoCSVs3SuLDuJ4YTMqavYGZM9v7macPODsRHS+u9qUlosUqwT50AKteGWty6mDOG2ZBGqqs5uYOCj5shDnpSlCRlXdpoN6X9Wmizjvb+zQKBgQCJl5ppVH363lV6cY1dVY80oEfLHBaiMom3O/N5WcDe6G4rulBvJYtZeTF2A/EoYozsPz25MrtEFCwvluNFoH36U6hg5HL8HiXYdbp442KY/GMWLYJsSpWo737fmU5hlSqrqzOYy+ukGX/toKgBAMC72UY2S4Z5gaywlUA9GiNPHg==',
        // 通知地址
        // 'notify_url' => 'http://requestbin.fullcontact.com/1hutj9g1',
        'notify_url' => 'http://mamn4q.natappfree.cc/alipay/notify',
        // 跳回地址
        'return_url' => 'http://mamn4q.natappfree.cc/home/alipay/return',
        // 沙箱模式（可选）
        'mode' => 'dev',
    ];

    // 支付
    public function pay($trade_no,$total_money)
    {
        $order = [
            'out_trade_no' => $trade_no,
            'total_amount' => $total_money,
            'subject' => '品优购购买商品需付费 ：'.$total_money.'元',
        ];
        
        $alipay = Pay::alipay($this->config)->web($order);
        return $alipay;
    }


    // 同步回调
    public function return()
    {
        // $data = Pay::alipay($this->config)->verify(); // 是的，验签就这么简单！
        // $status = goods_orders::where('order_code',$data->out_trade_no)->select('order_status')->first();
        // while (!$status) {
        //     echo "等待中~";
        // }
        // // 支付成功的逻辑代码
        // return "支付成功";

        $data = Pay::alipay($this->config)->verify(); // 是的，验签就这么简单！
        $status = goods_orders::where('order_code',$data->out_trade_no)->select('order_status','total_money')->first();
        // 支付成功的逻辑代码
        return view('home.goods.paysuccess',[
            'money'=>$status['total_money'],
            'type'=>1
        ]);
    }

    // 异步回调
    public function notify()
    {
        $alipay = Pay::alipay($this->config);
        try{
            $data = $alipay->verify(); // 是的，验签就这么简单！\
            // 判断支付状态
            if($data->trade_status = "TRADE_SUCCESS" || $data->trade_status = "TRADE_FINISHED")
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
        } catch (Exception $e) {
            file_put_contents("alipay/notify.json",$e->getMessage());
        }

        return $alipay->success();// laravel 框架中请直接 `return $alipay->success()`
    }

}
