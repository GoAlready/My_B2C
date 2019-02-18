<?php
namespace App\Http\Controllers\Root;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\goods_type;
use App\Models\goods_brand;
use App\Models\goods_sku_attr;
use App\Models\root\goods_brand_type;
use App\Models\goods;
use App\Models\root\goods_sku;
use Storage;
use DB;
class GoodsController extends Controller
{
     // 商品/品牌/分类
        // 商品列表
        public function products_List(){
            $goods = goods::get();
             return view("root.goods.products_List",[
                 'goods'=>$goods
             ]);
        }
        //  添加商品
        public function picture_add(){
            $lv1 = goods_type::where("pid",0)->get();
             return view("root.goods.picture_add",[
                 'lv1'=>$lv1,
             ]);
        }
        // 添加商品表单
        public function add_goods(Request $req){
            //商品基本信息
            $goods = goods::create($req->all());
            $id = $goods['id'];
            //添加spu属性以及属性值
            goods_sku_attr::addAttr($req,$id);  
            // 上传封面
            goods::uploadCoverImg($req,$id);
            // 添加sku
            goods::addGoodsSku($req,$id);
            // 上传主图
            goods::uploadGoodsImg($req,$id);
            return redirect()->route('products_List');
        }
        // 修改商品
        public function editGoods(){
            $lv1 = goods_type::where("pid",0)->get();
            $goods = goods::find($_GET['id']);
            return view('root.goods.editGoods',[
                'lv1'=>$lv1,
                'goods'=>$goods
            ]);
        }
        // 修改商品表单
        public function editToGoods(Request $req){

        }
        // ajax 三级联动
        public function ajax_type(){
            $data = goods_type::where("pid",$_GET['id'])->get();
            return  json_encode([
                'data'=>$data
                ]);
        }
        // ajax品牌
        public function ajax_brand(){
            $data = DB::table('goods_brand_type')
                                ->select([ DB::raw('b.*')])
                                ->from('goods_brand_type as a')
                                ->join('goods_brand as b', 'b.id', '=', 'a.brand_id')
                                ->where('a.type_id',$_GET['id'])
                                ->get();
            return json_encode([
                'data'=>$data
                ]);
        }
        // 品牌管理
        public function brand_Manage(){
            $data = goods_brand::get();
             return view("root.goods.brand_Manage",[
                 'data'=>$data
             ]);
        }
        // 添加品牌
        public function add_Brand(){
            $type = goods_type::where('pid',0)->get();
             return view("root.goods.add_Brand",[
                 'type'=>$type
             ]);
        }
        // 添加品牌表单
        public function addTo_brand(Request $req){
            $logo = goods_brand::getLogoUrl($req);
            $brandId = goods_brand::insertGetId(['brand_name'=>$req->brand_name,'brand_logo'=>$logo]);
            goods_brand_type::insert(['brand_id'=>$brandId,'type_id'=>$req->type3]);
            return redirect()->route('brand_Manage');
        }
        // 删除品牌
        public function del_brand(){
            $brand = goods_brand::find($_GET['id']);
            Storage::delete($brand->brand_logo);
            goods_brand::destroy($_GET['id']);
        }
        // 品牌详情
        public function Brand_detailed(){
             return view("root.goods.brand_detailed");
        }
        //  分类管理
        public function sortList(){
            $data = goods_type::getCategory();
            return view("root.goods.sort",[
                    'data'=>$data
                ]);
        }
        // 添加分类
        public function addSecond(Request $req){
            goods_type::insert(['name'=>$req->name,'pid'=>$req->id]);
            return back();
        }
        // 删除分类以及子分类
        public function delSecond(Request $req){
            $data = goods_type::delCate($req->id);
            $arr = [];
            foreach($data as $v){
                $arr[] = $v['id'];
                foreach($v['level2'] as $k){
                    $arr[] = $k['id'];
                    foreach($k['level3'] as $j){
                        $arr[] = $j['id'];
                    }
                }
            }
            goods_type::whereIn('id',$arr)->delete();
            goods_type::destroy($req->id);
            return redirect()->route('sortList');
        }
        // 修改分类
        public function editSecond(Request $req){
            goods_type::where('id',$req->id)->update(['name'=>$req->name]);
            return back();
        }   
}
