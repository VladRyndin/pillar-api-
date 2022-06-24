<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('api/user', function (Request $request) {
    return $request->user();
});


Route::namespace("Api\Orders")->middleware("pillar_api")->prefix("orders")->group(function () {
    Route::prefix("v1")->group(function () {
        Route::post("/", "OrderController@createOrderDetail");
        Route::patch("/", "OrderController@updateOrderDetail");
        Route::get("/", "OrderController@getOrderDetail");
        Route::get("/delayed", "OrderController@getOrderDelayedDetail");
    });
});
