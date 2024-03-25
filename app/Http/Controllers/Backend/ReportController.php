<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReportController extends Controller
{
    public function proveIndex(Request $request)
    {
        $reports = Report::query()
                         ->when($request->filled('status'), function ($query) use ($request) {
                             return $query->where('status', $request->query('status'));
                         })
                         ->with(['work'])->whereHas('work')->get();

        return view('backend.report.prove-index', compact('reports'));
    }

    public function proveShow($id)
    {
        $report = Report::query()->with(['work', 'work.user'])->findOrFail($id);

        return view('backend.report.prove-show', compact('report'));
    }

    public function proveUpdate(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', 'string', 'in:rejected,pending']
        ]);
        $report = Report::query()->with(['work'])->findOrFail($id);

        try {
            $report->update(['status' => 'completed']);
            $report->work()->update(['status' => $request->input('status')]);
            (new NotificationService())->createReportStatus($report, $request->input('status') === 'rejected');
            Session::flash('toast', [
                'type' => 'success',
                'msg'  => 'Report Updated! '
            ]);
        } catch (\Exception $e) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'Failed To Update Report!',
            ]);
        }

        return back();
    }
}
