<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class history extends Model
{
    protected $table = 'history';
    protected $fillable = [
        'user_id', 'point', 'status', 'payment_type','time','debit','withdraw_methord','type',
    ];
}
