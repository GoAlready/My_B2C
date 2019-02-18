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
<script type="text/javascript" src="/js/plugins/jquery-placeholder/jquery.placeholder.min.js"></script>
<script type="text/javascript" src="/js/widget/nav.js"></script>
<script type="text/javascript" src="/js/plugins/birthday/birthday.js"></script>
<script type="text/javascript" src="/js/plugins/citypicker/distpicker.data.js"></script>
<script type="text/javascript" src="/js/plugins/citypicker/distpicker.js"></script>
<script type="text/javascript" src="/js/plugins/upload/uploadPreview.js"></script>
<script type="text/javascript" src="/js/pages/main.js"></script>
<script>
            $(function() {               
                $.ms_DatePicker({
                    YearSelector: "#select_year2",
                    MonthSelector: "#select_month2",
                    DaySelector: "#select_day2"
                });
            });
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
                    <div class="body userInfo">
                        <ul class="sui-nav nav-tabs nav-large nav-primary ">
                            <li class="active"><a href="#one" data-toggle="tab">基本资料</a></li>
                        </ul>
                        <div class="tab-content ">
                            <div id="one" class="tab-pane active">
                                <form action="{{route('userInfo')}}" method="post"  enctype="multipart/form-data"  id="form-msg" class="sui-form form-horizontal">
                                    <div class="control-group">
                                        <label for="inputName" class="control-label">昵称：</label>
                                        <div class="controls">
                                            <input type="text" id="inputName" name="nicheng" placeholder="昵称" value="{{$user['nicheng'] ? : ''}}">
											@if($errors->has('nicheng'))
												<p>{{$errors->first('nicheng')}}</p>
											@endif
											{{csrf_field()}}
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="inputGender" class="control-label">性别：</label>
                                        <div class="controls">
                                            <label data-toggle="radio" class="radio-pretty inline  @if($user['sex']=='男') checked  @endif">
                                            <input type="radio"   name="sex" value="男" @if($user['sex']=='男') checked  @endif><span>男</span>
											@if($errors->has('sex'))
												<p>{{$errors->first('sex')}}</p>
											@endif
                                        </label>
                                            <label  data-toggle="radio" class="radio-pretty inline  @if($user['sex']=='女') checked  @endif ">
                                            <input type="radio" name="sex" value="女" @if($user['sex']=='女') checked  @endif><span>女</span>
                                        </label>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="inputPassword" class="control-label">生日：</label>
                                        <div class="controls">
                                            <select id="select_year2" rel=" {{$user['year'] ? : 2000}}" name="year"></select>年
											@if($errors->has('year'))
												<p>{{$errors->first('year')}}</p>
											@endif
													
                                            <select id="select_month2" rel="{{$user['month'] ? : 6}}" name="month"></select>月
											@if($errors->has('month'))
												<p>{{$errors->first('month')}}</p>
											@endif
                                            <select id="select_day2" rel="{{$user['day'] ? : 20}}" name="day"></select>日
											@if($errors->has('day'))
												<p>{{$errors->first('day')}}</p>
											@endif
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="inputPassword" class="control-label">所在地：</label>
                                        <div class="controls">
                                            <div data-toggle="distpicker">
                                                <div class="form-group area">
                                                    <select class="form-control" id="province" name="province"></select>
													@if($errors->has('province'))
														<p>{{$errors->first('province')}}</p>
													@endif
                                                </div>
                                                <div class="form-group area">
                                                    <select class="form-control" id="city"  name="city"></select>
													@if($errors->has('city'))
														<p>{{$errors->first('city')}}</p>
													@endif
                                                </div>
                                                <div class="form-group area">
                                                    <select class="form-control" id="district" name="county"></select>
													@if($errors->has('county'))
														<p>{{$errors->first('county')}}</p>
													@endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="inputJob" class="control-label">职业：</label>
													@if($errors->has('job'))
														<p>{{$errors->first('job')}}</p>
													@endif
                                                    <select class="form-control" id="district1" name="job">
													<option value="">请选择</option>
													@foreach($job as $k=>$v)
														@if($v['job']==$k)
														<option value="{{$v['id']}}" selected="selected">{{$v['job']}}</option>
														@else
														<option value="{{$v['id']}}">{{$v['job']}}</option>
														@endif
													@endforeach
													</select>
                                            </span>
                                            </span>
                                    </div>
									 <div id="two" class="tab-pane">
                                <div class="new-photo">
                                    <p>选择头像:</p>
                                    <div class="upload">
                                        <img id="imgShow_WU_FILE_0" width="100" height="100" src="{{$user['headImg']}}" alt="">
                                        <input type="file" id="up_img_WU_FILE_0"  name="headImg"/>
										@if($errors->has('headImg'))
														<p>{{$errors->first('headImg')}}</p>
													@endif
                                    </div>
                                </div>
                            </div>
                            </div>
							 <div class="control-group">
                                        <label for="sanwei" class="control-label"></label>
                                        <div class="controls">
											<input type="submit"  class="sui-btn btn-primary" value="上传">
                                        </div>
                                    </div>	
                                </form>
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
<script>
            $("#province option[value={{$user['province']}}]").attr("selected",true)
            $("#province").change()
            $("#city option[value={{$user['city']}}]").attr("selected",true)
            $("#city").change()
            $("#county option[value={{$user['county']}}").attr("selected",true)
            d

</script>