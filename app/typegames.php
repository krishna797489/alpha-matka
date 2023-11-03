<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class typegames extends Model
{
    protected $single_digit = 'single_digit';
    protected $fillable = ['date','open_digit','points','time_session'];

    protected $table = 'single_panna';
    protected $data = ['date','digit','point'];

}
