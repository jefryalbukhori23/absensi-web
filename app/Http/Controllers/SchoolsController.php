<?php

namespace App\Http\Controllers;

use App\Models\schools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SchoolsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = schools::all();
        return response()->json([
            'data' => $data
        ], 200);
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
        // Validasi input
        $request->validate([
            'school_name' => 'required|string|max:255',
            'type_school' => 'required',
            // 'npsn' => 'string|max:255',
            // 'email' => 'email|max:255',
            // 'telephone_number' => 'string|max:20',
            // 'address' => 'string|max:255',
            // 'headmaster' => 'string|max:255',
            // 'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

        // Menyimpan data ke dalam database
        $school = new schools([
            'school_name' => $request->input('school_name'),
            'type_school' => $request->input('type_school'),
            'npsn' => $request->input('npsn'),
            'email' => $request->input('email'),
            'telephone_number' => $request->input('telephone_number'),
            'address' => $request->input('address'),
            'headmaster' => $request->input('headmaster'),
        ]);

        // Mengelola gambar logo jika diupload
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $school->logo = $logoPath;
        }

        $school->save();

        return response()->json([
            'data' => $school
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = schools::find($id);
        return response()->json([
            'data' => $data
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'school_name' => 'required|string|max:255',
            'type_school' => 'required',
            // 'npsn' => 'string|max:255',
            // 'email' => 'email|max:255',
            // 'telephone_number' => 'string|max:20',
            // 'address' => 'string|max:255',
            // 'headmaster' => 'string|max:255',
            // 'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

        // Mengambil data sekolah berdasarkan ID
        $school = schools::findOrFail($id);

        // Memperbarui data sekolah
        $school->update([
            'school_name' => $request->input('school_name'),
            'type_school' => $request->input('type_school'),
            'npsn' => $request->input('npsn'),
            'email' => $request->input('email'),
            'telephone_number' => $request->input('telephone_number'),
            'address' => $request->input('address'),
            'headmaster' => $request->input('headmaster'),
        ]);

        // Mengelola gambar logo jika diupload
        if ($request->hasFile('logo')) {
            // Menghapus gambar lama (optional)
            Storage::disk('public')->delete($school->logo);

            // Menyimpan gambar baru
            $logoPath = $request->file('logo')->store('logos', 'public');
            $school->logo = $logoPath;
            $school->save();
        }

        return response()->json([
            'data' => $school
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = schools::find($id);
        Storage::disk('public')->delete($data->logo);
        $data->delete();
        return response()->json([
            'msg' => 'success'
        ], 200);
    }
}
