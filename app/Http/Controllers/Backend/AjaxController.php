<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function jobApproved(Request $request)
    {
        $response = [];
        $request->validate([
            'id' => ['required', 'integer']
        ]);
        $job = Job::query()->find($request->id);
        if ($job) {
            $job->update(['is_approved' => !$job->is_approved]);
            $job      = Job::query()->find($job->id);
            $response = [
                'status' => true,
                'data'   => $job
            ];
        } else {
            $response = [
                'status' => false,
                'data'   => []
            ];
        }
        return response()->json($response);
    }
}
