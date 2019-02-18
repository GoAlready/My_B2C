<?php

namespace App\Http\Middleware\Root;
use DB;
use Closure;
use App\Models\root\root;
class loginMiddle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!session('id')){
            return redirect()->route('rootlogin');
        }
        if(session('root')){
         
        }
        else{
            $path = isset($_SERVER['PATH_INFO'])? trim($_SERVER['PATH_INFO'], '/') : 'index/index';
            $id = session('id');
            $whiteList = ['root/rootIndex','root/home'];
            if(!in_array($path,array_merge($whiteList,session('path')))){
                die("无权访问");
            }
        }
        return $next($request);
    }
}
