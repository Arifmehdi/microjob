<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepositRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() {
        $min_deposit = ! empty( get_setting( 'min_deposit' ) ) ? get_setting( 'min_deposit' ) : 0;

        return [
            'method'         => [ 'required', 'string', 'max:190' ],
            'amount'         => [ 'required', 'numeric', 'min:' . $min_deposit ],
            'transaction_id' => [ 'required', 'string' ],
            'phone'          => [ 'required', 'string', 'max:190' ],
        ];
    }

    public function messages() {
        return [
            'amount.min' => 'The amount must be at least ' . get_setting( 'min_deposit' ) . ' BDT.'
        ];
    }
}
