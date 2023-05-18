<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MClient;
use App\Models\MProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CAuth extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function authenticate(Request $req)
    {
        // dd($req->all());
        $credentials = $req->validate([
            'email' => 'email',
            'password' => 'required'
        ]);
        // dd($credentials);

        if (Auth::attempt($credentials)) {
            $req->session()->regenerate();
            // return  auth()->user()->nama;
            return redirect()->intended('/dashboard');
        }

        return back()->with('gagal', 'Login gagal');
    }

    public function logout(Request $req)
    {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect('/');
    }

    public function dashboard()
    {
        // return 'dashboard';
        $data = [
            'title' => 'Dashboard',
            'project' => MProject::count(),
            'client' => MClient::count(),
            'user' => User::count(),
        ];
        return view('auth.dashboard', $data);
    }
}
