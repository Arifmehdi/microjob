<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Work;
use App\Models\WorkNote;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProveController extends Controller
{
    public function index($id)
    {
        $job = Job::query()->where(['user_id' => Auth::id()])->with([
            'works', 'works.user', 'works.report'
        ])->findOrFail($id);
        return view('my_job.prove.index', compact('job'));
    }

    public function update(Request $request, $job_id, $prove_id)
    {
        $job   = Job::query()->where(['user_id' => Auth::id()])->findOrFail($job_id);
        $prove = Work::query()->where(['job_id' => $job_id])->with(['user', 'notes'])->findOrFail($prove_id);
        if ($prove->status !== 'pending') {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'This work already been approved!',
            ]);

            return redirect()->route('my-jobs.proves.show', [$job->id, $prove->id]);
        }
        try {
            DB::transaction(function () use ($prove, $request) {
                $prove->user()->update(['balance' => DB::raw('balance + '.$prove->per_worker_amount)]);
                $prove->update(['status' => 'completed']);
            });
            (new NotificationService())->create($prove, true, 'Work');
            Session::flash('toast', [
                'type' => 'success',
                'msg'  => 'Work Approved! '
            ]);
        } catch (\Exception $e) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'Failed To Approve Work!',
            ]);
        }

        return redirect()->route('my-jobs.proves.show', [$job->id, $prove->id]);
    }

    public function show($job_id, $prove_id)
    {
        $job   = Job::query()->where(['user_id' => Auth::id()])->findOrFail($job_id);
        $prove = Work::query()->where(['job_id' => $job_id])->with(['user', 'notes', 'report'])->findOrFail($prove_id);
        return view('my_job.prove.show', compact('job', 'prove'));


    }

    public function approvedAll($job_id)
    {
        $job = Job::query()->where(['user_id' => Auth::id()])->findOrFail($job_id);
        try {
            Work::query()->with(['user'])->where(['job_id' => $job->id, 'status' => 'pending'])->each(function ($work) {
                DB::transaction(function () use ($work) {
                    $work->user()->update(['balance' => DB::raw('balance + '.$work->per_worker_amount)]);
                    $work->update(['status' => 'completed']);
                    (new NotificationService())->create($work, true, 'Work');
                });
                Cache::forget('total_unread_notification'.$work->user_id);
            });
            Session::flash('toast', [
                'type' => 'success',
                'msg'  => 'Work Approved'
            ]);
        } catch (\Exception $e) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'Failed To Approve Work!',
            ]);
        }

        return redirect()->route('my-jobs.proves.index', $job->id);
    }
}
