<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkuRequest extends FormRequest
{
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'price' => 'required|numeric|min:1',
            'count' => 'required|numeric|min:0',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Поле обязательное для ввода',
            'min' => 'Поле  должно иметь минимум :min символов',
        ];
    }
}