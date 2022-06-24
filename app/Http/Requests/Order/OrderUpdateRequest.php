<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest {

    const UPDATE_RULES = [
        'v1' => [
            'order_id' => "required|numeric|exists:order_details,id",
            "status" => "required|string|exists:order_statuses,status_name"
        ]
    ];

    const DEFAULT_RULES = [
        'order_id' => "required|numeric|exists:order_details,id",
        "status" => "required|string|exists:order_statuses,status_name"
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
        return self::UPDATE_RULES[get_api_version()] ?? self::DEFAULT_RULES;
    }
}
