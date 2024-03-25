<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name'              => ['required', 'string', 'max:180'],
            'parent_id'         => ['nullable', 'integer'],
            'min_cost_per_work' => ['nullable', 'numeric'],
            'description'       => ['nullable', 'string'],
            'status'            => ['nullable', 'string', 'max:25'],
            'image'             => ['nullable', 'image', 'max:1000', 'mimes:jpeg,bmp,png,jpg,gif,svg'],
        ];
    }
}
