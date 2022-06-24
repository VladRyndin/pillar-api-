<?php

namespace App\Eloquent\Orders;

use Illuminate\Database\Eloquent\Model;

class DelayedOrder extends Model
{
    protected $guarded = [

    ];

    public function getOrderDetail () {
        $this->hasOne(OrderDetail::class, "id", "order_id");
    }
}
