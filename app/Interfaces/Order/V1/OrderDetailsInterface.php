<?php


namespace App\Interfaces\Order\V1;


interface OrderDetailsInterface {

    public function createOrder ($data);

    public function updateOrder($data);

    public function getOrder($data);

    public function getDelayedOrder();
}
