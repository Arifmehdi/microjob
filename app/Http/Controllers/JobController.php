<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index(Request $request): Factory|View|Application
    {

        $jobs = Job::query()->where(['is_approved' => true, 'status' => true])
            ->when($request->filled('category'), function ($query) use ($request) {
                return $query->whereHas('category', function ($query) use ($request) {
                    return $query->where('slug', $request->query('category'));
                });
            })
            ->whereDoesntHave('works', function ($query) {
                return $query->where('user_id', Auth::id());
            })->latest('updated_at')->paginate(15);

        $categories = Category::query()->where(['status' => true, 'is_deletable' => true])->get();
        return view('job.index', compact('jobs', 'categories'));
    }

    public function show($id)
    {
        $job = Job::query()->findOrFail($id);
        return view('job.show', compact('job'));
    }
}
