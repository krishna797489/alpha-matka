<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table='results';
    protected $fillable = [
        'user_id','Odigit',
        'Cdigit',
        'result_date',
        // Add other fields as needed
    ];
    public function games()
    {
        return $this->hasMany(Games::class, 'id', 'user_id');
    }
    public function typegame() {
        return $this->hasOne(typegames::class, 'g_id', 'user_id');
    }
}
