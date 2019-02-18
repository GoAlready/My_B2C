<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/css/style.css"/>       
        <link href="/assets/css/codemirror.css" rel="stylesheet">
        <link rel="stylesheet" href="/assets/css/ace.min.css" />
        <link rel="stylesheet" href="/assets/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="/assets/css/font-awesome-ie7.min.css" />
		<![endif]-->
        <!--[if lte IE 8]>
		  <link rel="stylesheet" href="/assets/css/ace-ie.min.css" />
		<![endif]-->
			<script src="/assets/js/jquery.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="/assets/js/bootstrap.min.js"></script>
		<script src="/assets/js/typeahead-bs2.min.js"></script>
		<!-- page specific plugin scripts -->
		<script src="/assets/js/jquery.dataTables.min.js"></script>
		<script src="/assets/js/jquery.dataTables.bootstrap.js"></script>
        <script type="text/javascript" src="/js/H-ui.js"></script> 
        <script type="text/javascript" src="/js/H-ui.admin.js"></script> 
        <script src="/assets/layer/layer.js" type="text/javascript" ></script>
        <script src="/assets/laydate/laydate.js" type="text/javascript"></script>
<title>用户列表</title>
</head>

<body>
<div class="page-content clearfix">
    <div id="Member_Ratings">
      <div class="d_Confirm_Order_style">
    <div class="search_style">
     
      <ul class="search_content clearfix">
       <li><label class="l_f">会员名称</label><input name="" type="text"  class="text_add" placeholder="输入会员名称、电话、邮箱"  style=" width:400px"/></li>
       <li><label class="l_f">添加时间</label><input class="inline laydate-icon" id="start" style=" margin-left:10px;"></li>
       <li style="width:90px;"><button type="button" class="btn_search"><i class="icon-search"></i>查询</button></li>
      </ul>
    </div>
     <!---->
     <div class="border clearfix">
       <span class="l_f">
	    <a href="javascript:ovid()" id="member_add" class="btn btn-warning"><i class="icon-plus"></i>添加用户</a>
        <a href="javascript:ovid()" onclick="dels()" class="btn btn-danger"><i class="icon-trash"></i>批量删除</a>
       </span>
       <span class="r_f">共：<b>{{count($user)}}</b>条</span>
     </div>
     <!---->
     <div class="table_menu_list">
       <table class="table table-striped table-bordered table-hover" id="sample-table">
		<thead>
		 <tr>
				<th width="25"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
				<th width="80">ID</th>
				<th width="100">用户名</th>
				<th width="80">性别</th>
				<th width="120">手机</th>
				<th width="150">邮箱</th>
				<th width="">地址</th>
				<th width="180">加入时间</th>
                <th width="100">等级</th>
				<th width="70">状态</th>                
				<th width="250">操作</th>
			</tr>
		</thead>
	<tbody>
  @foreach($user as $v)
		<tr>
          <td><label><input type="checkbox" value="{{$v['id']}}" class="ace"><span class="lbl"></span></label></td>
          <td>{{$v['id']}}</td>
          <td><u style="cursor:pointer" class="text-primary" onclick="member_show('张三','member-show.html','10001','500','400')">{{$v['name']}}</u></td>
          <td>{{$v['sex']}}</td>
          <td>{{$v['phone']}}</td>
          <td>admin@mail.com</td>
          <td class="text-l">{{$v['province']}}{{$v['city']}}{{$v['county']}}</td>
          <td>{{$v['created_at']}}</td>
          <td>{{$v['lv']}}</td>
          <td class="td-status"><span class="label label-success radius">{{$v['Disable']==1 ? '停用':'启用' }}</span></td>
          <td class="td-manage">
		  @if($v['Disable']==0)
          <a onClick="member_stop(this,{{$v['id']}})"  href="javascript:;" title="停用"   class="btn btn-xs btn-success"><i class="icon-ok bigger-120"></i></a> 
		  @else
		  <a style="text-decoration:none" class="btn btn-xs " onClick="member_start(this,{{$v["id"]}})" href="javascript:;" title="启用"><i class="icon-ok bigger-120"></i></a>
		  @endif
          <a title="编辑" onclick="member_edit(this,{{$v['id']}})" href="javascript:;"  class="btn btn-xs btn-info" ><i class="icon-edit bigger-120"></i></a> 
          <a title="删除" href="javascript:;"  onclick="member_del(this,{{$v['id']}})" class="btn btn-xs btn-warning" ><i class="icon-trash  bigger-120"></i></a>
          </td>
		</tr>
  @endforeach
      </tbody>
	</table>
   </div>
  </div>
 </div>
