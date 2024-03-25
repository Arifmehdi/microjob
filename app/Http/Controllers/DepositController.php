<?php

namespace App\Http\Controllers;

use App\DTO\DepositDTO;
use App\Http\Requests\DepositRequest;
use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DepositController extends Controller
{
    public function index()
    {
        $deposits = Deposit::query()->where(['user_id' => Auth::id()])->orderByDesc('created_at')->get();
        return view('deposit.index', compact('deposits'));
    }

    public function create()
    {
        return view('deposit.create');
    }

    public function store(DepositRequest $request)
    {
        $userDeposits = Deposit::query()->where(['user_id' => Auth::id(), 'status' => null])->count();
        if ($userDeposits > 0) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'You already have ' . $userDeposits . ' pending deposits',
            ]);
            return redirect()->route('deposits.create');
        }
        $depositRequest = DepositDTO::createFromRequest($request);
        try {
            $deposit = Deposit::query()->create($depositRequest->toArray());
            Session::flash('toast', [
                'type' => 'success',
                'msg'  => 'Fund Deposit!'
            ]);
        } catch (\Exception $e) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'Failed To Deposit Fund!'
            ]);
        }
        return redirect()->route('deposits.index');
    }
}
