<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DepositController extends Controller
{
    public function index()
    {
        $deposits = Deposit::query()->orderByDesc('created_at')->get();
        return view('backend.deposit.index', compact('deposits'));
    }

    public function update(Request $request, Deposit $deposit)
    {
//        dd($request->filled('status'));
        if (!is_null($deposit->status)) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'This #' . $deposit->id . ' deposit already ' . ($deposit->status ? 'approved' : 'rejected') . '!'
            ]);
            return redirect()->route('admin.deposits.show', $deposit->id);
        }
        try {
            DB::transaction(function () use ($deposit, $request) {
                if ($request->filled('status')) {
                    $deposit->user()->update(['balance' => DB::raw('balance + ' . $deposit->amount)]);
                }
                $deposit->update(['status' => $request->filled('status')]);
            });

            (new NotificationService())->create($deposit, $request->filled('status'), 'Deposit');

            Session::flash('toast', [
                'type' => 'success',
                'msg'  => 'Deposit ' . ($request->filled('status') ? 'Approved' : 'Rejected') . '!'
            ]);
        } catch (\Exception $e) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'Failed To Approve Deposit!',
            ]);
        }
        return redirect()->route('admin.deposits.show', $deposit->id);
    }

    public function show(Deposit $deposit)
    {
        return view('backend.deposit.show', compact('deposit'));
    }
}