</div>
<!--添加用户图层-->
<div class="add_menber" id="add_menber_style" style="display:none">
    <ul class=" page-content">
	<form class="form" method="post" action="{{route('addUser')}}">
	{{csrf_field()}}
     <li><label class="label_name">用&nbsp;&nbsp;户 &nbsp;名：</label><span class="add_name"><input  name="name" type="text"  class="text_add"/></span><div class="prompt r_f"></div></li>
	  <li><label class="label_name">密&nbsp;&nbsp;码 ：</label><span class="add_name"><input name="password" type="text"  class="text_add"/></span><div class="prompt r_f"></div></li>
     <!-- <li><label class="label_name">真实姓名：</label><span class="add_name"><input name="真实姓名" type="text"  class="text_add"/></span><div class="prompt r_f"></div></li> -->
     <li><label class="label_name">性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别：</label><span class="add_name">
     <label><input name="sex" value="男" type="radio" checked="checked" class="ace" ><span class="lbl">男</span></label>&nbsp;&nbsp;&nbsp;
     <label><input name="sex" value="女" type="radio" class="ace"><span class="lbl">女</span></label>&nbsp;&nbsp;&nbsp;
     </span>
     <div class="prompt r_f"></div>
     </li>
     <!-- <li><label class="label_name">固定电话：</label><span class="add_name"><input name="固定电话" type="text"  class="text_add"/></span><div class="prompt r_f"></div></li> -->
     <li><label class="label_name">移动电话：</label><span class="add_name"><input name="phone"  type="text"  class="text_add"/></span><div class="prompt r_f"></div></li>
     <!-- <li><label class="label_name">电子邮箱：</label><span class="add_name"><input name="电子邮箱" type="text"  class="text_add"/></span><div class="prompt r_f"></div></li> -->
                                         <div class="control-group" style="width:300px">
                                        <label for="inputPassword" class="control-label">所在地：</label>
                                        <div class="controls">
                                            <div data-toggle="distpicker">
                                                <div class="form-group area">
                                                    <select class="form-control" id="province" name="province"></select>
                                                </div>
                                                <div class="form-group area">
                                                    <select class="form-control" id="city"  name="city"></select>
                                                </div>
                                                <div class="form-group area">
                                                    <select class="form-control" id="district" name="county"></select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
     <li><label class="label_name">状&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;态：</label><span class="add_name">
     <label><input name="Disable" type="radio" value="0"  class="ace"><span class="lbl">开启</span></label>&nbsp;&nbsp;&nbsp;
     <label><input name="Disable"type="radio"  value="1" checked class="ace"><span class="lbl">关闭</span></label></span><div class="prompt r_f"></div></li>
	 </form>
    </ul>
 </div>

 <div class="add_menber" id="edit_menber_style" style="display:none">
    
 </div>


</body>
</html>
		<script type="text/javascript" src="/js/plugins/citypicker/distpicker.data.js"></script>
		<script type="text/javascript" src="/js/plugins/citypicker/distpicker.js"></script>
<script>
jQuery(function($) {
				var oTable1 = $('#sample-table').dataTable( {
				"aaSorting": [[ 1, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0,8,9]}// 制定列不参与排序
		] } );
				
				
				$('table th input:checkbox').on('click' , function(){
					var that = this;
					$(this).closest('table').find('tr > td:first-child input:checkbox')
					.each(function(){
						this.checked = that.checked;
						$(this).closest('tr').toggleClass('selected');
					});
						
				});
			
			
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			})
/*用户-添加*/
 $('#member_add').on('click', function(){
    layer.open({
        type: 1,
        title: '添加用户',
		maxmin: true, 
		shadeClose: true, //点击遮罩关闭层
        area : ['800px' , ''],
        content:$('#add_menber_style'),
		btn:['提交','取消'],
		yes:function(index,layero){	
		 var num=0;
		 var str="";
     $(".add_menber input[type$='text']").each(function(n){
          if($(this).val()=="")
          {
			   layer.alert(str+=""+$(this).attr("name")+"不能为空！\r\n",{
                title: '提示框',				
				icon:0,								
          }); 
		    num++;
            return false;            
          } 
		 });
		  if(num>0){  return false;}	 	
          else{
			  $(".form").submit();
			  layer.alert('添加成功！',{
               title: '提示框',				
			icon:1,		
			  });
			   layer.close(index);	
		  }		  		     				
		}
    });
});
/*用户-查看*/
function member_show(title,url,id,w,h){
	layer_show(title,url+'#?='+id,w,h);
}
/*用户-停用*/
function member_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		$.ajax("/root/disable?dis=1&id="+id)
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" class="btn btn-xs " onClick="member_start(this,'+id+')" href="javascript:;" title="启用"><i class="icon-ok bigger-120"></i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
		$(obj).remove();
		layer.msg('已停用!',{icon: 5,time:1000});
	});
}

