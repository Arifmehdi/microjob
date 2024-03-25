<?php

namespace App\DTO;

use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\DataTransferObject\DataTransferObject;

class WithdrawDTO extends DataTransferObject
{
    public $user_id;
    public $method;
    public $amount;
    public $account_number;
    public $status;

    public static function createFromRequest(Request $request, Deposit $deposit = null): WithdrawDTO
    {

        $data = [
            'user_id'        => Auth::id(),
            'method'         => $request->input('method'),
            'amount'         => $request->input('amount'),
            'account_number' => $request->input('account_number'),
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
            'account_number' => $this->account_number,
            'status'         => $this->status,
        ];
        return $data;
    }
}
