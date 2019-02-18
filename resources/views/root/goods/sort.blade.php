<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title></title>
  <link rel="stylesheet" href="/css/layui.css">
  <style>
        .layui-btn-group{
            float: right;
        }
        .layui-btn-container{
            border: 1px solid #ddd;
            background-color: #f2f2f2;
        }
        .head{
            margin: 10px 5px;
        }
    </style>
</head>
<body>
 
<!-- 你的HTML代码 -->
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
  <legend>分类管理</legend>
</fieldset>
<div class="layui-btn-container">
    <button data-method="notice" class="layui-btn head">添加根级分类</button>
</div>

<br><br>

<div class="layui-collapse" lay-accordion="">
@foreach($data as $a)
  <div class="layui-colla-item">
    <h2 class="layui-colla-title">
        {{$a['name']}}
        <div class="layui-btn-group">
                <button class="layui-btn layui-btn-sm btn-add" data-id="{{$a['id']}}" ><i class="layui-icon"></i></button>
                <button class="layui-btn layui-btn-sm btn-update" data-id="{{$a['id']}}" data-categoryname="{{$a['name']}}"><i class="layui-icon"></i></button>
                <button class="layui-btn layui-btn-sm btn-delete" data-id="{{$a['id']}}" data-deletecategoryname="{{$a['name']}}"><i class="layui-icon"></i></button>
            </div>
    </h2>
    <div class="layui-colla-content">
    
      <div class="layui-collapse" lay-accordion="">
      @foreach($a['level2'] as $b)
        <div class="layui-colla-item">
          <h2 class="layui-colla-title">
            {{$b['name']}}
            <div class="layui-btn-group">
                <button class="layui-btn layui-btn-primary layui-btn-sm btn-add" data-id="{{$b['id']}}"><i class="layui-icon"></i></button>
                <button class="layui-btn layui-btn-primary layui-btn-sm btn-update" data-id="{{$b['id']}}" data-categoryname="{{$b['name']}}"><i class="layui-icon"></i></button>
                <button class="layui-btn layui-btn-primary layui-btn-sm btn-delete" data-id="{{$b['id']}}" data-deletecategoryname="{{$b['name']}}"><i class="layui-icon"></i></button>
            </div>
          </h2>
          <div class="layui-colla-content">
            
            <div class="layui-collapse" lay-accordion="">
            @foreach($b['level3'] as $c)
              <div class="">
                <h2 class="layui-colla-title">
                    {{$c['name']}}
                    <div class="layui-btn-group">
                            <button class="layui-btn layui-btn-primary layui-btn-sm btn-update" data-id="{{$c['id']}}" data-categoryname="{{$c['name']}}"><i class="layui-icon"></i></button>
                            <button class="layui-btn layui-btn-primary layui-btn-sm btn-delete" data-id="{{$c['id']}}" data-deletecategoryname="{{$c['name']}}"><i class="layui-icon"></i></button>
                      </div>
                </h2>
             
              </div>
              @endforeach
            </div>
            
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
 @endforeach
</div>
 
<br>

