<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Requests\Order\{
    OrderGetRequest,
    OrderCreateRequest,
    OrderUpdateRequest,
};

use App\Http\Controllers\Controller;
use App\Interfaces\Order\V1\OrderDetailsInterface;

class OrderController extends Controller {

    private $orderDetails;

    public function __construct(OrderDetailsInterface $orderDetails) {
        $this->orderDetails = $orderDetails;
    }

    public function createOrderDetail (OrderCreateRequest $request) {
        return response()->json($this->orderDetails->createOrder($request->except("token")));
    }

    public function updateOrderDetail (OrderUpdateRequest $request) {
        return response()->json($this->orderDetails->updateOrder($request->except("token")));
    }

    public function getOrderDetail (OrderGetRequest $request) {
        return response()->json(["orders" => $this->orderDetails->getOrder($request->except("token"))]);
    }

    public function getOrderDelayedDetail () {
        return response()->json(["delayed_orders" => $this->orderDetails->getDelayedOrder()]);
    }
}
