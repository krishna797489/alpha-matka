<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $tablen = 'logs';
    protected $fillable = ['user_id','credit','debit'];

}
