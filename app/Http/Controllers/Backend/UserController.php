<?php

namespace App\Http\Controllers\Backend;

use App\DTO\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->orderByDesc('created_at')->get();
        return view('backend.user.index', compact('users'));
    }

    public function create()
    {
        return view('backend.user.create');
    }

    public function store(UserRequest $request)
    {
        $userRequest = UserDTO::createFromRequest($request);
        try {
            $user = User::query()->create($userRequest->toArray());
            Session::flash('toast', [
                'type' => 'success',
                'msg'  => 'User Created!'
            ]);
        } catch (\Exception $e) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'Failed To Create User!'
            ]);
        }
        return redirect()->route('admin.users.index');
    }


    public function edit($id)
    {
        $user = User::query()->findOrFail($id);
        return view('backend.user.edit', compact('user'));
    }


    public function update(UserRequest $request, $id)
    {
        $user        = User::query()->findOrFail($id);
        $userRequest = UserDTO::createFromRequest($request);
        $userData    = $userRequest->toArray();

        if (!$user->is_deletable && isset($userData['is_admin'])) {
            $userData['is_admin']     = true;
            $userData['is_deletable'] = false;
            $userData['status']       = true;
        }

        try {
            $user->update($userData);
            Session::flash('toast', [
                'type' => 'success',
                'msg'  => 'User Updated!'
            ]);
        } catch (\Exception $e) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'Failed To Update User!'
            ]);
        }
        return redirect()->route('admin.users.edit', $user->id);
    }


    public function destroy($id)
    {
        $user = User::query()->findOrFail($id);

        if (!$user->is_deletable) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'Unable to delete user.'
            ]);
            return redirect()->route('admin.users.index');
        }
        try {
            $user->delete();
            Session::flash('toast', [
                'type' => 'success',
                'msg'  => 'User Delete!'
            ]);
        } catch (\Exception $e) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'Failed To Delete User!'
            ]);
        }
        return redirect()->route('admin.users.index');
    }
}
