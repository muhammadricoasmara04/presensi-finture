<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        return view('registrasi.index', [
            'title' => 'Register User',
            'active' => 'register'
        ]);
    }

    public function store(Request $request)
    {
        $validateRegis = $request->validate([
            'name' => 'required|max:255',
            'bumn' => 'required|max:255',
            'email' => ['required', 'email:dns', 'max:255', 'unique:users'],
            'password' => 'required|min:6|max:255'
        ]);
        $validateRegis['password'] = HASH::make($validateRegis['password']);
        User::create($validateRegis);
        return redirect('/admin/')->with('success', 'Registasi Akun Success');
    }
}
