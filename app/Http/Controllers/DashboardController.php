<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard/peserta/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function storeStatus(Request $request)
    {
        // Validasi data jika diperlukan
        $request->validate([
            'status' => 'required|string|max:255',
        ]);

        // Simpan data ke database
        Dashboard::create([
            'status' => $request->status,
        ]);

        // Response JSON
        return response()->json(['success' => 'Status berhasil disimpan']);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return view('dashboard/peserta/show');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
