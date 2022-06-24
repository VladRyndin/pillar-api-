<?php

return [
    'api' => [
        'latest_version' => "v1",
        'versions' => [
            'v1' => \App\Services\Order\V1\OrderDetailService::class
        ]
    ]
];
