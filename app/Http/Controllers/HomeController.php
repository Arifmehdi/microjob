<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function __invoke(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('jobs');
        }
        $jobs = Job::query()->where(['is_approved' => true, 'status' => true])
            ->latest('updated_at')->paginate(15);
        return view('home', compact('jobs'));
    }
}
