<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class howToPlayFrm extends Model
{
    protected $table = 'howplaygame';
    protected $fillable = [
        'description', 'video_link',
    ];
}
