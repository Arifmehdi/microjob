<?php

namespace App\Http\Controllers;

use App\DTO\ProveNoteDTO;
use App\Models\Work;
use App\Models\WorkNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProveNoteController extends Controller
{
    public function store(Request $request)
    {
        $noteData = ProveNoteDTO::createFromRequest($request)->toArray();
        $work     = Work::query()->with(['job'])->findOrFail($noteData['work_id']);
        if (($work->job && $work->job->user_id != Auth::id()) && ($work->user_id != Auth::id())) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'Failed To Send Message!',
            ]);
            return back();
        }
        try {
            $note = WorkNote::query()->create($noteData);
            Session::flash('toast', [
                'type' => 'success',
                'msg'  => 'Message Sent!'
            ]);
        } catch (\Exception $e) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'Failed To Send Message!',
            ]);
        }
        return back();
    }
}
