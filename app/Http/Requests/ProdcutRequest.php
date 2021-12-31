<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdcutRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('POST')) {
            return [
                'name'            => ['required', 'string', 'min:5', 'max:40', 'unique:prodcuts,name'],
                'description'     => ['required', 'string', 'min:5', 'max:40'],
                'price'           => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
                'image'           => ['sometimes', 'image'],
                'sub_category_id' => ['required', 'exists:sub_categories,id'],
            ];
        } elseif ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            return [
                'name'            => ['sometimes', 'string', 'min:5', 'max:40', 'unique:prodcuts,name'],
                'description'     => ['sometimes', 'string', 'min:5', 'max:40'],
                'price'           => ['sometimes', 'regex:/^\d+(\.\d{1,2})?$/'],
                'image'           => ['sometimes', 'image'],
                'sub_category_id' => ['sometimes', 'exists:sub_categories,id'],
            ];
        }
    }
}
