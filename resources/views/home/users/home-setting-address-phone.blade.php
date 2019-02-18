@include('home.layouts.header')

<script type="text/javascript" src="/js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
	$("#service").hover(function(){
		$(".service").show();
	},function(){
		$(".service").hide();
	});
	$("#shopcar").hover(function(){
		$("#shopcarlist").show();
	},function(){
		$("#shopcarlist").hide();
	});

})
</script>
<script type="text/javascript" src="/js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="/js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="/js/widget/nav.js"></script>
<script type="text/javascript" src="plugins/jquery.validate/jquery.validate.js"></script>
<script>
        $(function(){
            //jquery.validate
            $("#phone-form").validate({
            submitHandler: function() {
                //验证通过后 的js代码写在这里
            }
        })		
        })
    
        //下面是一些常用的验证规则扩展

        /*-------------验证插件配置 懒人建站http://www.51xuediannao.com/-------------*/

        //配置错误提示的节点，默认为label，这里配置成 span （errorElement:'span'）
        $.validator.setDefaults({
        errorElement:'span'
        });

        //配置通用的默认提示语
        $.extend($.validator.messages, {
        required: '必填',
        equalTo: "请再次输入相同的值"
        });

        /*-------------扩展验证规则使用-------------*/
        //邮箱 
        jQuery.validator.addMethod("mail", function (value, element) {
        var mail = /^[a-z0-9._%-]+@([a-z0-9-]+\.)+[a-z]{2,4}$/;
        return this.optional(element) || (mail.test(value));
        }, "邮箱格式不对");

        //电话验证规则
        jQuery.validator.addMethod("phone", function (value, element) {
        var phone = /^0\d{2,3}-\d{7,8}$/;
        return this.optional(element) || (phone.test(value));
        }, "电话格式如：0371-68787027");

        //区号验证规则  
        jQuery.validator.addMethod("ac", function (value, element) {
        var ac = /^0\d{2,3}$/;
        return this.optional(element) || (ac.test(value));
        }, "区号如：010或0371");

        //无区号电话验证规则  
        jQuery.validator.addMethod("noactel", function (value, element) {
        var noactel = /^\d{7,8}$/;
        return this.optional(element) || (noactel.test(value));
        }, "电话格式如：68787027");

        //手机验证规则  
        jQuery.validator.addMethod("mobile", function (value, element) {
        var mobile = /^1[3|4|5|7|8]\d{9}$/;
        return this.optional(element) || (mobile.test(value));
        }, "手机格式不对");

        //邮箱或手机验证规则  
        jQuery.validator.addMethod("mm", function (value, element) {
        var mm = /^[a-z0-9._%-]+@([a-z0-9-]+\.)+[a-z]{2,4}$|^1[3|4|5|7|8]\d{9}$/;
        return this.optional(element) || (mm.test(value));
        }, "格式不对");

        //电话或手机验证规则  
        jQuery.validator.addMethod("tm", function (value, element) {
        var tm=/(^1[3|4|5|7|8]\d{9}$)|(^\d{3,4}-\d{7,8}$)|(^\d{7,8}$)|(^\d{3,4}-\d{7,8}-\d{1,4}$)|(^\d{7,8}-\d{1,4}$)/;
        return this.optional(element) || (tm.test(value));
        }, "格式不对");

        //年龄
        jQuery.validator.addMethod("age", function(value, element) {   
        var age = /^(?:[1-9][0-9]?|1[01][0-9]|120)$/;
        return this.optional(element) || (age.test(value));
        }, "不能超过120岁"); 
        ///// 20-60   /^([2-5]\d)|60$/

        //传真
        jQuery.validator.addMethod("fax",function(value,element){
        var fax = /^(\d{3,4})?[-]?\d{7,8}$/;
        return this.optional(element) || (fax.test(value));
        },"传真格式如：0371-68787027");

        //验证当前值和目标val的值相等 相等返回为 false
        jQuery.validator.addMethod("equalTo2",function(value, element){
        var returnVal = true;
        var id = $(element).attr("data-rule-equalto2");
        var targetVal = $(id).val();
        if(value === targetVal){
            returnVal = false;
        }
        return returnVal;
        },"不能和原始密码相同");

        //大于指定数
        jQuery.validator.addMethod("gt",function(value, element){
        var returnVal = false;
        var gt = $(element).data("gt");
        if(value > gt && value != ""){
            returnVal = true;
        }
        return returnVal;
        },"不能小于0 或空");

        //汉字
        jQuery.validator.addMethod("chinese", function (value, element) {
        var chinese = /^[\u4E00-\u9FFF]+$/;
        return this.optional(element) || (chinese.test(value));
        }, "格式不对");

        //指定数字的整数倍
        jQuery.validator.addMethod("times", function (value, element) {
        var returnVal = true;
        var base=$(element).attr('data-rule-times');
        if(value%base!=0){
            returnVal=false;
        }
        return returnVal;
        }, "必须是发布赏金的整数倍");

        //身份证
        jQuery.validator.addMethod("idCard", function (value, element) {
        var isIDCard1=/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$/;//(15位)
        var isIDCard2=/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/;//(18位)

        return this.optional(element) || (isIDCard1.test(value)) || (isIDCard2.test(value));
        }, "格式不对");
    </script>
