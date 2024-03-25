<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class WithdrawController extends Controller
{
    public function index()
    {
        $withdraws = Withdraw::query()->orderByDesc('created_at')->get();
        return view('backend.withdraw.index', compact('withdraws'));
    }

    public function update(Request $request, Withdraw $withdraw)
    {
        if (!is_null($withdraw->status)) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'This #' . $withdraw->id . ' withdraw request already ' . ($withdraw->status ? 'approved' : 'rejected') . '!'
            ]);
            return redirect()->route('admin.withdraws.show', $withdraw->id);
        }
        try {
            DB::transaction(function () use ($withdraw, $request) {
                if (!$request->filled('status')) {
                    $withdraw->user()->update(['balance' => DB::raw('balance + ' . $withdraw->amount)]);
                    $withdraw->update(['status' => false]);
                } else {
                    $withdraw->update(['status' => true]);
                }
            });

            (new NotificationService())->create($withdraw, $request->filled('status'), 'Withdraw');
            Session::flash('toast', [
                'type' => 'success',
                'msg'  => 'Withdraw Request !'
            ]);
        } catch (\Exception $e) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'Failed To Approve Withdraw '. ($request->filled('status') ? 'Approved' : 'Rejected') .'!',
            ]);
        }
        return redirect()->route('admin.withdraws.show', $withdraw->id);
    }


    public function show(Withdraw $withdraw)
    {
        return view('backend.withdraw.show', compact('withdraw'));
    }
}
