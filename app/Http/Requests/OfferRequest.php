<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required |max:100|unique:offers,name',
            'price'=>'required|numeric',
            'details'=>'required',
        ];
    }

    public function messages(){
        return [
                    'name.required'=>'اسم العرض مطلوب',
                    'name.unique'=>'اسم العرض موجود',
                    'price.numeric'=>'سعر العرض يجب ان يكون ارقام',
                    'price.required'=>'السعر مطلوب',
                    'details.required'=>'التفاصيل مطلوبة',
                ];
    }
}