</body>
    <!--header-->
    <div id="account">
        <div class="py-container">
            <div class="yui3-g home">
                <!--左侧列表-->
@include('home.layouts.user_info')
                <!--右侧主内容-->
                <div class="yui3-u-5-6">
                    <div class="body userSafe">
                        <ul class="sui-nav nav-tabs nav-large nav-primary ">
                            <li><a href="#one" data-toggle="tab">密码设置</a></li>
                            <li class="active"><a href="#two" data-toggle="tab">绑定手机</a></li>
                        </ul>
                        <div class="tab-content ">
                            <div id="one" class="tab-pane">
                                <form class="sui-form form-horizontal sui-validate" id="jsForm">
                                    <div class="control-group">
                                        <label for="inputusername" class="control-label">用户名：</label>
                                        <div class="controls">
                                            <input id="pwdid" class="fn-tinput" data-rule-remote="http://www.baidu.com" type="password" name="OldPassword" placeholder="输入昵称"
                                                required data-msg-required="请输入昵称" minlength="6" data-msg-minlength="至少输入6个字符"
                                            />

                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="inputPassword" class="control-label">密码：</label>
                                        <div class="controls">
                                            <input class="fn-tinput" type="password" name="password" value="" placeholder="新密码" required id="password" data-rule-remote="php.php">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="inputRepassword" class="control-label">重复密码：</label>
                                        <div class="controls">
                                            <input class="fn-tinput" type="password" name="confirm_password" value="" placeholder="确认新密码" required equalTo="#password">
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"></label>
                                        <div class="controls">
                                            <button type="submit" class="sui-btn btn-primary">提交按钮</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="two" class="tab-pane active">
                                <!--步骤条-->
                                <div class="sui-steps steps-auto">
                                    <div class="wrap">
                                        <div class="finished">
                                        <label><span class="round"><i class="sui-icon icon-pc-right"></i></span><span>第一步 验证身份</span></label><i class="triangle-right-bg"></i><i class="triangle-right"></i>
                                        </div>
                                    </div>
                                    <div class="wrap">
                                        <div class="current">
                                        <label><span class="round">2</span><span>第二步 绑定新手机号</span></label><i class="triangle-right-bg"></i><i class="triangle-right"></i>
                                        </div>
                                    </div>
                                    <div class="wrap">
                                        <div class="todo">
                                        <label><span class="round">3</span><span>第三步 完成</span></label>
                                        </div>
                                    </div>
                                </div>

                                <!--表单-->

                                <form class="sui-form form-horizontal sui-validate" data-toggle='validate' id="phone-form">

                                    <div class="control-group">
                                        <label for="inputPassword" class="control-label">手机号：</label>
                                        <div class="controls">
                                            <input name="inputphone" type="text" id="inputphone" placeholder="请输入新手机号">
                                        </div>                            
                                    </div>
                                     <div class="control-group">
                                        <label for="inputcode" class="control-label">验证码：</label>
                                        <div class="controls">
                                            <input name="inputcode" type="text" id="inputcode">
                                        </div>
                                        <div class="controls">
                                            验证码
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="inputRepassword" class="control-label">短信验证码：</label>
                                        <div class="controls">
                                            <input name="msgcode" type="text" id="msgcode">
                                        </div>
                                        <div class="controls">
                                            <button class="sui-btn btn-info">发送</button>
                                        </div>
                                    </div>

                                    <div class="control-group next-btn">
                                        <a class="sui-btn btn-primary" href="home-setting-safe.html">上一步</a>&nbsp;
                                        <a class="sui-btn btn-primary" type="submit" href="home-setting-address-complete.html">下一步</a>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 底部栏位 -->
    <!--页面底部-->
