<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //
    public function index(){
        return view('admin.index.index');
    }
    // public function login(){
    //     return view('admin.index.index');
    // }
    // 右侧home
    public function home(){
        return view('admin.index.home');
    }
    // 商品
    public function goods(){
        return view('admin.index.goods');
    }
    // 商品修改
    public function goods_edit(){
        return view('admin.index.goods_edit');
    }
    // 修改密码
    public function password(){
        return view('admin.index.password');
    }
    // 成为商家填写的表单
    public function seller(){
        return view('admin.index.seller');
    }
  
 
}
