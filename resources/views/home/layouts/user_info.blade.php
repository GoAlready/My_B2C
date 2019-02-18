                <!--左侧列表-->
                <div class="yui3-u-1-6 list">

                    <div class="person-info">
                        <div class="person-photo"><img style="width:50px" src="{{session('user_headImg')}}" alt=""></div>
                        <div class="person-account">
                            <span class="name">{{session('user_nicheng') ?  :session('user_name')}}</span>
                            <span class="safe"><a href="{{route('logout')}}">退出登录 </a></span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="list-items">
                        <dl>
							<dt><i>·</i> 订单中心</dt>
							<dd ><a href="{{route('user')}}"  class="list-active" >我的订单</a></dd>
							<dd><a href="{{route('order_pay')}}" >待付款</a></dd>
							<dd><a href="{{route('order_send')}}"  >待发货</a></dd>
							<dd><a href="{{route('order_receive')}}" >待收货</a></dd>
							<dd><a href="{{route('order_evaluate')}}" >待评价</a></dd>
						</dl>
						<dl>
							<dt><i>·</i> 我的中心</dt>
							<dd><a href="{{route('person_collect')}}">我的收藏</a></dd>
							<dd><a href="{{route('person_footmark')}}">我的足迹</a></dd>
						</dl>
						<dl>
							<dt><i>·</i> 物流消息</dt>
						</dl>
						<dl>
							<dt><i>·</i> 设置</dt>
							<dd><a href="{{route('setting_info')}}">个人信息</a></dd>
							<dd><a href="{{route('setting_address')}}"  >地址管理</a></dd>
							<dd><a href="{{route('setting_safe')}}" >安全管理</a></dd>
						</dl>
                    </div>
                </div>