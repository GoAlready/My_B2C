<?php

namespace App\Models\root;

use Illuminate\Database\Eloquent\Model;
use DB;
class root extends Model
{
    protected $table = "root";
    public $timestamps = false;
    protected $fillable = ['name','password','phone','sex'];
    public function root_role(){
        return $this->belongsToMany('App\Models\root\root_role','root_root_role','role_id','root_id');
    }
        public static function getPath($id){
        $path = DB::select("select c.path
                    from root_root_role as a 
                    left join root_role_privilege as b on a.role_id = b.role_id 
                    left join root_privilege as c on b.pri_id = c.id 
                    where a.root_id ={$id} and c.path != ''");
        $ret = [];
        foreach($path as $v){
            if(FALSE==strpos($v->path,",")){
                 $ret[] = $v->path;
            }else{
                $_tt = explode(',',$v->path);
                $ret = array_merge($ret,$_tt);
            }
        }
        return $ret;
    }
}
