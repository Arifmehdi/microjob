<?php

namespace App\Http\Controllers\Backend;

use App\DTO\JobDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\JobRequest;
use App\Models\Category;
use App\Models\Job;
use App\Models\JobStep;
use App\Models\Notification;
use App\Services\NotificationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class JobController extends Controller
{

    public function index(Request $request)
    {
        $status = '';
        if ($request->filled('status')) {
            if ($request->query('status') === 'approved') {
                $status = true;
            } elseif ($request->query('status') === 'pending') {
                $status = null;
            } elseif ($request->query('status') === 'rejected') {
                $status = false;
            }
        }
        $jobs = Job::query()
                   ->when($request->filled('status'), function ($query) use ($request, $status) {
                       return $query->where('is_approved', $status);
                   })
                   ->orderByDesc('created_at')->get();

        return view('backend.job.index', compact('jobs'));
    }


    public function create()
    {
        $categories = Category::query()->where(['parent_id' => null, 'is_deletable' => true])->get();

        return view('backend.job.create', compact('categories'));
    }


    public function store(JobRequest $request): RedirectResponse
    {
        $jobData = JobDTO::createFromRequest($request);
        if ($jobData->estimated_cost > Auth::user()->balance) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'Insufficient Balance!'
            ]);

            return redirect()->route('admin.jobs.create');
        }
        // try {
           $check =  DB::transaction(function () use ($jobData) {

                if ($jobData->estimated_cost > Auth::user()->balance) {
                    throw new \Exception();
                }
                $job = Job::query()->create($jobData->toArray());
                if (count($jobData->steps) > 0 && ! is_null($jobData->steps[0])) {
                    foreach ($jobData->steps as $key => $step) {
                        JobStep::query()->create([
                            'job_id'  => $job->id,
                            'details' => $step,
                            'order'   => $key,
                        ]);
                    }
                }
                Auth::user()->update(['balance' => DB::raw('balance - '.$jobData->estimated_cost)]);
            });
            // dd($check);
            Session::flash('toast', [
                'type' => 'success',
                'msg'  => 'Job Posted!'
            ]);
        // } catch (\Exception $e) {
        //     Session::flash('toast', [
        //         'type' => 'danger',
        //         'msg'  => 'Failed To Post Job!',
        //     ]);
        // }

        return redirect()->route('admin.jobs.index');
    }


    public function show($id)
    {
        $job = Job::query()->findOrFail($id);

        return view('backend.job.show', compact('job'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'status'      => ['nullable', 'string', 'max:25'],
            'is_approved' => ['nullable', 'string', 'max:25']
        ]);
        $job = Job::query()->findOrFail($id);
        try {
            $job->update([
                'status'      => $request->filled('status'),
                'is_approved' => $request->filled('is_approved'),
            ]);
            (new NotificationService())->createJobStatusNotification($job, $request->filled('is_approved'));
            Session::flash('toast', [
                'type' => 'success',
                'msg'  => 'Job Updated!'
            ]);
        } catch (\Exception $e) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'Failed To Update Job!',
            ]);
        }

        return redirect()->route('admin.jobs.show', $job->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
