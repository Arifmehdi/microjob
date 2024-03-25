<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
            'parent_category'   => ['exclude_if:category,true', 'required', 'numeric'],
            'category'          => ['nullable', 'numeric'],
            'title'             => ['required', 'string', 'max:190'],
            'steps'             => ['nullable', 'array'],
            'steps.*'           => ['nullable', 'string'],
            'proof_details'     => ['nullable', 'string'],
            'image'             => ['nullable', 'image', 'max:510'],
            'num_of_worker'     => ['required', 'numeric'],
            'per_worker_amount' => ['required', 'numeric'],
            'num_of_screenshot' => ['nullable', 'numeric'],
            'estimated_day'     => ['required', 'numeric'],
        ];
    }
}
