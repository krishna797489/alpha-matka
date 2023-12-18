<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Starlinegames extends Model
{
    protected $tablen = 'starlinegames';
    protected $fillable = ['game_id','type','date','digit','close_digit','session_type','point','user_id'];

    public static function softDelete($condition)
    {
        return DB::table('starlinegames')->where($condition)->update(['isDeleted'=>1]);
    }
}
