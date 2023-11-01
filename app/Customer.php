<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Customer extends Model
{
    protected $table = "customer";
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'image',
        
    ];
    public static function softDelete($condition)
    {
        return DB::table('customer')->where($condition)->update(['isDeleted'=>1]);
    }
}
