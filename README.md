### Pillar Api
Hi I'm Vlad and this is my test task

### Get Started Application
- 1 Run composer command. After install configure `.env` file
```console 
composer install
```
- 2 Run the migrations
```console
     php artisan migrate
```
- 3 Run the seeds for add order statuses and an user. The User seed will dump api token.
```console
     php artisan db:seed
```

### API Calls
- *** Required body param for all requests is `_token`. This is your API key.

- Create order detail:
```text
    POST: /orders/v1
```
Request body example:
```yaml
{
    "_token": {YOUR_TOKEN},
    "excepted_time": "2022-03-01",
    "delivery_address": "1333",
    "billing_address": "2333",
    "customer_id": 123425,
    "order_items": [
        {
            "item_id": 1,
            "item_quantity":4
        },
        {
            "item_id": 3,
            "item_quantity": 2
        }
    ]
}
```

- Update order to specific status:
```text
    PATCH: /orders/v1
```

Request body example:
```yaml
{
    "status": "done",
    "order_id": "4",
    "_token": {YOUR_TOKEN}
}
```
- Get Order by Order ID or status:
```text
    GET: orders/v1
```

Request body example:
```text
By Order Id: ?order_id={order_id}&_token={YOUR_TOKEN}
```

```text
By status: ?status=pending&_token={YOUR_TOKEN}
```

- Get Order Delayed:
```text
    GET: orders/v1/delayed?_token={YOUR_TOKEN}
```

###Schedule Command
- Single debug:
```console
    php artisan orders-command:check-expected-time
```

- Laravel task scheduler:
```console
    * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

- Crontab scheduler:
```console
    0 0 * * * cd /path-to-your-project && php artisan orders-command:check-expected-time
```

### Notice:
- Script path: `App\Console\Command\Orders\OrdersExpiredCheck`.
- Laravel scheduler: `App\Console\Kernel.php`.
- Controller: `App\Http\Controllers\Api\Orders\OrderController`.
- Business logic: `App\Services\Order\V1\OrderDetailService`. 
    Service Provider: `App\Providers\OrderServiceProvider`.
- Api validation: `App\Http\Middleware\PillarApiMiddleware`.
- Requests validations: `App\Http\Requests\Order\*`
- Added option to add version 2

### My Comments:
The task was interesting. Thank you. Best regards
