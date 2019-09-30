<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\StoreProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('pages.profiler', ['user' => $user]);
    }

    public function store(StoreProfile $request)
    {
        $user = Auth::user();
        $user->edit($request->all());
        $user->generatePassword($request->get('password'));

        if ($request->has('avatar')) {
            $user->uploadAvatar($request->file('avatar'));
        }

        return redirect()->back()->with('status', 'The profile was successfully updated');
    }
}
