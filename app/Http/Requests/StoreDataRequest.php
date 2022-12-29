<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDataRequest extends FormRequest
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
            'user_id' => 'required|integer|min:1|max:2',
            'title' => 'required|string|max:255',
            'meta_title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required',
            'weight' => 'nullable',
            'volume' => 'nullable',
            'stock' => 'required|integer|max:500',
            'isReadyPublish' => 'required'
        ];
    }

      /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'user_id.required' => 'User ID is required and must be 1 or 2',
            'title.required' => 'Title is required',
            'meta_title.required' => 'Meta Title is required',
            'slug.required' => 'Slug is required',
            'description.required' => 'Description is required',
            'price.required' => 'Price is required',
            'stock.required'  => 'Stock is required',
            'isReadyPublish.required' => 'Is Ready Publish is required'
        ];
    }
}
