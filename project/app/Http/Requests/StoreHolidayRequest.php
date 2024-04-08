<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHolidayRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'min:1',
                'max:30',
            ],
            'date' => [
                'required',
                'date_format:Y-m-d',
            ],
        ];
    }
}
