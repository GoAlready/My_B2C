<?php

namespace App\Http\Controllers\Root;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\article_type;   
use App\Models\root\article;
class ArticleController extends Controller
{
    //文章
        // 文章列表
        public function article_list(Request $req){
            $type = article_type::get();
            $num = article::getNum();
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $data = article::getAll($id,$req);
            }else{
                $data = article::getAll(0,$req);
            }
            return view("root.article.article_list",[
            'data'=>$data,
            'type'=>$type,
            'num'=>$num,
            'req'=>$req
            ]);
        }

        // 添加文章
        public function article_add(){
            $type = article_type::get();
             return view("root.article.article_add",[
                 'type'=>$type
             ]);
        }
        // 修改文章
        public function article_edit(){
            $type = article_type::get();
            $data = article::find($_GET['id']);
             return view("root.article.article_edit",[
                 'type'=>$type,
                 'data'=>$data
             ]);
        }
        // 修改表单
        public function article_doEdit(Request $req){
            $id = $_GET['id'];
            article::articleEdit($id,$req->all());
            return redirect()->route('article_list');
        }
        // 添加文章
        public function addArticle(Request $req){
            $data = $req->all();
            article::create($data);
            return redirect()->route('article_list');
            
        }
        // 删除文章
        public function article_delete(){
            $id = $_GET['id'];
             article::destroy($id);
        }
        // 分类管理
        public function article_Sort(){
             $type = article_type::get();
             return view("root.article.article_Sort",[
                 'type'=>$type
             ]);
        }
        // 添加分类
        public function addType(){
            return view('root.article.addType');
        }
        // 添加分类表单
        public function addDoType(Request $req){
            $data = $req->all();
            article_type::create($data);
            return redirect()->route('article_Sort');
        }

        // 修改分类
        public function editType(){
            $data =  article_type::find($_GET['id']);
            return view('root.article.editType',[
                'data' => $data
            ]);
        }
        // 修改表单
        public function editDoType(Request $req){
            $article = article_type::find($_GET['id']);
            $article->fill($req->all());
            $article->save();
            return redirect()->route('article_Sort');
        }
        // 删除分类
        public function delType(){
            $id = $_GET['id'];
            article::where('cat_id',$id)->delete();
            article_type::destroy($id);
        }


}
