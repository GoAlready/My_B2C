<?php

namespace App\Models\home;

use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    //
    protected $table = "addresses";
    protected $fillable  =['user_id','consignee','tel','province','city','district','address','as_address','postcode','label'];
}
