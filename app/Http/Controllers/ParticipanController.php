<?php

namespace App\Http\Controllers;

use App\Models\Participan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Presensi;
use App\Models\Dashboard;

class ParticipanController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::id(); // Ambil ID pengguna yang sedang login
        $today = date("Y-m-d");

        // Cari presensi berdasarkan ID pengguna dan tanggal hari ini
        $presensitoday = DB::table('presensi')->where('user_id', $id)->where('date', $today)->first();

        // Ambil data profil pengguna berdasarkan ID
        $user_profile = DB::table('users')->where('id', $id)->first();

        // Lain-lain
        $checkin_in = $presensitoday ? $presensitoday->checkin_time : 'Belum Absen';
        $checkout_out = $presensitoday && $presensitoday->checkout_time ? $presensitoday->checkout_time : 'Belum Absen';

        return view('/dashboard/peserta/index', compact('presensitoday', 'checkin_in', 'checkout_out', 'user_profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $today = date("Y-m-d");
        $name   = Auth::user()->name;
        $check = DB::table('presensi')->where('date', $today)->where('name', $name)->count();
        return view('/dashboard/peserta/create', compact('check'));
    }

    public function uploadSickLetter(Request $request)
    {
        $request->validate([
            'suratSakit' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);
        $location = $request->location;
        $file = $request->file('suratSakit');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('surat', $fileName, 'public');

        DB::table('presensi')->insert([
            'name' => $request->user()->name,
            'status' => $request->status,
            'sick_letter' => $filePath,
            'date' => date('Y-m-d'),
            'checkin_time' => date("H:i:s"),
            'location_in' => $location,
        ]);

        return redirect('/dashboard')->with('success', 'Surat sakit berhasil diunggah.');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = Auth::id(); // Gunakan ID pengguna yang sedang login
        $name = Auth::user()->name;
        $location = $request->location;
        $image = $request->image;
        $checkin_time = date("H:i:s");
        $checkout_time = date("H:i:s");
        $date = date("Y-m-d");
        $status = $request->status;
        $reason = $request->reason;
        $folder_path = "public/uploads/absensi/";
        $image_parts = explode(";base64,", $image);
        $image_base64 = base64_decode($image_parts[1]);

        // Periksa apakah pengguna sudah melakukan check-in
        $check = DB::table('presensi')->where('date', $date)->where('user_id', $user_id)->count();

        if ($check > 0) {
            $formatName = $name . "-" . $date . "-checkout";
            $fileName = $formatName . ".png";
            $file = $folder_path . $fileName;
            $date_out = [
                'checkout_time' => $checkout_time,
                'image_out' => $fileName,
                'location_out' => $location,
            ];
            $update = DB::table('presensi')->where('date', $date)->where('user_id', $user_id)->update($date_out);
            if ($update) {
                echo "success|Terimakasih, Sudah Absen Pulang|out";
                Storage::put($file, $image_base64);
            } else {
                echo "error|Maaf Gagal Absen Pulang, Silahkan Hubungi Admin FHCI|out ";
            }
        } else {
            $formatName = $name . "-" . $date . "-checkin";
            $fileName = $formatName . ".png";
            $file = $folder_path . $fileName;

            $data = [
                'user_id' => $user_id,
                'name' => $name,
                'date' => $date,
                'checkin_time' => $checkin_time,
                'image_in' => $fileName,
                'location_in' => $location,
                'status' => $status,
                'reason' => $reason,
            ];

            $simpan = DB::table('presensi')->insert($data);
            if ($simpan) {
                echo "success|Terimakasih, Selamat Menjalankan Aktivitasnya|in";
                Storage::put($file, $image_base64);
            } else {
                echo "error|Maaf Gagal Absen, Silahkan Hubungi Admin FHCI|in";
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $user = Auth::user(); // Mendapatkan data user yang sedang login
        $presensi = DB::table('presensi')->where('user_id', $user->id)->get();

        return view("/dashboard/peserta/show", ['presensi' => $presensi]);
    }
    public function previewData($user_id)
    {


        $presensi = DB::table('presensi')->where('id', $user_id)->first();

        if (!$presensi) {
            return redirect('/dashboard')->with('error', 'Data tidak ditemukan.');
        }
        return view('dashboard/peserta/previewdata', compact('presensi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Participan $participan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Participan $participan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Participan $participan)
    {
        //
    }

    public function editprofile(Request $request)
    {
       
        $user = Auth::user()->name;
        $users = DB::table('users')->where('name', $user)->first();
        return view("dashboard.profile.editprofile", compact('users'), ['user' => $user]);
    }

    public function updateprofile(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'division' => 'nullable|string|max:255',
            'password' => 'nullable|min:6|confirmed',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
        ]);

        // Cari pengguna berdasarkan ID
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Update nama dan BUMN
        $user->name = $request->input('name');
        $user->division = $request->input('division');

        // Update password jika ada
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Proses foto jika diupload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->image_profile && Storage::exists($user->image_profile)) {
                Storage::delete($user->image_profile);
            }

            // Simpan foto baru
            $userName = $request->id;
            $file = $request->file('foto');
            $filename = $userName . '-' . $file->getClientOriginalName();
            $path = $file->storeAs('public/uploads/profileimage', $filename);
            $user->image_profile = $path;
        }

        // Simpan perubahan
        $user->save();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }


    public function showMap()
    {
        $user = Auth::user();
        return view('map', compact('user'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('');
    }
}
