<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class typegames extends Model
{
    protected $tablen = 'typegames';
    protected $fillable = ['game_id','type','date','digit','close_digit','session_type','point','user_id'];

  

}
