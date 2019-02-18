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
</body>
    <!--header-->
    <div id="account">
        <div class="py-container">
            <div class="yui3-g collect">
                <!--左侧列表-->
@include('home.layouts.user_info')
                <!--右侧主内容-->
                <div class="yui3-u-5-6 goods">
                    <div class="body">
                        <h4>全部足迹 12</h4>
                        <div class="goods-list">
                            <ul class="yui3-g" id="goods-list">
                                 <li class="yui3-u-1-4">
                                        <div class="list-wrap">
                                            <div class="p-img"><img src="/img/_/t.jpg" alt=''></div>
                                            <div class="price"><strong><em>¥</em> <i>139.00</i></strong></div>
                                            <div class="attr"><em>Apple苹果iPhone 6s 32G金色 移动联通电信4G手机</em></div>
                                            <div class="cu"><em><span>促</span>满一件可参加超值换购</em></div>
                                            <div class="operate">
                                                <a href="success-cart.html" target="_blank" class="sui-btn btn-bordered btn-danger">加入购物车</a>
                                                <a href="javascript:void(0);" class="sui-btn btn-bordered">对比</a>
                                                <a href="javascript:void(0);" class="sui-btn btn-bordered">降价通知</a>
                                            </div>
                                        </div>
                                    </li >
                                    <li class="yui3-u-1-4">
                                        <div class="list-wrap">
                                            <div class="p-img"><img src="/img/_/t.jpg" alt=''></div>
                                            <div class="price"><strong><em>¥</em> <i>139.00</i></strong></div>
                                            <div class="attr"><em>Apple苹果iPhone 6s 32G金色 移动联通电信4G手机</em></div>
                                            <div class="cu"><em><span>促</span>满一件可参加超值换购</em></div>
                                            <div class="operate">
                                                <a href="success-cart.html" target="_blank" class="sui-btn btn-bordered btn-danger">加入购物车</a>
                                                <a href="javascript:void(0);" class="sui-btn btn-bordered">对比</a>
                                                <a href="javascript:void(0);" class="sui-btn btn-bordered">降价通知</a>
                                            </div>
                                        </div>
                                    </li >
                                    <li class="yui3-u-1-4">
                                        <div class="list-wrap">
                                            <div class="p-img"><img src="/img/_/t.jpg" alt=''></div>
                                            <div class="price"><strong><em>¥</em> <i>139.00</i></strong></div>
                                            <div class="attr"><em>Apple苹果iPhone 6s 32G金色 移动联通电信4G手机</em></div>
                                            <div class="cu"><em><span>促</span>满一件可参加超值换购</em></div>
                                            <div class="operate">
                                                <a href="success-cart.html" target="_blank" class="sui-btn btn-bordered btn-danger">加入购物车</a>
                                                <a href="javascript:void(0);" class="sui-btn btn-bordered">对比</a>
                                                <a href="javascript:void(0);" class="sui-btn btn-bordered">降价通知</a>
                                            </div>
                                        </div>
                                    </li >
                                    <li class="yui3-u-1-4">
                                        <div class="list-wrap">
                                            <div class="p-img"><img src="/img/_/t.jpg" alt=''></div>
                                            <div class="price"><strong><em>¥</em> <i>139.00</i></strong></div>
                                            <div class="attr"><em>Apple苹果iPhone 6s 32G金色 移动联通电信4G手机</em></div>
                                            <div class="cu"><em><span>促</span>满一件可参加超值换购</em></div>
                                            <div class="operate">
                                                <a href="success-cart.html" target="_blank" class="sui-btn btn-bordered btn-danger">加入购物车</a>
                                                <a href="javascript:void(0);" class="sui-btn btn-bordered">对比</a>
                                                <a href="javascript:void(0);" class="sui-btn btn-bordered">降价通知</a>
                                            </div>
                                        </div>
                                    </li >
                                    <li class="yui3-u-1-4">
                                        <div class="list-wrap">
                                            <div class="p-img"><img src="/img/_/t.jpg" alt=''></div>
                                            <div class="price"><strong><em>¥</em> <i>139.00</i></strong></div>
                                            <div class="attr"><em>Apple苹果iPhone 6s 32G金色 移动联通电信4G手机</em></div>
                                            <div class="cu"><em><span>促</span>满一件可参加超值换购</em></div>
                                            <div class="operate">
                                                <a href="success-cart.html" target="_blank" class="sui-btn btn-bordered btn-danger">加入购物车</a>
                                                <a href="javascript:void(0);" class="sui-btn btn-bordered">对比</a>
                                                <a href="javascript:void(0);" class="sui-btn btn-bordered">降价通知</a>
                                            </div>
                                        </div>
                                    </li >
                                    <li class="yui3-u-1-4">
                                        <div class="list-wrap">
                                            <div class="p-img"><img src="/img/_/t.jpg" alt=''></div>
                                            <div class="price"><strong><em>¥</em> <i>139.00</i></strong></div>
                                            <div class="attr"><em>Apple苹果iPhone 6s 32G金色 移动联通电信4G手机</em></div>
                                            <div class="cu"><em><span>促</span>满一件可参加超值换购</em></div>
                                            <div class="operate">
                                                <a href="success-cart.html" target="_blank" class="sui-btn btn-bordered btn-danger">加入购物车</a>
                                                <a href="javascript:void(0);" class="sui-btn btn-bordered">对比</a>
                                                <a href="javascript:void(0);" class="sui-btn btn-bordered">降价通知</a>
                                            </div>
                                        </div>
                                    </li >
                            </ul>
                        </div>


                        <!--猜你喜欢-->
                        <div class="like-title">
                            <div class="mt">
                                <span class="fl"><strong>猜你喜欢</strong></span>
                            </div>
                        </div>
                        <div class="like-list">
                            <ul class="yui3-g">
                                <li class="yui3-u-1-4">
                                    <div class="list-wrap">
                                        <div class="p-img">
                                            <img src="/img/_/itemlike01.png" />
                                        </div>
                                        <div class="attr">
                                            <em>DELL戴尔Ins 15MR-7528SS 15英寸 银色 笔记本</em>
                                        </div>
                                        <div class="price">
                                            <strong>
											<em>¥</em>
											<i>3699.00</i>
										</strong>
                                        </div>
                                        <div class="commit">
                                            <i class="command">已有6人评价</i>
                                        </div>
                                    </div>
                                </li>
                                <li class="yui3-u-1-4">
                                    <div class="list-wrap">
                                        <div class="p-img">
                                            <img src="/img/_/itemlike02.png" />
                                        </div>
                                        <div class="attr">
                                            <em>Apple苹果iPhone 6s/6s Plus 16G 64G 128G</em>
                                        </div>
                                        <div class="price">
                                            <strong>
											<em>¥</em>
											<i>4388.00</i>
										</strong>
                                        </div>
                                        <div class="commit">
                                            <i class="command">已有700人评价</i>
                                        </div>
                                    </div>
                                </li>
                                <li class="yui3-u-1-4">
                                    <div class="list-wrap">
                                        <div class="p-img">
                                            <img src="/img/_/itemlike03.png" />
                                        </div>
                                        <div class="attr">
                                            <em>DELL戴尔Ins 15MR-7528SS 15英寸 银色 笔记本</em>
                                        </div>
                                        <div class="price">
                                            <strong>
											<em>¥</em>
											<i>4088.00</i>
										</strong>
                                        </div>
                                        <div class="commit">
                                            <i class="command">已有700人评价</i>
                                        </div>
                                    </div>
                                </li>
                                <li class="yui3-u-1-4">
                                    <div class="list-wrap">
                                        <div class="p-img">
                                            <img src="/img/_/itemlike04.png" />
                                        </div>
                                        <div class="attr">
                                            <em>DELL戴尔Ins 15MR-7528SS 15英寸 银色 笔记本</em>
                                        </div>
                                        <div class="price">
                                            <strong>
											<em>¥</em>
											<i>4088.00</i>
										</strong>
                                        </div>
                                        <div class="commit">
                                            <i class="command">已有700人评价</i>
                                        </div>
                                    </div>
                                </li>

                            </ul>
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