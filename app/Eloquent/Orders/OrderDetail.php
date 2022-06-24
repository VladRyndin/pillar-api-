<?php

namespace App\Eloquent\Orders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model {
    use SoftDeletes;

    protected $guarded = [

    ];

    public function orderItems () {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function orderStatus () {
        return $this->hasOne(OrderStatus::class, 'id', 'status_id');
    }

    public function orderRelations () {
        return $this->with(["orderItems", "orderStatus"]);
    }
}
