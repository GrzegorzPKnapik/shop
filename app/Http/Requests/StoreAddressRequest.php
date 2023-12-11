<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\File;

class StoreAddressRequest extends FormRequest
{
    /**
     * Determine if the users is authorized to make this request.
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
            'name'=>'required',
            'surname'=>'required',
            'city'=>'required',
            'street'=>'required',
            'zip_code'=>'required',
            'voivodeship'=>'required',
            'phone_number'=>'required|numeric'
        ];
    }
}
