<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// 首页显示  
Route::get("/",'Home\IndexController@index')->name("index");
// 前台分组        路径前缀               命名空间
Route::group(['prefix' => 'home','namespace' => 'Home',], function (){
    // 登录
    Route::get("/login",'IndexController@login')->name("login");
    // 注册表单
    Route::post("/doLogin",'IndexController@doLogin')->name("doLogin");
    // 注册
    Route::get("/register",'IndexController@register')->name("register");
    // 注册表单
    Route::post("/doRegister",'IndexController@doRegister')->name("doRegister");
    // ajax
    Route::get("/cache",'IndexController@cache')->name("cache");
    // 找回密码
    Route::get("/retPassword",'IndexController@retPassword')->name("retPassword");
    // 找回密码ajax
    Route::get("/ajaxRetPassword",'IndexController@ajaxRetPassword')->name("ajaxRetPassword");
    // 找回密码 校验验证码
    Route::post("/doRetPassword",'IndexController@doRetPassword')->name("doRetPassword");
    // 修改密码页面
    Route::get("/modifyPass",'IndexController@modifyPass')->name("modifyPass");
    // 修改密码表单
    Route::post("/modifyPassword",'IndexController@modifyPassword')->name("modifyPassword");
   
});
// 前台中间件分组 
Route::group(['middleware'=>'Homelogin','prefix' => 'home','namespace' => 'Home',], function (){
        // 退出登录
        Route::get("/logout",'IndexController@logout')->name("logout");
    // 订单中心
        // 待付款
        Route::get("/order_pay",'UserController@order_pay')->name("order_pay");
        // 待发货
        Route::get("/order_send",'UserController@order_send')->name("order_send");
        // 待收货
        Route::get("/order_receive",'UserController@order_receive')->name("order_receive");
        // 待评价
         Route::get("/order_evaluate",'UserController@order_evaluate')->name("order_evaluate");
    // 我的中心
        // 个人中心
        Route::get("/user",'UserController@user')->name("user");
        // 我的收藏
        Route::get("/person_collect",'UserController@person_collect')->name("person_collect");
        // 我的足迹
        Route::get("/person_footmark",'UserController@person_footmark')->name("person_footmark");
    // 设置项
        // 个人信息
        Route::get("/setting_info",'UserController@setting_info')->name("setting_info");
        // 用户信息
        Route::post("/userInfo",'UserController@userInfo')->name("userInfo");
        // 地址管理
        Route::get("/setting_address",'UserController@setting_address')->name("setting_address");
        // 添加地址
        Route::get("/doAdd_address",'UserController@doAdd_address')->name("doAdd_address");
        // 删除地址
        Route::get("/del_address",'UserController@del_address')->name("del_address");
        // 设置默认地址
        Route::get("/initAddress",'UserController@initAddress')->name("initAddress");
        // 安全管理
        Route::get("/setting_safe",'UserController@setting_safe')->name("setting_safe");
        // 修改用户密码
        Route::post("/passwordEdit",'UserController@passwordEdit')->name("passwordEdit");
        // success pass
    Route::get("/successPass",'UserController@successPass')->name("successPass");
     // 结算
     
        Route::get("/getOrderInfo",'UserController@getOrderInfo')->name("getOrderInfo");
        // 提交订单
        Route::get("/pay",'UserController@pay')->name("pay");
        // 购物车
        Route::get("/cart",'UserController@cart')->name("cart");
        // 删除购物车数据
        Route::get("/delCart",'UserController@delCart')->name("delCart");
        // ajax add购物车数量
        Route::get("/add_sku_num",'UserController@add_sku_num')->name("add_sku_num");
        // ajax jian购物车数量
        Route::get("/jian_sku_num",'UserController@jian_sku_num')->name("jian_sku_num");
        // 添加购物车
        Route::post("/addCart",'GoodsController@addCart')->name("addCart");
    // 商品search
        Route::get("/search",'GoodsController@search')->name("search");
        //商品详情
        Route::get("/goods",'GoodsController@goods')->name("goods");
        // 获取sku ajax
        Route::get("/getGoodsSku",'GoodsController@getGoodsSku')->name("getGoodsSku");
        
        // 微信二维码
        Route::get("/qrcode",'QrcodeController@qrcode')->name("qrcode");
        // 付款成功
        Route::get("/order_success",'UserController@order_success')->name("order_success");
        // 付款失败
        Route::get("/order_fail",'UserController@order_fail')->name("order_fail");
        // 判断订单状态
        Route::get("/get_order_status",'UserController@get_order_status')->name("get_order_status");

        // test
        Route::get("/test",'UserController@test')->name("test");
        // 同步回调 支付宝
        Route::get("/alipay/return",'zfbPayController@return');

        
});
// 支付宝支付 异步回调
Route::post('/alipay/notify','Home\zfbPayController@notify');
// wxpay
Route::post("/home/notify",'Home\wxPayController@notify')->name("notify");


