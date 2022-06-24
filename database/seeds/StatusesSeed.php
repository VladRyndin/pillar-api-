<?php

use Illuminate\Database\Seeder;

use App\Eloquent\Orders\OrderStatus;

class StatusesSeed extends Seeder
{

    const STATUSES = [
        'pending',
        'done',
        'delayed'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::STATUSES as $status) {
            if (!OrderStatus::where("status_name", $status)->exists()) {
                OrderStatus::create([
                    'status_name' => $status
                ]);
            }
        }
    }
}
