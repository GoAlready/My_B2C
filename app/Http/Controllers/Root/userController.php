<?php

namespace App\Http\Controllers\Root;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\user;
class userController extends Controller
{
     // 会员管理
        // 会员列表
        public function user_list(){
            $user = user::get();
            foreach($user as $k=>$v){
                $user[$k]['lv'] = $this->lv($v['score']);
            }
            return view("root.user.user_list",[
                 'user'=>$user
             ]);
        }
        public function lv($data){
            if($data>=0&&$data<100){
                return "青铜会员";
            }
            if($data>100&&$data<200){
                return "白银会员";
            }
            if($data>200&&$data<300){
                return "黄金会员";
            }
            if($data>300&&$data<400){
                return "铂金会员";
            }
            if($data>400&&$data<500){
                return "钻石会员";
            }
            if($data>500&&$data<600){
                return "王者会员";
            }
            if($data>600){
                return "荣耀会员";
            }
        }
        public function addUser(Request $req){
            $data = $req->all();
            user::addUser($data);
            return redirect()->route('user_list');
        }
        // 删除用户
        public function delUser(){
            $id = $_GET['id'];
            user::destroy($id);
        }
        // 禁用用户 解禁
        public function disable(){
            $id = $_GET['id'];
            $dis = $_GET['dis'];
            if($dis==1){
                user::where('id',$id)
                    ->update(['Disable'=>1]);
            }else{
                user::where('id',$id)
                    ->update(['Disable'=>0]);
            }
        }
        // 修改
        public function editUser(){
           $data = user::find($_GET['id']);
            echo json_encode([
                'data'=>$data
            ]);
        }
        public function editToUser(Request $req){
            $id = $_GET['id'];
            user::editUser($id,$req);
            return redirect()->route('user_list');
        }
        // 会员详情
        public function member_show(){
            return view("root.user.member_show");
        }
        // 等级管理
        public function member_Grading(){
            return view("root.user.member_Grading");
        }
        // 会员记录管理}
        public function integration(){
            return view("root.user.integration");
        }
}
