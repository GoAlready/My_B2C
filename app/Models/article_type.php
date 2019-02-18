<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class article_type extends Model
{
     //
    protected $table = "article_type";
    public $timestamps = false;
    protected $fillable  = ['type_name','is_show','type_introduce'];
   
}