<div class="clearfix footer">
	<div class="py-container">
		<div class="footlink">
			<div class="Mod-service">
				<ul class="Mod-Service-list">
					<li class="grid-service-item intro  intro1">

						<i class="serivce-item fl"></i>
						<div class="service-text">
							<h4>正品保障</h4>
							<p>正品保障，提供发票</p>
						</div>

					</li>
					<li class="grid-service-item  intro intro2">

						<i class="serivce-item fl"></i>
						<div class="service-text">
							<h4>正品保障</h4>
							<p>正品保障，提供发票</p>
						</div>

					</li>
					<li class="grid-service-item intro  intro3">

						<i class="serivce-item fl"></i>
						<div class="service-text">
							<h4>正品保障</h4>
							<p>正品保障，提供发票</p>
						</div>

					</li>
					<li class="grid-service-item  intro intro4">

						<i class="serivce-item fl"></i>
						<div class="service-text">
							<h4>正品保障</h4>
							<p>正品保障，提供发票</p>
						</div>

					</li>
					<li class="grid-service-item intro intro5">

						<i class="serivce-item fl"></i>
						<div class="service-text">
							<h4>正品保障</h4>
							<p>正品保障，提供发票</p>
						</div>

					</li>
				</ul>
			</div>
			<div class="clearfix Mod-list">
				<div class="yui3-g">
					<div class="yui3-u-1-6">
						<h4>购物指南</h4>
						<ul class="unstyled">
							<li>购物流程</li>
							<li>会员介绍</li>
							<li>生活旅行/团购</li>
							<li>常见问题</li>
							<li>购物指南</li>
						</ul>

					</div>
					<div class="yui3-u-1-6">
						<h4>配送方式</h4>
						<ul class="unstyled">
							<li>上门自提</li>
							<li>211限时达</li>
							<li>配送服务查询</li>
							<li>配送费收取标准</li>
							<li>海外配送</li>
						</ul>
					</div>
					<div class="yui3-u-1-6">
						<h4>支付方式</h4>
						<ul class="unstyled">
							<li>货到付款</li>
							<li>在线支付</li>
							<li>分期付款</li>
							<li>邮局汇款</li>
							<li>公司转账</li>
						</ul>
					</div>
					<div class="yui3-u-1-6">
						<h4>售后服务</h4>
						<ul class="unstyled">
							<li>售后政策</li>
							<li>价格保护</li>
							<li>退款说明</li>
							<li>返修/退换货</li>
							<li>取消订单</li>
						</ul>
					</div>
					<div class="yui3-u-1-6">
						<h4>特色服务</h4>
						<ul class="unstyled">
							<li>夺宝岛</li>
							<li>DIY装机</li>
							<li>延保服务</li>
							<li>品优购E卡</li>
							<li>品优购通信</li>
						</ul>
					</div>
					<div class="yui3-u-1-6">
						<h4>帮助中心</h4>
						<img src="/img/wx_cz.jpg">
					</div>
				</div>
			</div>
			<div class="Mod-copyright">
				<ul class="helpLink">
					<li>关于我们<span class="space"></span></li>
					<li>联系我们<span class="space"></span></li>
					<li>关于我们<span class="space"></span></li>
					<li>商家入驻<span class="space"></span></li>
					<li>营销中心<span class="space"></span></li>
					<li>友情链接<span class="space"></span></li>
					<li>关于我们<span class="space"></span></li>
					<li>营销中心<span class="space"></span></li>
					<li>友情链接<span class="space"></span></li>
					<li>关于我们</li>
				</ul>
				<p>地址：北京市昌平区建材城西路金燕龙办公楼一层 邮编：100096 电话：400-618-4000 传真：010-82935100</p>
				<p>京ICP备08001421号京公网安备110108007702</p>
			</div>
		</div>
	</div>
</div>
<!--页面底部END-->


undefined

</html>