// root
// 非中间件分组
Route::group(['prefix'=>'root','namespace'=>'Root'],function(){
    // 登录
    Route::get("/login",'IndexController@login')->name("rootlogin");
    // 验证码
    Route::get('/captcha','CaptchaController@make')->name('captcha');
    // 接受表单
    Route::post("/rootDoLogin",'IndexController@rootDoLogin')->name("rootDoLogin");
    

});

// 后台中间间分组
Route::group(['middleware'=>'Rootlogin','prefix'=>'root','namespace'=>'Root'],function(){
    // 主页显示
    Route::get("/rootIndex",'IndexController@rootIndex')->name("rootIndex");
    // home 
    Route::get("/rootHome",'IndexController@rootHome')->name("rootHome");

    // 产品列表
    Route::get('/products_List','GoodsController@products_List')->name('products_List');
    // 添加产品
    Route::get('/picture_add','GoodsController@picture_add')->name('picture_add');
    // 添加产品表单
    Route::post('/add_goods','GoodsController@add_goods')->name('add_goods');
    // 修改产品
    Route::get('/editGoods','GoodsController@editGoods')->name('editGoods');
    // 修改产品表单
    Route::post('/editToGoods','GoodsController@editToGoods')->name('editToGoods');
    
    // 品牌管理
    Route::get('/brand_Manage','GoodsController@brand_Manage')->name('brand_Manage');
    // 添加品牌
    Route::get('/add_Brand','GoodsController@add_Brand')->name('add_Brand');
    // 添加品牌
    Route::post('/addTo_brand','GoodsController@addTo_brand')->name('addTo_brand');
    // 删除品牌
    Route::get('/del_brand','GoodsController@del_brand')->name('del_brand');
    // 品牌详情
    Route::get('/brand_detailed','GoodsController@brand_detailed')->name('brand_detailed');

    // 分类管理
    Route::get('/sortList','GoodsController@sortList')->name('sortList');
    // 添加分类
    Route::post('/addSecond','GoodsController@addSecond')->name('addSecond');
    // 删除分类
    Route::post('/delSecond','GoodsController@delSecond')->name('delSecond');
    // 修改分类
    Route::post('/editSecond','GoodsController@editSecond')->name('editSecond');
    // 分类三级联动ajax
    Route::get('/ajax_type','GoodsController@ajax_type')->name('ajax_type');
    // ajax品牌
    Route::get('/ajax_brand','GoodsController@ajax_brand')->name('ajax_brand');
    /*  ==========  产品管理  ==========  */


    /*  ==========  图片管理  ==========  */
    // 广告管理
    Route::get('/advertising','IndexController@advertising')->name('advertising');
    // 分类管理
    Route::get('/Sort_ads','IndexController@sort_ads')->name('sort_ads');
    /*  ==========  图片管理  ==========  */


    /*  ==========  交易管理  ==========  */
    // 交易信息
    Route::get('/transaction','IndexController@transaction')->name('transaction');
    // 交易订单
    Route::get('/Order_Chart','IndexController@order_Chart')->name('Order_Chart');
    // 订单管理
    Route::get('/Orderform','IndexController@orderform')->name('Orderform');
    // 订单管理
    Route::get('/order_detailed','IndexController@order_detailed')->name('order_detailed');
    // 交易金额
    Route::get('/Amounts','IndexController@amounts')->name('Amounts');
    // 订单处理
    Route::get('/Order_handling','IndexController@order_handling')->name('Order_handling');
    // 退款管理
    Route::get('/Refund','IndexController@refund')->name('Refund');
    // 退款详情
    Route::get('/Refund_detailed','IndexController@Refund_detailed')->name('Refund_detailed');
    /*  ==========  交易管理  ==========  */



    /*  ==========  支付管理  ==========  */
    // 账户管理
    Route::get('/Cover_management','IndexController@Cover_management')->name('Cover_management');
    // 账户详情
    Route::get('/userinfo','IndexController@userinfo')->name('userinfo');
    // 支付方式
    Route::get('/payment_method','IndexController@payment_method')->name('payment_method');
    // 支付配置
    Route::get('/Payment_Configure','IndexController@payment_Configure')->name('Payment_Configure');
    /*  ==========  支付管理  ==========  */


    /*  ==========  会员管理  ==========  */
    // 会员列表
    Route::get('/user_list','userController@user_list')->name('user_list');
    // 添加会员
    Route::post('/addUser','userController@addUser')->name('addUser');
    // 删除会员
    Route::get('/delUser','userController@delUser')->name('delUser');
    // 禁用会员
    Route::get('/disable','userController@disable')->name('disable');
    // 修改会员
    Route::get('/editUser','userController@editUser')->name('editUser');
    // 修改会员表单
    Route::post('/editToUser','userController@editToUser')->name('editToUser');
    // 会员详情
    Route::get('/member_show','userController@member_show')->name('member_show');
    // 等级管理
    Route::get('/member_Grading','userController@member_Grading')->name('member_Grading');
    // 会员记录管理
    Route::get('/integration','userController@integration')->name('integration');
    /*  ==========  会员管理  ==========  */


    /*  ==========  店铺管理  ==========  */
    // 店铺列表
    Route::get('/Shop_list','IndexController@shop_list')->name('Shop_list');
    // 店铺审核
    Route::get('/Shops_Audit','IndexController@shops_Audit')->name('Shops_Audit');
    // 审核详情
    Route::get('/shopping_detailed','IndexController@shopping_detailed')->name('shopping_detailed');
    /*  ==========  店铺管理  ==========  */


    /*  ==========  消息管理  ==========  */
    // 留言列表
    Route::get('/Guestbook','IndexController@guestbook')->name('Guestbook');
    // 意见反馈
    Route::get('/Feedback','IndexController@feedback')->name('Feedback');
    /*  ==========  消息管理  ==========  */


    /*  ==========  文章管理  ==========  */
    // 文章列表
    Route::get('/article_list','ArticleController@article_list')->name('article_list');
    // 添加文章
    Route::get('/article_add','ArticleController@article_add')->name('article_add');
    // 添加文章表单
    Route::post('/addArticle','ArticleController@addArticle')->name('addArticle');
    // 修改文章
    Route::get('/article_edit','ArticleController@article_edit')->name('article_edit');
    // 修改表单
    Route::post('/article_doEdit','ArticleController@article_doEdit')->name('article_doEdit');
    // 分类管理
    Route::get('/article_Sort','ArticleController@article_Sort')->name('article_Sort');
    // 删除文章
    Route::get('/article_delete','ArticleController@article_delete')->name('article_delete');
    // 添加分类
    Route::get('/addType','ArticleController@addType')->name('addType');
    // 添加表单
    Route::post('/addDoType','ArticleController@addDoType')->name('addDoType');
    // 修改分类
    Route::get('/editType','ArticleController@editType')->name('editType');
    // 修改表单
    Route::post('/editDoType','ArticleController@editDoType')->name('editDoType');
    // 删除分类
    Route::get('/delType','ArticleController@delType')->name('delType');

    /*  ==========  文章管理  ==========  */


    /*  ==========  系统管理  ==========  */
    // 系统设置
    Route::get('/Systems','IndexController@systems')->name('Systems');
    // 系统栏目管理
    Route::get('/System_section','IndexController@system_section')->name('System_section');
    // 系统日志
    Route::get('/System_Logs','IndexController@system_Logs')->name('System_Logs');
    /*  ==========  系统管理  ==========  */

    /*  ==========  管理员管理  ==========  */
    // 权限列表
    Route::get('/admin_privilege','RbacController@admin_privilege')->name('admin_privilege');
    // 添加权限
    Route::get('/addPrivilege','RbacController@addPrivilege')->name('addPrivilege');
    // 添加权限
    Route::post('/add_privilege','RbacController@add_privilege')->name('add_privilege');
    // 删除权限
    Route::get('/delPrivilege','RbacController@delPrivilege')->name('delPrivilege');
    // 修改表单
    Route::get('/editPrivilege','RbacController@editPrivilege')->name('editPrivilege');
    // 修改权限表单
    Route::post('/editToPrivilege','RbacController@editToPrivilege')->name('editToPrivilege');
    // 角色管理
    Route::get('/admin_Competence','RbacController@admin_Competence')->name('admin_Competence');
    // 添加角色
    Route::get('/competence','RbacController@competence')->name('competence');
    // 管理员列表
    Route::get('/administrator','RbacController@administrator')->name('administrator');
    // 添加管理员
    Route::post('/addRoot','RbacController@addRoot')->name('addRoot');
    // 删除root
    Route::get('/delRoot','RbacController@delRoot')->name('delRoot');
    // 添加角色
    Route::post('/addToSole','RbacController@addToSole')->name('addToSole');
    // 角色列表
    Route::get('/roleList','RbacController@roleList')->name('roleList');
    // 删除root
    Route::get('/delRole','RbacController@delRole')->name('delRole');
    // 个人信息
    Route::get('/admin_info','RbacController@admin_info')->name('admin_info');
    /*  ==========  管理员管理  ==========  */
});



// 后台分组 
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    //  // 登录
    // Route::get("/login",'IndexController@login')->name("adminLogin");
    // 商家后台主页显示
    Route::get("/index",'IndexController@index')->name("adminIndex");
    // home
    Route::get("/home",'IndexController@home')->name("adminHome");
    // goods
    Route::get("/goods",'IndexController@goods')->name("adminGoods");
    // goods_edit
    Route::get("/goods_edit",'IndexController@goods_edit')->name("adminGoods_edit");
    // password
    Route::get("/password",'IndexController@password')->name("adminPassword");
    // seller
    Route::get("/seller",'IndexController@seller')->name("adminSeller");
});


