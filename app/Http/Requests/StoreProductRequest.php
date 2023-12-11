<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\File;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
            'product_name'=>'required',
            'product_price'=>'required|numeric',
            'image_name' => [
                'image',
                'mimes:png',
                'dimensions:width=600,height=600',
            ],
            'category_select' => [
                'required',
            ],
            'producer_select' => [
                'required',
            ],
            'description_name'=>'required',
            'description_ingredients'=>'required',
            'description_calories'=>''

        ];
    }
}
