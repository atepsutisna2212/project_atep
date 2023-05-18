<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CUser extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'User',
            'data' => User::all(),
        ];
        // dd(session());

        return view('auth.user', $data);
    }

    public function store(Request $request)
    {
        $validasi = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);
        $validasi['password'] = bcrypt($request->password);
        $validasi['password2'] = $request->password;
        // dd($validasi);
        User::create($validasi);
        return redirect('/user')->with('message', 'New data user successfully');
    }

    public function update(Request $request, User $user)
    {
        // dd($user->email);
        $validasi = $request->validate([
            'name' => 'required',
            'email' => [
                'email',
                'required',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => 'required',
        ]);
        $validasi['password'] = bcrypt($request->password);
        $validasi['password2'] = $request->password;

        // dd($validasi);
        User::where('id', $user->id)->update($validasi);
        return redirect('/user')->with('message', 'Update data user successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->id == auth()->user()->id)
            return redirect('/user')->with('error', 'Cannot delete the account that is being used');

        User::destroy($user->id);
        return redirect('/user')->with('message', 'Delete data user successfully');
    }
}
