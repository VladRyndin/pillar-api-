<?php

namespace App\Console\Command\Orders;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Eloquent\Orders\OrderDetail;

class OrdersExpiredCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders-command:check-expected-time';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $orders = OrderDetail::where('status_id', 1)->get()->toArray();
        $now = Carbon::parse(Carbon::now()->format("Y-m-d"));
        foreach ($orders as $order) {
            if ($now->gt(Carbon::parse($order["expected_time"]))) {
                OrderDetail::where("id", $order["id"])->update([
                    "status_id" => 3
                ]);

                OrderDetail::where("id", $order["id"])->delete();

                \App\Eloquent\Orders\DelayedOrder::create([
                    'order_id' => $order["id"],
                    'expected_time' => $order["expected_time"]
                ]);

            }
        }
        return 0;
    }
}
