<?php

namespace App\Http\Controllers\Home;
use Endroid\QrCode\QrCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QrcodeController extends Controller
{
    // 把一个字符串生成 二维码图片并显示
    public function qrcode()
    {
        $str = $_GET['code'];
        $qrCode = new QrCode($str);
        header('Content-Type: '.$qrCode->getContentType());
        return  $qrCode->writeString();
    }
}
