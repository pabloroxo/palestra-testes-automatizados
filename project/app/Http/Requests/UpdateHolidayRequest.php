<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHolidayRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'min:1',
                'max:30',
            ],
            'date' => [
                'date_format:Y-m-d',
            ],
        ];
    }
}
