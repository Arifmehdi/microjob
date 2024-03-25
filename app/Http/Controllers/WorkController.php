<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Work;
use App\Services\FileManagementServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WorkController extends Controller
{
    public function index()
    {
        $works = Work::query()->with(['job', 'user'])->where(['user_id' => Auth::id()])->latest('created_at')->get();
        //dd($works);
        return view('work.index', compact('works'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'job'           => ['required', 'integer'],
            'proof_details' => ['required', 'string'],
            'screenshots'   => ['required', 'array'],
            'screenshots.*' => ['required', 'image', 'mimes:png,jpg,jpeg,gif,webp,svg'],
        ]);
        $job = Job::query()->find($request->job);
        if (!$job) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'No Job Found',
            ]);
            return redirect()->route('jobs');
        }
        $screenshots = [];
        if ($request->has('screenshots')) {
            foreach ($request->screenshots as $screenshot) {
                if (is_file($screenshot)) {
                    $screenshots[] = (new FileManagementServices())->updateImage($screenshot, '', 'upload/proves');
                }
            }
        }
        try {
            $work = Work::query()->create([
                'job_id'            => $job->id,
                'user_id'           => Auth::id(),
                'proof_details'     => $request->proof_details,
                'per_worker_amount' => $job->per_worker_amount,
                'screenshots'       => $screenshots,
                'status'            => 'pending',
            ]);
            Session::flash('toast', [
                'type' => 'success',
                'msg'  => 'Task Submitted!'
            ]);
        } catch (\Exception $e) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'Failed To Submit Task!',
            ]);
        }
        return redirect()->route('jobs');
    }

    public function show($id)
    {
        $work = Work::query()->where(['user_id' => Auth::id()])->with(['job', 'user'])->findOrFail($id);
        return view('work.show', compact('work'));
    }
}
