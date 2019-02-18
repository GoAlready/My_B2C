<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>个人注册</title>


    <link rel="stylesheet" type="text/css" href="/css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="/css/pages-register.css" />
</head>

<body>
	<div class="register py-container ">
		<!--head-->
		<div class="logoArea">
			<a href="" class="logo"></a>
		</div>
		<!--register-->
		<div class="registerArea">
			<h3>注册新用户<span class="go">我有账号，去<a href="/home/login" target="_blank">登陆</a></span></h3>
			<div class="info">
				<form class="sui-form form-horizontal" action="{{route('doRegister')}}" method="POST">
					<div class="control-group">
						<label class="control-label">用户名：</label>
						<div class="controls">
							<input type="text" placeholder="请输入你的用户名" class="input-xfat input-xlarge" name="name" value="{{old('name')}}">
							@if($errors->has('name'))
								<p class="errors">{{$errors->first('name')}}</p>
							@endif
						</div>
					</div>
					<div class="control-group">
						<label for="inputPassword" class="control-label">登录密码：</label>
						<div class="controls">
							<input type="password" placeholder="设置登录密码" class="input-xfat input-xlarge" name="password" value="{{old('password')}}">
							@if($errors->has('password'))
								<p class="errors">{{$errors->first('password')}}</p>
							@endif
						</div>
					</div>
					<div class="control-group">
						<label for="inputPassword" class="control-label">确认密码：</label>
						<div class="controls">
							<input type="password" placeholder="再次确认密码" class="input-xfat input-xlarge" name="password_confirmation" value="{{old('password_confirmation')}}">
							@if($errors->has('password_confirmation'))
								<p class="errors">{{$errors->first('password_confirmation')}}</p>
							@endif
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">手机号：</label>
						<div class="controls">
							<input type="text" placeholder="请输入你的手机号" class="input-xfat input-xlarge" name="phone" id="phone"  value="{{old('phone')}}">
							@if($errors->has('phone'))
								<p class="errors">{{$errors->first('phone')}}</p>
							@endif
						</div>
					</div>
					<div class="control-group">
						<label for="inputPassword" class="control-label">短信验证码：</label>
						<div class="controls">
							<input type="text" placeholder="短信验证码" class="input-xfat input-xlarge" name="validata">  <input type="button" value="点击发送验证码" class="btn">
							@if($errors->has('validata'))
								<p class="errors">{{$errors->first('validata')}}</p>
							@endif
						</div>
					</div>
					<div class="control-group">
						<label for="inputPassword" class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
						<div class="controls">
							<input name="m1" type="checkbox" value="2" checked=""><span>同意协议并注册《品优购用户协议》</span>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"></label>
						{{ csrf_field() }}
						<div class="controls btn-reg">
							<input type="submit" value="完成注册" class="sui-btn btn-block btn-xlarge btn-danger">
						</div>
					</div>
				</form>
				<div class="clearfix"></div>
			</div>
		</div>
		<!--foot-->
		<div class="py-container copyright">
			<ul>
				<li>关于我们</li>
				<li>联系我们</li>
				<li>联系客服</li>
				<li>商家入驻</li>
				<li>营销中心</li>
				<li>手机品优购</li>
				<li>销售联盟</li>
				<li>品优购社区</li>
			</ul>
			<div class="address">地址：北京市昌平区建材城西路金燕龙办公楼一层 邮编：100096 电话：400-618-4000 传真：010-82935100</div>
			<div class="beian">京ICP备08001421号京公网安备110108007702
			</div>
		</div>
	</div>


<script type="text/javascript" src="/js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="/js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="/js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="/js/plugins/jquery-placeholder/jquery.placeholder.min.js"></script>
<script type="text/javascript" src="/js/pages/register.js"></script>
<script>
		var time = 30;
		var ts;
	$(".btn").click(function(){
		var phone = $("#phone").val();
		$.ajax({
			type:"GET",
			url:"{{route('cache')}}",
			data:{phone:phone},
			success:function(data){
				$(".btn").attr('disabled',true);
				ts = setInterval(function(){
					time--;
					if(time==0){
						$(".btn").attr('disabled',false);
						time =30;
						$(".btn").val('点击发送验证码');
						clearInterval(ts);
					}else{
						$(".btn").val("还剩"+time+"秒");
					}
				},1000);
			}
		})
	})
</script>
</body>
</html>