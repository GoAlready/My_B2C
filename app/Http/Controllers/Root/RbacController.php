<?php

namespace App\Http\Controllers\Root;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\root\root;
use App\Models\root\root_role;
use App\Models\root\root_privilege;
use App\Models\root\root_root_role;
use App\Models\root\root_role_privilege;
use DB;
class RbacController extends Controller
{
    // 管理员管理
        // 权限列表
        // public function admin_privilege(){
        //      return view("root.admin.admin_privilege",[
        //          'user'=>$user
        //      ]);
        // }
        // 添加权限
        // public function privilege_add(){
        //      return view("root.admin.privilege_add");
        // }
        // 个人信息

        public function admin_info(){
             return view("root.admin.admin_info");
        }
        // // 权限管理
        public function admin_Competence(){
            $user = root_privilege::get();
            foreach($user as $k=>$v){
                if($v['parent_id']==0) continue;
                $user[$k]['par'] = root_privilege::select('pri_name')->where('id',$v['parent_id'])->first();
            }
             return view("root.admin.admin_Competence",[
                 'user'=>$user
             ]);
        }
        // 添加权限
        public function addPrivilege(){
            $privilege = root_privilege::where('parent_id',0)->get();
           return  view("root.admin.addPrivilege",[
               'privilege'=>$privilege
           ]);
        }
        // 添加表单
        public function add_privilege(Request $req){
            root_privilege::create($req->all());
            return redirect()->route('admin_Competence');
        }
        // 删除权限
        public function delPrivilege(){
            $id = $_GET['id'];
            root_privilege::where('parent_id',$id)->delete();
            root_privilege::destroy($id);
        }
        // 修改权限
        public function editPrivilege(){
            $privilege = root_privilege::where('parent_id',0)->get();
            $pri = root_privilege::find($_GET['id']);
            return view("root.admin.editPrivilege",[
               'privilege'=>$privilege,
               'pri'=>$pri
           ]);
        }
        // 修改权限表单
        public function editToPrivilege(Request $req){
            $id =$_GET['id'];
            $pri = root_privilege::find($id);
            $pri->fill($req->all());
            $pri->save();
             return redirect()->route('admin_Competence');
        }
         // 管理员列表
        
        public function administrator(){
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $admin = DB::select("select a.*,GROUP_CONCAT(c.role_name) pri_list from root as a  join root_root_role as b on a.id = b.root_id  join root_role as c on b.role_id = c.id  where b.role_id = {$id} group by a.id");
                
            }else{
                $admin = DB::select("select a.*,GROUP_CONCAT(c.role_name) pri_list from root as a  join root_root_role as b on a.id = b.root_id  join root_role as c on b.role_id = c.id  group by a.id");
            }
            //  select a.id , a.role_name ,count(b.root_id) as num from root_role as a left join root_root_role as b on a.id = b.role_id group by b.root_id;
            // $role = DB::select("select a.* ,count(b.root_id) as num from root_role as a left join root_root_role as b on a.id = b.role_id group by b.root_id");
            // $role = root_root_role::select('root_role.id','root_role.role_name',DB::raw('COUNT(root_root_role.root_id) as num'))
            //                         ->from('root_role')
            //                         ->leftJoin('root_root_role','root_role.id','=','root_root_role.role_id')
            //                         ->groupBy('root_root_role.root_id')
            //                         ->get();
            $role = root_role::get();
            $num = root_root_role::count();
            return view("root.admin.administrator",[
                 'role'=>$role,
                 'admin'=>$admin,
                 'num'=>$num
             ]
            );
        }
        // 添加root
        public function addRoot(Request $req){
            $user = root::create($req->all());
            $root_id = $user['id'];
            $role_id = $req->check;
            foreach($role_id as $v){
                root_root_role::insert(['root_id'=>$root_id,'role_id'=>$v]);
            }
            return redirect()->route('administrator');
        }
        // 删除root
        public function delRoot(){
            $id = $_GET['id'];
            root::destroy($id);
            root_root_role::where('root_id',$id)->delete();
        }
        // 角色列表
        public function roleList(){
           $role =DB::select("select a.* , GROUP_CONCAT(c.pri_name) pri_list from root_role as a left join root_role_privilege as b on a.id = b.role_id  left join root_privilege as c on b.pri_id = c.id group by a.id");
           return  view("root.admin.roleList",[
               'role'=>$role
           ]);
        }
        // 添加角色
        public function competence(){
               $pri = root_privilege::getCategory();
             return view("root.admin.competence",[
                 'pri'=>$pri
             ]);
        }
        // 删除角色
        public function delRole(){
            $id = $_GET['id'];
            root_role::destroy($id);
            root_role_privilege::where('role_id',$id)->delete();
             return redirect()->route('roleList');
        }
        // 添加juese 
        public function addToSole(Request $req){
            $name = $req->name;
            $id = DB::table('root_role')->insertGetId( ['role_name'=>$name] );
            $data = $req->pri;
            foreach($data as $v){
                root_role_privilege::insert(['role_id'=>$id,'pri_id'=>$v]);
            }
            return redirect()->route('roleList');
        }
       
}
