<?php

namespace App\Eloquent\Orders;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $guarded = [];

    public function orderDetail() {
        return $this->belongsTo(OrderDetail::class, 'order_id', 'id');
    }
}
