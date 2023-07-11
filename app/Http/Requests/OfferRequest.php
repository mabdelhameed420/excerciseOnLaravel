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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name_en' => 'required|max:255|unique:offers,name_en',
            'name_ar' => 'required|max:255|unique:offers,name_ar',
            'details_en' => 'required',
            'details_ar' => 'required',
            'price' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name_en.required' => __('messages.offer name required'),
            'name_ar.required' => __('messages.offer name required'),
            'name_en.unique' => __('messages.offer name must be unique'),
            'name_ar.unique' => __('messages.offer name must be unique'),
            'name_en.max' => __('messages.offer name max'),
            'name_ar.max' => __('messages.offer name max'),
            'details_en.required' => __('messages.Offer details'),
            'details_ar.required' => __('messages.Offer details'),
            'price.required' => __('messages.offer price required'),
            'price.numeric' => __('messages.offer price numeric'),
        ];
    }
}
