<?php

namespace App\Http\Requests\Backend;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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

        $passwordRequired = 'required';
        $emailUniqueRule  = Rule::unique(User::class);
        if ($this->route()->hasParameter('user')) {
            $emailUniqueRule  = Rule::unique(User::class, 'email')->ignore($this->route()->parameter('user'));
            $passwordRequired = 'nullable';
        }
        return [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => [
                'required', 'string', 'email', 'max:255', $emailUniqueRule,
            ],
            'password' => [$passwordRequired, 'string', 'min:6'],
            'is_admin' => ['nullable', 'string', 'max:25'],
            'status'   => ['nullable', 'string', 'max:25'],
            'balance'  => ['nullable', 'numeric'],
        ];
    }
}