</body>
</html>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script src="/js/layui.js" charset="utf-8"></script>
<script>
    layui.use(['element', 'layer'], function() {
        var element = layui.element;
        var layer = layui.layer;
        
        //监听折叠
        element.on('collapse(test)', function (data) {
            layer.msg('展开状态：' + data.show);
        });


        //触发事件
        var active = {
            notice: function () {
                //示范一个公告层
                layer.open({
                    type: 1
                    ,
                    title: false //不显示标题栏
                    ,
                    closeBtn: true
                    ,
                    area: '500px;'
                    ,
                    shade: 0.8
                    ,
                    id: 'LAY_layuipro' //设定一个id，防止重复弹出
                    ,
                    btnAlign: 'c'
                    ,
                    shade: 0.7
                    ,
                    moveType: 1 //拖拽模式，0或者1
                    ,
                    content: ' <form class="layui-form" action="/root/addSecond" method="post" > @csrf  <input type="hidden" name="id" value="0"> <div style="margin-top:10px; margin-right:20px;" class="layui-form-item"><label class="layui-form-label">分类名称：</label><div class="layui-input-block"><input type="hidden" value=""></input><input type="text" name="name" lay-verify="title" autocomplete="off" placeholder="请输入名称" class="layui-input"> <button type="submit" class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button> <button type="reset" class="layui-btn layui-btn-primary">重置</button> </div></div></form> '
                    ,
                    success: function (layero) {
                        var btn = layero.find('.layui-layer-btn');
                    }
                });
            },
            add: function (id) {
          
                //示范一个公告层
                layer.open({
                    type: 1
                    ,
                    title: false //不显示标题栏
                    ,
                    closeBtn: true
                    ,
                    area: '500px;'
                    ,
                    shade: 0.8
                    ,
                    id: 'LAY_layuipro' //设定一个id，防止重复弹出
                    ,
                    btnAlign: 'c'
                    ,
                    shade: 0.7
                    ,
                    moveType: 1 //拖拽模式，0或者1
                    ,
                    content: '<form class="layui-form" action="/root/addSecond" method="post"> @csrf <input type="hidden" name="id" value="'+id+'"> <div style="margin-top:10px; margin-right:20px;" class="layui-form-item"><label class="layui-form-label">分类名称：</label><div class="layui-input-block"><input type="text" name="name" lay-verify="title" autocomplete="off" placeholder="请输入名称" class="layui-input"> <button type="submit" class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button> <button type="reset" class="layui-btn layui-btn-primary">重置</button> </div></div> </form>'
                    ,
                    success: function (layero) {
                        var btn = layero.find('.layui-layer-btn');
                    }
                });
            },
            update: function (id,name) {
                //示范一个公告层
                layer.open({
                    type: 1
                    ,
                    title: false //不显示标题栏
                    ,
                    closeBtn: true
                    ,
                    area: '500px;'
                    ,
                    shade: 0.8
                    ,
                    id: 'LAY_layuipro' //设定一个id，防止重复弹出
                    ,
                    btnAlign: 'c'
                    ,
                    shade: 0.7
                    ,
                    moveType: 1 //拖拽模式，0或者1
                    ,
                    content: '<form class="layui-form" action="/root/editSecond" method="post"> @csrf <input type="hidden" name="id" value="'+id+'"> <div style="margin-top:10px; margin-right:20px;" class="layui-form-item"><label class="layui-form-label">分类名称：</label><div class="layui-input-block"><input type="text" value="'+name+'" name="name" lay-verify="title" autocomplete="off" placeholder="请输入名称" class="layui-input"> <button type="submit" class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button> <button type="reset" class="layui-btn layui-btn-primary">重置</button> </div></div> </form>'
                    ,
                    success: function (layero) {
                        var btn = layero.find('.layui-layer-btn');
                    }
                });
            },
            delete: function (id,name) {
                //示范一个公告层
                layer.open({
                    type: 1
                    ,
                    title: false //不显示标题栏
                    ,
                    closeBtn: true
                    ,
                    area: '500px;'
                    ,
                    shade: 0.8
                    ,
                    id: 'LAY_layuipro' //设定一个id，防止重复弹出
                    ,
                    btnAlign: 'c'
                    ,
                    shade: 0.7
                    ,
                    moveType: 1 //拖拽模式，0或者1
                    ,
                    content: '<form class="layui-form" action="/root/delSecond" method="post"> @csrf <input type="hidden" name="id" value="'+id+'"> <div style="margin-top:10px; margin-right:20px;" class="layui-form-item"><label class="layui-form-label">分类名称：</label> <div class="name">"'+name+'"</div> <div class="layui-input-block">  <button type="submit" class="layui-btn" lay-submit lay-filter="formDemo">确定删除</button> </div></div> </form>'
                    ,
                    success: function (layero) {
                        var btn = layero.find('.layui-layer-btn');
                    }
                });
            }

        }

        let btns = document.querySelectorAll(".layui-btn");
        for (let i = 0; i < btns.length; i++) {
            btns[i].onclick = function (event) {
                event.stopPropagation();
                event.cancelBubble = true
            }
        }
        let btnadd = document.querySelectorAll(".btn-add")
        for(let i=0;i<btnadd.length;i++){
            btnadd[i].onclick = function() {
                let id = this.dataset.id
                active.add(id)
            }
        }
        let btnupdate = document.querySelectorAll(".btn-update")
        for(let i=0;i<btnupdate.length;i++){
            btnupdate[i].onclick = function() {
                let id = this.dataset.id
                let name = this.dataset.categoryname
                active.update(id,name)
            }
        }
        let btndelete = document.querySelectorAll(".btn-delete")
        for(let i=0;i<btndelete.length;i++){
            btndelete[i].onclick = function() {
                let id = this.dataset.id
                let name = this.dataset.deletecategoryname
                active.delete(id,name)
            }
        }

        let head = document.querySelector(".head")
        head.onclick = function () {
            active.notice()
        }
    })



</script>



    