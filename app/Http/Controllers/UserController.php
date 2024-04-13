<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function list()
    {
        return view('user.list', [
            'users' => User::get()
        ]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(StoreUserRequest $request)
    {
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = $request->input('role');
        $user->save();

        return redirect()->route('users.list');
    }

    public function edit()
    {
        //
    }

    public function update(UpdateUserRequest $request, string $userId)
    {
        $user = User::findOrFail($userId);
        $user->name = $request->input('name');
        $user->key = $request->input('email');
        $user->role = $request->input('role');

        if ($request->has('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->route('users.list');
    }

    public function destroy(string $userId)
    {
        User::findOrFail($userId)->delete();

        return redirect()->route('users.list');
    }
}
