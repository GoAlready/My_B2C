<?php

namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\rigesterRequest;
use App\Http\Requests\loginRequest;
use Flc\Dysms\Client;
use Hash;//哈希  
use Flc\Dysms\Request\SendSms;
use Illuminate\Support\Facades\Cache;
use App\Models\user;
use App\Models\goods_type;
class IndexController extends Controller
{
   

    public function index(){
        $type = goods_type::getCategory();
        return view('home.index.index',[
            'type'=>$type
        ]);
    }
    // 登录
    public function login(){
        return view('home.index.login');
    }
    // 退出登录
    public function logout(){
        session()->flush();
        return redirect()->route('login');
    }


    // 登录表单 
    public function doLogin(loginRequest $req){
        $user = user::where('name',$req->name)->where('Disable',0)->first();
        if($user){
            if(Hash::check($req->password,$user->password)){
                Cache::forget($req->name);
                session([
                    'user_id'=>$user->id,
                    'user_name'=>$user->name,
                    'useris_business'=>$user->is_business,
                    'user_headImg'=>$user->headImg ? : null,
                    'user_nicheng'=>$user->nicheng ? : null
                ]);
                return redirect()->route('index');
            }else{
               if(Cache::has($req->name))
               {
                   if(Cache::get($req->name) >= 3)
                        return back()->withInput()->withErrors(['password'=>"你已经输错三次密码了,请一个小时以后再来"]);
                    else{
                        Cache::put($req->name,Cache::get($req->name) -0+1,100);
                    }
               }else {
                   Cache::put($req->name,1,100);
               }
                return back()->withInput()->withErrors(['password'=>"密码输错".Cache::get($req->name)."次啦"]);
            }
        }else{
            return back()->withInput()->withErrors(['name'=>'账户名不存在或已被冻结']);
        }
    }
    // 注册
    public function register(){
        return view('home.index.register');
    }
    // 注册表单
    public function doRegister(rigesterRequest $req){
        $data = $req->all();
        $name = $req->phone;
        $code = Cache::get($name);
        if(!$code||$code!=$req->validata){
            return back()->withInput()->withErrors(['validata'=>'验证码输入错误']);
        }
        user::addUser($data);
        return redirect()->route('login');
    }
    // 找回密码
    public function retPassword(){
        return view('home.index.retPassword');
    }
    // 找回密码表单
    public function doRetPassword(Request $req){
          if(!$req->name){
             return ;
            }
        $user = user::where('name',$req->name)->first();
        $code = Cache::get($user->phone);
        if(!$code||$code!=$req->validata){
            return back()->withInput()->withErrors(['validata'=>'验证码输入错误']);
        }
        session([
                    'name'=>$req->name,
                ]);
       return redirect()->route('modifyPass');
    }
    // 修改密码
    public function modifyPass(){
         return view("home.index.doRetPassword");
    }
    // 修改密码表单
    public function modifyPassword(Request $req){
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
        $name = $req->session()->pull('name');
        user::where('name',$name)
            ->update([
                'password'=>Hash::make($password)
            ]);
        return redirect()->route('login');
    }
    // ajax找回密码发送短信
    public function ajaxRetPassword(){
        $name = $_GET['name'];
        $user = user::where('name',$name)->first();
        if($user){
            $this->getSms($user['phone']);
        }else{
             return back()->withInput()->withErrors(['name'=>'用户名不存在']);
        }
    }
    // ajax获取短信验证 存入缓存
    public function cache(Request $req){
       $name = $req->phone;
       if(!$name){
           echo json_encode([
                 'error'=>true,
             ]);
             die;
       }
        $code = rand(100000,999999);
        $user = Cache::get($name);
        if(isset($user)){
             echo json_encode([
                 'error'=>true,
             ]);
             die;
        }
        Cache::put($name,$code,10);
        $config = [
            'accessKeyId'    => 'LTAIlY6JCxNR9oyV',
            'accessKeySecret' => 'hLOg6TowmNHibhgEhSQsqEOe4QSogY',
        ];
       $client  = new Client($config);
       $sendSms = new SendSms;
       $sendSms->setPhoneNumbers($name);
       $sendSms->setSignName('全栈sns');
       $sendSms->setTemplateCode('SMS_148614187');
       $sendSms->setTemplateParam(['code' => $code]);
       $client->execute($sendSms);
       echo json_encode([
                 'success'=>true,
             ]);
             die;
    }
    // 找回密码短信发送
    public function getSms($phone){
        $code = rand(100000,999999);
        $user = Cache::get($phone);
        if(isset($user)){
             echo json_encode([
                 'error'=>true,
             ]);die;
        }
        Cache::put($phone,$code,10);
        $config = [
            'accessKeyId'    => 'LTAIlY6JCxNR9oyV',
            'accessKeySecret' => 'hLOg6TowmNHibhgEhSQsqEOe4QSogY',
        ];
       $client  = new Client($config);
       $sendSms = new SendSms;
       $sendSms->setPhoneNumbers($phone);
       $sendSms->setSignName('全栈sns');
       $sendSms->setTemplateCode('SMS_148614187');
       $sendSms->setTemplateParam(['code' => $code]);
       $client->execute($sendSms);
    }
}
