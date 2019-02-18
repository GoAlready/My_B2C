<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加品牌</title>
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
 <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/css/style.css"/>       
        <link rel="stylesheet" href="/assets/css/ace.min.css" />
        <link rel="stylesheet" href="/assets/css/font-awesome.min.css" />
        <link href="Widget/icheck/icheck.css" rel="stylesheet" type="text/css" />
		<!--[if IE 7]>
		  <link rel="stylesheet" href="/assets/css/font-awesome-ie7.min.css" />
		<![endif]-->
        <!--[if lte IE 8]>
		  <link rel="stylesheet" href="/assets/css/ace-ie.min.css" />
		<![endif]-->
	    <script src="/js/jquery-1.9.1.min.js"></script>
        <script src="/assets/js/bootstrap.min.js"></script>
        <script src="/assets/js/typeahead-bs2.min.js"></script>
         <script src="/assets/layer/layer.js" type="text/javascript"></script>
        <script type="text/javascript" src="/Widget/swfupload/swfupload.js"></script>
        <script type="text/javascript" src="/Widget/swfupload/swfupload.queue.js"></script>
        <script type="text/javascript" src="/Widget/swfupload/swfupload.speed.js"></script>
        <script type="text/javascript" src="/Widget/swfupload/handlers.js"></script>
</head>

<body>
<div class=" clearfix">
 <div id="add_brand" class="clearfix">
 <div class="left_add">
   <div class="title_name">添加品牌</div>
   <ul class="add_conent">
    <form action="{{route('addTo_brand')}}" method="post" enctype="multipart/form-data"> 
    {{csrf_field()}}
    <li class=" clearfix"><label class="label_name"><i>*</i>品牌名称：</label> <input name="brand_name" type="text" class="add_text"/></li>
    <li class=" clearfix"><label class="label_name"><i>*</i>品牌Logo:</label> <input name="brand_logo" type="file" class="add_text"/></li>
    <li class=" clearfix"><label class="label_name"><i>*</i>一级分类:</label> 
      <select name="type1" id="">
      @foreach($type as $v)
            <option value="{{$v['id']}}">{{$v['name']}}</option>
      @endforeach
      </select>
    </li>
    <li class=" clearfix"><label class="label_name"><i>*</i>二级分类:</label> 
      <select name="type2" >
      </select>
    </li>
    <li class=" clearfix"><label class="label_name"><i>*</i>三级分类:</label> 
      <select name="type3" >
      </select>
    </li>
    </li>
         <input name="" type="submit"  class="btn btn-warning" value="保存"/><input name="" type="reset" value="取消" class="btn btn-warning"/>
    </from>
   </ul>
 </div>
    </div>
</body>
</html>
<script type="text/javascript">
     // 三级联动
    var id = $("select[name=type1]").val();
    $("select[name=type1]").change(function () {
        if ($(this).val() != '') {
            var parent = $(this).val();
            ajax_get(parent, 2)
        }
    })
    $("select[name=type2]").change(function () {
        if ($(this).val() != '') {
            var parent = $(this).val();
            ajax_get2(parent, 3)
        }
    })
    var temp = 0;
    function ajax_get(parent, num) {
        var str = '';
        if (num == 3) {
            temp++
        }
        else {
            temp = 0;
        }
        if (temp > 1) {
            return false;
        }
        $.ajax({
            type: "GET",
            url: "/root/ajax_type?id=" + parent,
            dataType: "json",
            success: function (data) {
                for (let i = 0; i < data.data.length; i++) {
                    str += '<option  value="' + data.data[i].id + '">' + data.data[i].name + '</option>'
                }
                $("select[name=type" +num+ "]").html(str);
                var three_id = $("select[name=type2]").val();
                ajax_get(three_id, 3)
            }
        })
    }
    function ajax_get2(parent, num) {
        var str = '';
        $.ajax({
            type: "GET",
            url: "/root/ajax_type?id=" + parent,
            dataType: "json",
            success: function (data) {
                for (let i = 0; i < data.data.length; i++) {
                    str += '<option  value="' + data.data[i].id + '">' + data.data[i].name + '</option>'
                }
                $("select[name=type" + num + "]").html(str);
            }
        })
    }
    ajax_get(id, 2)

     $(document).ready(function(){
 $(".left_add").height($(window).height()-60); 
  $(".right_add").width($(window).width()-600);
   $(".right_add").height($(window).height()-60);
  $(".select").height($(window).height()-195); 
  $("#select_style").height($(window).height()-220); 
 //当文档窗口发生改变时 触发  
    $(window).resize(function(){
		  $(".right_add").width($(window).width()-600); 
		 $(".left_add").height($(window).height()-60);
		 $(".right_add").height($(window).height()-60); 
		 $(".select").height($(window).height()-195); 
		$("#select_style").height($(window).height()-220); 
	});
	 })

</script>