/*用户-启用*/
function member_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		$.ajax("/root/disable?dis=0&id="+id)
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" class="btn btn-xs btn-success" onClick="member_stop(this,'+id+')" href="javascript:;" title="停用"><i class="icon-ok bigger-120"></i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
		$(obj).remove();
		layer.msg('已启用!',{icon: 6,time:1000});
	});
}
/*用户-编辑*/
function member_edit(obj,id){
		$.ajax({
			type:"GET",
			url:"/root/editUser?id="+id,
			dataType:"json",
			success:function(data){
				console.log(data);
				var str = `<ul class=" page-content">
							<form class="form" method="post" action="/root/editToUser?id=`+data.data.id+`">
							{{csrf_field()}}
							<li><label class="label_name">用&nbsp;&nbsp;户 &nbsp;名：</label><span class="add_name"><input value="`+data.data.name+`"  name="name" type="text"  class="text_add"/></span><div class="prompt r_f"></div></li>
							<li><label class="label_name">密&nbsp;&nbsp;码 ：</label><span class="add_name"><input value="`+data.data.password+`" name="password" type="text"  class="text_add"/></span><div class="prompt r_f"></div></li>
							<li><label class="label_name">性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别：</label><span class="add_name">
							<label><input name="sex" value="男" type="radio" `+(data.data.sex=='男' ? 'checked':'') +` class="ace" ><span class="lbl">男</span></label>&nbsp;&nbsp;&nbsp;
							<label><input name="sex" value="女" type="radio" `+(data.data.sex=='女' ? 'checked':'') +` class="ace"><span class="lbl">女</span></label>&nbsp;&nbsp;&nbsp;
							</span>
							<div class="prompt r_f"></div>
							</li>
							<li><label class="label_name">移动电话：</label><span class="add_name"><input  value="`+data.data.phone+`" name="phone"  type="text"  class="text_add"/></span><div class="prompt r_f"></div></li>
																<div class="control-group" style="width:300px">
																<label for="inputPassword" class="control-label">所在地：</label>
																<div class="controls">
																	<div data-toggle="distpicker">
																		<div class="form-group area">
																			<input type="text" name="province" value="`+data.data.province+`"></input>
																		</div>
																		<div class="form-group area">
																			<input type="text" name="city" value="`+data.data.city+`"></input>
																		</div>
																		<div class="form-group area">
																			<input type="text" name="county" value="`+data.data.county+`"></input>
																		</div>
																	</div>
																</div>
															</div>
							<li><label class="label_name">状&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;态：</label><span class="add_name">
							<label><input name="Disable" type="radio" value="0" `+(data.data.Disable ? '':'checked') +`  class="ace"><span class="lbl">开启</span></label>&nbsp;&nbsp;&nbsp;
							<label><input name="Disable" type="radio"  value="1"  `+(data.data.Disable ? 'checked':'') +`  class="ace"><span class="lbl">关闭</span></label></span><div class="prompt r_f"></div></li>
							</form>
							</ul>`;
		$('#edit_menber_style').html(' '); 	
		$('#edit_menber_style').append(str);
			}
		});
	  layer.open({
        type: 1,
        title: '修改用户信息',
		maxmin: true, 
		shadeClose:false, //点击遮罩关闭层
        area : ['800px' , ''],
        content:$('#edit_menber_style'),
		
		btn:['提交','取消'],
		yes:function(index,layero){	
		 var num=0;
		  var str="";
		  if(num>0){  return false;}	 	
          else{
			  layer.alert('修改成功!',{
               title: '提示框',				
			icon:1,		
			  });
			   $(".form").submit();
			   layer.close(index);	
		  }		  		     				
		}
    });
}
/*用户-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$(obj).parents("tr").remove();
    $.ajax("/root/delUser?id="+id)
		layer.msg('已删除!',{icon:1,time:1000});
	});
}
function dels(){
    var checked = [];
       $('input:checkbox:checked').each(function() {
            checked.push($(this).val());
        });
        for(let i=0;i<checked.length;i++){
            $.ajax("/root/delUser?id="+checked[i]);
        }
        $('input:checkbox:checked').parents("tr").remove();
        layer.msg('已删除!',{icon:1,time:1000});
         
}
laydate({
    elem: '#start',
    event: 'focus' 
});

</script>