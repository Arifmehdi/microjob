<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class WithdrawRequest extends FormRequest
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
        $min_withdraw = !empty(get_setting('min_withdraw')) ? get_setting('min_withdraw') : 0;
        return [
            'method'         => ['required', 'string', 'max:190'],
            'amount'         => ['required', 'numeric', 'min:' . $min_withdraw, 'max:' . Auth::user()->balance,],
            'account_number' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'amount.max' => 'Amount must not be greater than your current balance.',
            'amount.min' => 'The amount must be at least ৳100 BDT.'
        ];
    }
}
