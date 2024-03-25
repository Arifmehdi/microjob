<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReportController extends Controller
{
    public function proveStore(Request $request, $id)
    {
        $request->validate([
            'details' => ['required', 'string']
        ]);

        $prove = Work::query()->whereHas('job', function ($q) {
            return $q->where('user_id', Auth::id());
        })->findOrFail($id);

        try {
            Report::query()->create([
                'details' => $request->input('details'),
                'work_id' => $prove->id,
                'status'  => 'pending'
            ]);

            Session::flash('toast', [
                'type' => 'success',
                'msg'  => 'Report Submitted!'
            ]);
        } catch (\Exception $e) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'Failed To Submit Report!',
            ]);
        }

        return back();
    }
}
