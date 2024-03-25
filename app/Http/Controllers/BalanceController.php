<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Withdraw;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BalanceController extends Controller
{
    public function index()
    {
        $total_earnings_count   = Work::query()->where(['user_id' => Auth::id(), 'status' => 'completed'])->sum('per_worker_amount');
        $total_deposits_amount  = Deposit::query()->where(['user_id' => Auth::id(), 'status' => true])->sum('amount');
        $total_withdraws_amount = Withdraw::query()->where(['user_id' => Auth::id(), 'status' => true])->sum('amount');

        return view('core.balance', compact('total_earnings_count', 'total_deposits_amount', 'total_withdraws_amount'));
    }
}
