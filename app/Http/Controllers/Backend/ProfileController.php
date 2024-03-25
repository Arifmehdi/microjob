<?php

namespace App\Http\Controllers\Backend;

use App\DTO\ProfileDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    public function profileView()
    {
        return view('backend.profile.profile');
    }

    public function profileUpdate(ProfileRequest $request, $id)
    {
        $userData = ProfileDTO::createFromRequest($request);
        try {
            Auth::user()->update($userData->toArray());
            Session::flash('toast', [
                'type' => 'success',
                'msg'  => 'Profile Updated'
            ]);
        } catch (\Exception $e) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'Failed To Update Profile!',
            ]);
        }
        return redirect()->route('admin.profile.view');
    }

    public function passwordView()
    {
        return view('backend.profile.password');
    }

    public function passwordUpdate(PasswordRequest $request)
    {
        if (!Hash::check($request->current_password, Auth::user()->getAuthPassword())) {
            throw ValidationException::withMessages([
                'current_password' => 'The Password is incorrect',
            ]);
        }
        try {
            Auth::user()->update([
                'password' => Hash::make($request->new_password),
            ]);
            Session::flash('toast', [
                'type' => 'success',
                'msg'  => 'Password Updated'
            ]);
        } catch (\Exception $e) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'Failed To Password Profile!',
            ]);
        }
        return redirect()->route('admin.password.view');
    }
}
