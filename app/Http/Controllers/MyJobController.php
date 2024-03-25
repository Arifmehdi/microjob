<?php

namespace App\Http\Controllers;

use App\DTO\JobDTO;
use App\Http\Requests\JobRequest;
use App\Models\Category;
use App\Models\Job;
use App\Models\JobStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MyJobController extends Controller
{
    public function index()
    {
        $myJobs = Job::query()->where(['user_id' => Auth::id()])->with('works')->latest('created_at')->get();
        return view('my_job.index', compact('myJobs'));
    }

    public function create()
    {
        $categories = Category::query()->where(['parent_id' => null, 'is_deletable' => true])->get();
        return view('my_job.create', compact('categories'));
    }

    public function store(JobRequest $request)
    {
        $jobData = JobDTO::createFromRequest($request);
        if ($jobData->estimated_cost > Auth::user()->balance) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'Insufficient Balance!'
            ]);
            return redirect()->route('my-jobs.create');
        }
        try {
            DB::transaction(function () use ($jobData) {
                if ($jobData->estimated_cost > Auth::user()->balance) {
                    throw new \Exception();
                }
                $job = Job::query()->create($jobData->toArray());
                if (count($jobData->steps) > 0 && !is_null($jobData->steps[0])) {
                    foreach ($jobData->steps as $key => $step) {
                        JobStep::query()->create([
                            'job_id'  => $job->id,
                            'details' => $step,
                            'order'   => $key,
                        ]);
                    }
                }
                Auth::user()->update(['balance' => DB::raw('balance - ' . $jobData->estimated_cost)]);
            });
            Session::flash('toast', [
                'type' => 'success',
                'msg'  => 'Job Posted!'
            ]);
        } catch (\Exception $e) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'Failed To Post Job!',
            ]);
        }
        return redirect()->route('my-jobs.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => ['nullable', 'string', 'max:25']
        ]);
        $job = Job::query()->where(['user_id' => Auth::id()])->findOrFail($id);
        try {
            $job->update(['status' => $request->filled('status')]);
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
        return redirect()->route('my-jobs.show', $job->id);
    }

    public function show($id)
    {
        $job = Job::query()->where(['user_id' => Auth::id()])->with(['works'])->findOrFail($id);
        return view('my_job.show', compact('job'));
    }

    public function proves($id)
    {
        $job = Job::query()->where(['user_id' => Auth::id()])->with(['works', 'works.user'])->findOrFail($id);
        return view('my_job.proves', compact('job'));
    }
}
