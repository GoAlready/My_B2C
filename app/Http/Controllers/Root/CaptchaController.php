<?php

namespace App\Http\Controllers\Root;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;
class CaptchaController extends Controller
{
    //
    public function make(CaptchaBuilder $builder){
         $builder->build();
        session([
            'captcha'=>$builder->getPhrase()
        ]);
        return response($builder->output())
        ->header('Content-Type','image/jpeg');
    }   
}
