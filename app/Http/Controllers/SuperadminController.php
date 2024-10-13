<?php

namespace App\Http\Controllers;

use App\Models\Superadmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class SuperadminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view("dashboard.superadmin.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Superadmin $superadmin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedUser = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed', // Password optional
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Gambar optional
        ]);

        $user = User::findOrFail($id);

        // Cek apakah password diisi
        if ($request->filled('password')) {
            $validatedUser['password'] = bcrypt($request->password);
        } else {
            unset($validatedUser['password']);
        }

        // Cek apakah ada file foto yang diupload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = $user->id . '-' . $file->getClientOriginalName();
            $path = $file->storeAs('public/uploads/profileimage', $filename);
            $validatedUser['image_profile'] = $path;
        }

        // Update user
        $user->update($validatedUser);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'User profile updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Superadmin $superadmin)
    {
        //
    }
    public function userAll()
    {
        $usersDB = DB::table('users')->get(); // Mengambil semua data dari tabel users
        return view('dashboard.superadmin.show', compact('usersDB'));
    }

    public function recapAll(Request $request)
    {

        $usersRecap = DB::table('presensi')->get();
        return view('dashboard.superadmin.recap', compact('usersRecap'));
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('');
    }
    public function previewData($user_id)
    {


        $presensi = DB::table('presensi')->where('id', $user_id)->first();

        if (!$presensi) {
            return redirect('/')->with('error', 'Data tidak ditemukan.');
        }
        return view('dashboard/peserta/previewdata', compact('presensi'));
    }
    public function edituser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        return view("dashboard/superadmin/edituser", compact('user'));
    }
}
