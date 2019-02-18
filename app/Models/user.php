<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Hash;//哈希  
use Storage;
class user extends Model
{
    //
    public $timestamps = false;
    protected $table = "user";
    protected $fillable = ['name','phone','password','nicheng','sex','year','month','day','province','city','county','job','headImg','Disable'];
    public static function addUser($req){
        $user = new user;
        $user->fill($req);
        $user->password = Hash::make($req['password']);
        $user->save();
    }
    public static function editUser($id,$req){
            $user = new user;
            $user = user::find($id);
            $user->fill($req->all());
            $user->password = Hash::make($req['password']);
            $user->save();
    }
    public static function img($req){
        if($req->has('headImg')&& $req->headImg->isValid()){
            $date = date('Ymd');
            $avatar = $req->file('headImg')->store("/public/". date("Y-m-d") . '/imgs/avatar');
            $url =  url('/').Storage::url($avatar);
            return $url;
        }
    }
}
