<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderGetRequest extends FormRequest
{

    const GET_RULES = [
        'v1' => [
            'order_id' => "nullable|numeric|exists:order_details,id",
            "status" => "nullable|string|exists:order_statuses,status_name"
        ]
    ];

    const DEFAULT_RULES = [
        'order_id' => "nullable|numeric|exists:order_details,id",
        "status" => "nullable|string|exists:order_statuses,status_name"
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
        return self::GET_RULES[get_api_version()] ?? self::DEFAULT_RULES;
    }
}
