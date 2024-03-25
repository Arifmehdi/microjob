<?php

namespace App\DTO;

use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\DataTransferObject\DataTransferObject;

class DepositDTO extends DataTransferObject
{
    public $user_id;
    public $method;
    public $amount;
    public $transaction_id;
    public $phone;
    public $status;

    public static function createFromRequest(Request $request, Deposit $deposit = null): DepositDTO
    {

        $data = [
            'user_id'        => Auth::id(),
            'method'         => $request->input('method'),
            'amount'         => $request->input('amount'),
            'transaction_id' => $request->input('transaction_id'),
            'phone'          => $request->input('phone'),
            'status'         => null,
        ];

        return new self($data);
    }

    public function toArray(): array
    {
        $data = [
            'user_id'        => $this->user_id,
            'method'         => $this->method,
            'amount'         => $this->amount,
            'transaction_id' => $this->transaction_id,
            'phone'          => $this->phone,
            'status'         => $this->status,
        ];
        return $data;
    }
}
