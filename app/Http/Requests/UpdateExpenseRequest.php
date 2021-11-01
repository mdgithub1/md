<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExpenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "value" => "required|numeric|min:0.01",
            "description" => "required|min:3|max:250",
            "expenses_type_id" => "required|integer|min:1|max:5",
        ];
    }
}
