<?php


namespace App\Services\Order\V1;

use Carbon\Carbon;
use App\Services\Order\BaseOrderDetail;
use Illuminate\Database\Eloquent\Builder;
use App\Interfaces\Order\V1\OrderDetailsInterface;

class OrderDetailService extends BaseOrderDetail implements OrderDetailsInterface {

    public function createOrder ($data) {
        $status = \App\Eloquent\Orders\OrderStatus::where("status_name", "pending")->value("id");
        $order_detail = $this->order_detail->create([
            'customer_id' => $data["customer_id"],
            'delivery_address' => $data["delivery_address"],
            'billing_address' => $data["billing_address"],
            'expected_time' => Carbon::parse($data["excepted_time"]),
            'status_id' => $status,
        ]);

        foreach ($data["order_items"] as $order_item) {
            $order_detail->orderItems()->create([
                'item_quantity' => $order_item["item_quantity"],
                'item_id' => $order_item["item_id"],
            ]);
        }

        return ["status" => $status, "order_id" => $order_detail["id"], "expected_time" => $order_detail["expected_time"]];
    }

    public function updateOrder ($data) {
        $status = \App\Eloquent\Orders\OrderStatus::where("status_name", $data["status"])->value("id");

        return ["status" =>
            ($this->order_detail->where("id", $data["order_id"])->update([
                'status_id' => $status
            ])) ? "updated" : "error"
        ];
    }

    public function getOrder ($data) {
        $orderDB = $this->order_detail->orderRelations();
        switch (true) {
            case !empty($data["status"]):
                $status = $data["status"];
                $orderDB = $orderDB->whereHas("orderStatus", function (Builder $query) use ($status) {
                    $query->where('status_name', $status);
                });
                break;
            case !empty($data["order_id"]):
                $orderDB = $orderDB->where("id", $data["order_id"]);
                break;
            default:
                //
                break;
        }

        return $orderDB->get()->map(function ($item, $key) {
            $item["status"] = $item["orderStatus"]["status_name"];
            unset($item["orderStatus"]);
            return $item;
        })->toArray();
    }

    public function getDelayedOrder() {
        return \App\Eloquent\Orders\DelayedOrder::select("order_id", "expected_time as start_time",
            "created_at as end_time")->get()->toArray();
    }
}
