<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopupBalance extends Model
{
    protected $fillable = [
        'mobile_number', 'value'
    ];
}
