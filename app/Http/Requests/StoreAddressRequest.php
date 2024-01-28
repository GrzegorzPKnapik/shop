<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\File;

class StoreAddressRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|alpha',
            'surname'=>'required|alpha',
            'city'=>'required|alpha',
            'street'=>'required',
            'zip_code' => 'required|regex:/^\d{2}-\d{3}$/',
            'voivodeship'=>'required|alpha',
            'phone_number' => 'required|numeric|digits:9',
        ];
    }
}
