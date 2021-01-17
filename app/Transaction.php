<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'status', 'user_id', 'product_id', 'topup_balance_id'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

    public function balance()
    {
        return $this->belongsTo('App\TopupBalance', 'topup_balance_id');
    }
}
