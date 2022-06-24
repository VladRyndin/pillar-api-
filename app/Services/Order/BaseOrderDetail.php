<?php


namespace App\Services\Order;

use App\Eloquent\Orders\{
    OrderDetail,
};

class BaseOrderDetail {

    protected $order_detail;

    public function __construct() {
        $this->order_detail = new OrderDetail;
    }
}
