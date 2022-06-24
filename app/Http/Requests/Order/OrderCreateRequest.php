<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderCreateRequest extends FormRequest
{

    const CREATE_RULES = [
        'v1' => [
            "delivery_address" => "required|string",
            "excepted_time" => "required|date",
            "billing_address" => "required|string",
            "customer_id" => "required",
            "order_items" => "required",
            "order_items.*.item_id" => "required|numeric",
            "order_items.*.item_quantity" => "required|numeric",
        ]
    ];

    const DEFAULT_RULES = [
        "delivery_address" => "required|string",
        "excepted_time" => "required|date",
        "billing_address" => "required|string",
        "customer_id" => "required",
        "order_items" => "required",
        "order_items.*.item_id" => "required|numeric",
        "order_items.*.item_quantity" => "required|numeric",
    ];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return self::CREATE_RULES[get_api_version()] ?? self::DEFAULT_RULES;
    }
}
