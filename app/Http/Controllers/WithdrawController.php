<?php

namespace App\Http\Controllers;

use App\DTO\WithdrawDTO;
use App\Http\Requests\WithdrawRequest;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class WithdrawController extends Controller
{
    public function index()
    {
        $withdraws = Withdraw::query()->where(['user_id' => Auth::id()])->orderByDesc('created_at')->get();
        return view('withdraw.index', compact('withdraws'));
    }

    public function create()
    {
        return view('withdraw.create');
    }

    public function store(WithdrawRequest $request)
    {
        $withdrawRequest = WithdrawDTO::createFromRequest($request);
        if ($withdrawRequest->amount > Auth::user()->balance) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'Insufficient Balance',
            ]);
            return redirect()->route('deposits.create');
        }

        $userWithdraws = Withdraw::query()->where(['user_id' => Auth::id(), 'status' => null])->count();

        if ($userWithdraws > 0) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'You already have ' . $userWithdraws . ' pending withdraws',
            ]);
            return redirect()->route('withdraws.create');
        }

        try {
            DB::transaction(function () use ($withdrawRequest) {
                $withdraw = Withdraw::query()->create($withdrawRequest->toArray());
                Auth::user()->update([
                    'balance' => DB::raw('balance - ' . $withdrawRequest->amount)
                ]);
            });
            Session::flash('toast', [
                'type' => 'success',
                'msg'  => 'Fund Withdrew!'
            ]);
        } catch (\Exception $e) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'Failed To Withdraw Fund!'
            ]);
        }
        return redirect()->route('withdraws.index');
    }


}
