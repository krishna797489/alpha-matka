<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Games extends Model
{
    protected $table = 'games';
    protected $fillable = ['name','start_time','end_time','code'];

    public static function softDelete($condition)
    {
        return DB::table('games')->where($condition)->update(['isDeleted'=>1]);
    }
}
