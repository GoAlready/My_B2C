<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi"
    />
    <link rel="shortcut icon" href="/static/admin/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/css/font.css">
    <link rel="stylesheet" href="/css/xadmin.css">

    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="/js/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .layui-form input[type=checkbox] {
            display: block; 
        }
        .chcBox_Width {
            width: 18px;
            height:18px;
            z-index: 10000;
            background-color: red;
        }

        .li_width {
            width: 150px;
        }

        .li_width1 {
            width: 150px;
        }

        .guige_ul {
            padding-left: 20px;
            background-color: #F8F8F8;
        }

        .table_head {
            line-height: 23px;
            margin-left: 20px;
        }
        .Father_Item0>li {
            float: left;

        }

        .Father_Item1>li {
            float: left;

        }
       .layui-form-checkbox {
            display: none;
        }

        #demo2 img {
            border: 1px solid red;
            width:200px;
            height:200px;
        }
        #demo1 img {
            border: 1px solid red;
            width:200px;
            height:200px;
        }
    </style>
</head>

<body>
    <div class="x-body">
        <div class="layui-container">
            <form action="{{route('add_goods')}}" class="layui-form" method="POST" enctype="multipart/form-data">
                <div class="layui-form-item">
                    <label class="layui-form-label">
                        <span class="x-red">*</span>选择类目
                    </label>
                    <div class="layui-input-inline">
                        <select id="type1_id" name="type1_id" lay-filter="type1_id">
                            <option value="">选择一级分类</option>
                            @foreach($lv1 as $v)
                            @if($goods['type1_id']==$v['id'])
                            <option selected='selected' value="{{$v['id']}}">{{$v['name']}}</option>
                            @else
                            <option value="{{$v['id']}}">{{$v['name']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>商品所属一级类目
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">
                        <span class="x-red">*</span>选择类目
                    </label>
                    <div class="layui-input-inline">
                        <select name="type2_id" lay-verify="required" id="type2_id" lay-filter="type2_id">
                            <option value="">选择二级分类</option>
                        </select>
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>商品所属二级类目
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">
                        <span class="x-red">*</span>选择类目
                    </label>
                    <div class="layui-input-inline">
                        <select name="type3_id" lay-verify="required" id="type3_id" lay-filter="type3_id">
                            <option value="">选择三级分类</option>
                        </select>
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>商品叶子类目
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">
                        <span class="x-red">*</span>选择品牌
                    </label>
                    <div class="layui-input-inline">
                        <select name="brand_id" lay-filter="brand_id" id="brand_id">
                            <option value="">选择品牌</option>
                        </select>
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>商品商品品牌
                    </div>
                </div>
                <div class="layui-row" id="attr">

                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"> <span class="x-red">*</span>商品标题</label>
                    <div class="layui-input-block">
                        <input type="text" value="{{$goods['goods_name']}}" name="goods_name" lay-verify="title" autocomplete="off" placeholder="请输入标题" class="layui-input">
                    </div>
                </div>
                <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
                        <legend>上传商品封面</legend>
                </fieldset>
                 <div class="layui-upload">
                    <label for="cover" type="button" class="layui-btn" id="test2">上传商品封面</label> 
                    <input type="file" id="cover" name="cover" onchange="addCover(this)"   style="display: none;">
                    <div  style="margin-top:20px;"></div>
                    预览图：
                   
                    <div id="demo1" style="margin-top:20px; ">
                      
                    </div>

                
                <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
                        <legend>上传5张主图</legend>
                </fieldset>
                       
                <div class="layui-upload">
                    <label for="image" type="button" class="layui-btn" id="test2">多图片上传</label> 
                    <input type="file" id="image" name="image[]" onchange="addIamge(this)" multiple  style="display: none;">
                    <div  style="margin-top:20px;"></div>
                    预览图：
                   
                    <div id="demo2" style="margin-top:20px;">
                      
                    </div>
                </div>
                    
                <div class="layui-form-item">
                    <div id="navtab1" style="width: 100%;">
                        <div title="扩展信息" tabid="tabItem3">
                            <div id="Div1">
                                <div position="center">
                                    <div style="padding: 5px 8px;" class="div_content">
                                        <div class="div_title">
                                            <span class="infor_title"> </span>产品规格
                                            <div>
                                                <hr/>
                                            </div>
                                        </div>
                                      
                                        <div class="div_contentlist">
                                            <div class="layui-col-md12">
                                                <ul class="Father_Title">
                                                    <li>颜色分类：</li>
                                                </ul>
                                                <ul class="Father_Item0" style="padding-left: 20px; background-color: #F8F8F8;">
                                                    <li class="li_width1">
                                                    <div class="layui-form-item">
                                                        <label>
                                                            <input id="Checkbox3" type="checkbox" class="chcBox_Width" value="白色" />白色
                                                            <span class="li_empty"> </span>
                                                        </label>
                                                    </li>
                                                    <li class="li_width">
                                                        <label>
                                                            <input id="Checkbox1" type="checkbox" class="chcBox_Width" value="红色" />红色
                                                            <span class="li_empty"> </span>
                                                        </label>
                                                    </li>
                                                    <li class="li_width">
                                                        <label>
                                                            <input id="Checkbox2" type="checkbox" class="chcBox_Width" value="粉色" />粉色
                                                        </label>
                                                    </li>
                                                    <li class="li_width">
                                                        <label>
                                                            <input id="Checkbox4" type="checkbox" class="chcBox_Width" value="绿色" />绿色
                                                            <span class="li_empty"> </span>
                                                        </label>
                                                    </li>
                                                    <li class="li_width">
                                                        <label>
                                                            <input id="Checkbox5" type="checkbox" class="chcBox_Width" value="黄色" />黄色
                                                            <span class="li_empty"> </span>
                                                        </label>
                                                    </li>
                                                    <li class="li_width">
                                                        <label>
                                                            <input id="Checkbox6" type="checkbox" class="chcBox_Width" value="黑色" />黑色
                                                            <span class="li_empty"> </span>
                                                        </label>
                                                    </li>
                                                    <li class="li_width">
                                                        <label>
                                                            <input id="Checkbox7" type="checkbox" class="chcBox_Width" value="紫色" />紫色
                                                            <span class="li_empty"> </span>
                                                        </label>
                                                    </li>

                                                </ul>
                                            </div>
                                            <br>
                                            <div class="layui-col-md12">
                                                <ul class="Father_Title">
                                                    <li>尺寸：</li>
                                                </ul>
                                                <ul class="Father_Item1" style="padding-left: 20px; background-color: #F8F8F8;">

                                                    <li class="li_width">
                                                        <label>
                                                            <input id="Checkbox8" type="checkbox" class="chcBox_Width" value="145/80A" />145/80A
                                                        </label>
                                                    </li>
                                                    <li class="li_width">
                                                        <label>
                                                            <input id="Checkbox9" type="checkbox" class="chcBox_Width" value="145/80A" />150/80A
                                                        </label>
                                                    </li>
                                                    <li class="li_width">
                                                        <label>
                                                            <input id="Checkbox10" type="checkbox" class="chcBox_Width" value="155/80A" />155/80A
                                                            <span class="li_empty"> </span>
                                                        </label>
                                                    </li>
                                                    <li class="li_width">
                                                        <label>
                                                            <input id="Checkbox10" type="checkbox" class="chcBox_Width" value="160/84A" />160/84A
                                                            <span class="li_empty"> </span>
                                                        </label>
                                                    </li>
                                                    <li class="li_width">
                                                        <label>
                                                            <input id="Checkbox10" type="checkbox" class="chcBox_Width" value="165/88A" />165/88A
                                                            <span class="li_empty"> </span>
                                                        </label>
                                                    </li>
                                                    <li class="li_width">
                                                        <label>
                                                            <input id="Checkbox10" type="checkbox" class="chcBox_Width" value="170/92A" />170/92A
                                                            <span class="li_empty"> </span>
                                                        </label>
                                                    </li>
                                                    <li class="li_width">
                                                        <label>
                                                            <input id="Checkbox10" type="checkbox" class="chcBox_Width" value="175/96A" />175/96A
                                                            <span class="li_empty"> </span>
                                                        </label>
                                                    </li>
                                                    <li class="li_width">
                                                        <label>
                                                            <input id="Checkbox10" type="checkbox" class="chcBox_Width" value="175/100A" />175/100A
                                                            <span class="li_empty"> </span>
                                                        </label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="div_contentlist2">
                                            <ul>
                                                <li>
                                                    <div id="createTable">
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="Add_p_s" style="margin-bottom:20px;">
                    <label class="form-label col-2">一口价格：</label>
                    <div class="formControls col-2"><input type="text" class="input-text" value="{{$goods['spu_price']}}" placeholder="" id="" name="spu_price">元</div>
                </div> 
                <textarea id="demo" name="description">{{$goods['description']}}</textarea>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    @csrf
                    <button class="layui-btn layui-btn-danger" lay-filter="add" id="sub_btn">
                        确认修改
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        layui.use('form', function () {
            var form = layui.form;
            var lv2 = "{{$goods['type2_id']}}";
            var lv3 = "{{$goods['type3_id']}}";
            var brand = "{{$goods['brand_id']}}";
            //各种基于事件的操作，下面会有进一步介绍
            form.on('select(type1_id)', function (data) {
                var id = data.value;
                $("#type3_id").html('<option value="">请选择三级分类</option>');
                if (id != "") {
                    $.ajax({
                        type: "GET",
                        url: "/root/ajax_type?id=" + id,
                        dataType: "json",
                        success: function (data) {
                            var str = '<option value="">请选择二级分类</option>';
                            for (var i = 0; i < data.data.length; i++) {
                                if(lv2==data.data[i].id){
                                    str += '<option selected="selected" value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
                                }else{
                                    str += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
                                }
                                
                            }
                            
                            // 把拼好的 option 放到第二个下拉框中
                            $("#type2_id").html(str);
                            form.render('select');
                        }
                    });
                }

            });
            form.on('select(type2_id)', function (data) {
                var id = data.value;
                if (id != "") {
                    $.ajax({
                        type: "GET",
                        url: "/root/ajax_type?id=" + id,
                        dataType: "json",
                        success: function (data) {
                            var str = '<option value="">请选择三级分类</option>';
                            for (var i = 0; i < data.data.length; i++) {
                               if(lv3==data.data[i].id){
                                    str += '<option selected="selected" value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
                                }else{
                                    str += '<option value="' + data.data[i].id + '">' + data.data[i].name + '</option>';
                                }
                            }
                            // 把拼好的 option 放到第三个下拉框中
                            $("#type3_id").html(str);
                            form.render('select');
                        }
                    });
                }

            });
            form.on('select(type3_id)', function (data) {
                var id = data.value;
                if (id != "") {
                    $.ajax({
                        type: "GET",
                        url: "/root/ajax_brand?id=" + id,
                        dataType: "json",
                        success: function (data) {
                            var str = '<option value="">请选择商品品牌</option>';
                            for (var i = 0; i < data.data.length; i++) {
                                if(brand==data.data[i].id){
                                    str += '<option selected="selected" value="' + data.data[i].id + '">' + data.data[i].brand_name + '</option>';
                                }else{
                                     str += '<option value="' + data.data[i].id + '">' + data.data[i].brand_name + '</option>';
                                }
                            }
                            // 把拼好的 option 放到第三个下拉框中
                            $("#brand_id").html(str);
                            form.render();
                        }
                    });
                }

            });
        });


    </script>
    <script>
        // { if session('status') != null}
        // alert('添加成功');
        // parent.location.href = '/admin/brand/index';

        // {/if}

        function addCover(obj){
                $('#demo2').html('');
                var file = obj.files[0];
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload=function(e){
                //的base64编码格式的地址
                    $('#demo1').append($('<img>').attr('src',e.target.result))
                }

            
        }
        function addIamge(obj){
            console.log(obj.files.length);
            if(obj.files.length>5){
                alert('图片过多');
                location.href = '/root/picture_add';
            }
            $('#demo2').html('');
            
            for(i=0;i<obj.files.length;i++){
                var file = obj.files[i];
                
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload=function(e){
                //的base64编码格式的地址
                    $('#demo2').append($('<img>').attr('src',e.target.result))
                }

            }
        }


        layui.use('layedit', function(){
            var layedit = layui.layedit;
            layedit.set({
            uploadImage: {
                url: '/admin/goods/images' //接口url
                ,type: 'post' //默认post
                }
            });
            layedit.build('demo',{
                tool: ['strong','italic','underline','del','link','image','left', 'center', 'right', '|', 'face']
            }); //建立编辑器
        });

    </script>
    <script>
        $(function () {
            //SKU信息
            $(".div_contentlist label").bind("change", function () {
                // alert('123');
                step.Creat_Table();
            });
            var step = {
                //SKU信息组合
                Creat_Table: function () {

                    step.hebingFunction();
                    var SKUObj = $(".Father_Title");
                    //var skuCount = SKUObj.length;//
                    var arrayTile = new Array();　//标题组数
                    var arrayInfor = new Array();　//盛放每组选中的CheckBox值的对象 
                    var arrayColumn = new Array();//指定列，用来合并哪些列
                    var bCheck = true;//是否全选
                    var columnIndex = 0;
                    $.each(SKUObj, function (i, item) {
                        arrayColumn.push(columnIndex);
                        columnIndex++;

                        arrayTile.push(SKUObj.find("li").eq(i).html().replace("：", ""));
                        var itemName = "Father_Item" + i;
                        //选中的CHeckBox取值
                        var order = new Array();
                        $("." + itemName + " input[type=checkbox]:checked").each(function () {
                            order.push($(this).val());
                        });
                        arrayInfor.push(order);

                        if (order.join() == "") {
                            bCheck = false;
                        }
                        //var skuValue = SKUObj.find("li").eq(index).html();
                    });

                    //开始创建Table表            
                    if (bCheck == true) {
                        var RowsCount = 0;
                        $("#createTable").html("");
                        var table = $("<table id=\"process\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\" style=\"width:100%;padding:5px;margin-left: 20px;\"></table>");
                        table.appendTo($("#createTable"));
                        var thead = $("<thead></thead>");
                        thead.appendTo(table);
                        var trHead = $("<tr></tr>");
                        trHead.appendTo(thead);
                        //创建表头
                        $.each(arrayTile, function (index, item) {
                            var td = $("<td>" + item + "</td>");
                            td.appendTo(trHead);
                        });
                        var itemColumHead = $("<td  style=\"width:70px;\">价格</td><td style=\"width:70px;\">数量</td> ");
                        itemColumHead.appendTo(trHead);
                        //var itemColumHead2 = $("<td >商家编码</td><td >商品条形码</td>");
                        //itemColumHead2.appendTo(trHead);

                        var tbody = $("<tbody></tbody>");
                        tbody.appendTo(table);

                        ////生成组合
                        var zuheDate = step.doExchange(arrayInfor);
                        if (zuheDate.length > 0) {
                            //创建行
                            $.each(zuheDate, function (index, item) {
                                var td_array = item.split(",");
                                var tr = $("<tr></tr>");
                                tr.appendTo(tbody);
                                $.each(td_array, function (i, values) {
                                    var td = $("<td><input name=\"attr[]\" class=\"l-text\" type=\"text\" value=" + values + "></td>");
                                    td.appendTo(tr);
                                });
                                var td1 = $("<td ><input name=\"price[]\" class=\"l-text\" type=\"text\" value=\"\"></td>");
                                td1.appendTo(tr);
                                var td2 = $("<td ><input name=\"count[]\" class=\"l-text\" type=\"text\" value=\"\"></td>");
                                td2.appendTo(tr);
                                //var td3 = $("<td ><input name=\"Txt_NumberSon\" class=\"l-text\" type=\"text\" value=\"\"></td>");
                                //td3.appendTo(tr);
                                //var td4 = $("<td ><input name=\"Txt_SnSon\" class=\"l-text\" type=\"text\" value=\"\"></td>");
                                //td4.appendTo(tr);
                            });
                        }
                        //结束创建Table表
                        arrayColumn.pop();//删除数组中最后一项
                        //合并单元格
                        $(table).mergeCell({
                            // 目前只有cols这么一个配置项, 用数组表示列的索引,从0开始
                            cols: arrayColumn
                        });
                    }
                },//合并行
                hebingFunction: function () {

                    $.fn.mergeCell = function (options) {
                        return this.each(function () {
                            var cols = options.cols;
                            for (var i = cols.length - 1; cols[i] != undefined; i--) {
                                // fixbug console调试 
                                console.debug(cols[i]);



                                mergeCell($(this), cols[i]);
                            }
                            dispose($(this));
                        });
                    };
                    // 如果对javascript的closure和scope概念比较清楚, 这是个插件内部使用的private方法            
                    function mergeCell($table, colIndex) {
                        $table.data('col-content', ''); // 存放单元格内容 
                        $table.data('col-rowspan', 1); // 存放计算的rowspan值 默认为1 
                        $table.data('col-td', $()); // 存放发现的第一个与前一行比较结果不同td(jQuery封装过的), 默认一个"空"的jquery对象 
                        $table.data('trNum', $('tbody tr', $table).length); // 要处理表格的总行数, 用于最后一行做特殊处理时进行判断之用 
                        // 我们对每一行数据进行"扫面"处理 关键是定位col-td, 和其对应的rowspan 
                        $('tbody tr', $table).each(function (index) {
                            // td:eq中的colIndex即列索引 
                            var $td = $('td:eq(' + colIndex + ')', this);
                            // 取出单元格的当前内容 
                            var currentContent = $td.html();
                            // 第一次时走此分支 
                            if ($table.data('col-content') == '') {
                                $table.data('col-content', currentContent);
                                $table.data('col-td', $td);
                            } else {
                                // 上一行与当前行内容相同 
                                if ($table.data('col-content') == currentContent) {
                                    // 上一行与当前行内容相同则col-rowspan累加, 保存新值 
                                    var rowspan = $table.data('col-rowspan') + 1;
                                    $table.data('col-rowspan', rowspan);
                                    // 值得注意的是 如果用了$td.remove()就会对其他列的处理造成影响 
                                    $td.hide();
                                    // 最后一行的情况比较特殊一点 
                                    // 比如最后2行 td中的内容是一样的, 那么到最后一行就应该把此时的col-td里保存的td设置rowspan 
                                    if (++index == $table.data('trNum'))
                                        $table.data('col-td').attr('rowspan', $table.data('col-rowspan'));
                                } else { // 上一行与当前行内容不同 
                                    // col-rowspan默认为1, 如果统计出的col-rowspan没有变化, 不处理 
                                    if ($table.data('col-rowspan') != 1) {
                                        $table.data('col-td').attr('rowspan', $table.data('col-rowspan'));
                                    }
                                    // 保存第一次出现不同内容的td, 和其内容, 重置col-rowspan 
                                    $table.data('col-td', $td);
                                    $table.data('col-content', $td.html());
                                    $table.data('col-rowspan', 1);
                                }
                            }
                        });
                    }
                    // 同样是个private函数 清理内存之用 
                    function dispose($table) {
                        $table.removeData();
                    }
                },
                //组合数组
                doExchange: function (doubleArrays) {

                    var len = doubleArrays.length;
                    if (len >= 2) {
                        var arr1 = doubleArrays[0];
                        var arr2 = doubleArrays[1];
                        var len1 = doubleArrays[0].length;
                        var len2 = doubleArrays[1].length;
                        var newlen = len1 * len2;
                        var temp = new Array(newlen);
                        var index = 0;
                        for (var i = 0; i < len1; i++) {
                            for (var j = 0; j < len2; j++) {
                                temp[index] = arr1[i] + "," + arr2[j];
                                index++;
                            }
                        }
                        var newArray = new Array(len - 1);
                        newArray[0] = temp;
                        if (len > 2) {
                            var _count = 1;
                            for (var i = 2; i < len; i++) {
                                newArray[_count] = doubleArrays[i];
                                _count++;
                            }
                        }
                        //console.log(newArray);
                        return step.doExchange(newArray);
                    }
                    else {
                        return doubleArrays[0];
                    }
                }
            }
            return step;
        })
    </script>


</body>

</html>