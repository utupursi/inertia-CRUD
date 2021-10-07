<?php

namespace App\Http\Controllers;

use App\Http\Request\UserRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();

        return inertia('User/Index', ['users' => $users]);
    }

    public function store(UserRequest $request)
    {
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make(uniqid())
        ]);

        return redirect()->back()->with('message', 'Success');
    }

    public function getUserById(Request $request)
    {

        $user = User::findOrFail($request['id']);
        return inertia('User/Index');

    }

    public function update(UserRequest $request)
    {
        $user = User::findOrFail($request['id']);
        $user->update([
            'name' => $request['name'],
            'email' => $request['email']
        ]);
        return redirect()->back();
    }

    public function delete(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back();
    }
}
