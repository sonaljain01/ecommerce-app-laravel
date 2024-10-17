<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'star_rating' => 'nullable|integer|between:1,5',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Product name is required',
            'name.max' => 'Product name is too long',
            'name.string' => 'Product name must be a string',
            'description.required' => 'Product description is required',
            'description.string' => 'Product description must be a string',
            'price.required' => 'Product price is required',
            'price.numeric' => 'Product price must be a number',
            'category_id.required' => 'Product category is required',
            'category_id.exists' => 'Product category does not exist',
            'image.*.required' => 'Product image is required',
            'image.*.image' => 'Product image must be an image',
            'image.*.mimes' => 'Product image must be a jpeg, png, jpg, or gif',
            'image.*.max' => 'Product image must be less than 2048KB',
            'star_rating.integer' => 'Star rating must be an integer',
            'star_rating.between' => 'Star rating must be between 1 and 5',
        ];
}
}