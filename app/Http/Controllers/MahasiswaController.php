<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        { 
            return Mahasiswa::all(); 
        } 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([ 
            'npm' => 'required|string|unique:mahasiswa', 
            'nama' => 'required|string', 
            'tempat_lahir' => 'required|string', 
            'tanggal_lahir' => 'required|date', 
            'sex' => 'required|string', 
            'alamat' => 'required|string', 
            'telp' => 'required|string', 
            'email' => 'required|string|email|unique:mahasiswa', 
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
    
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads_avatar'), $filename);
            $validated['photo'] = $filename;
        }
    
        return Mahasiswa::create($validated);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        { 
            return Mahasiswa::findOrFail($id); 
        } 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $mahasiswa = Mahasiswa::findOrFail($id);

    $validated = $request->validate([ 
        'npm' => 'sometimes|required|string|unique:mahasiswa,npm,'.$mahasiswa->id, 
        'email' => 'sometimes|required|string|email|unique:mahasiswa,email,'.$mahasiswa->id,
        'nama' => 'sometimes|string',
        'tempat_lahir' => 'sometimes|string',
        'tanggal_lahir' => 'sometimes|date',
        'sex' => 'sometimes|string',
        'alamat' => 'sometimes|string',
        'telp' => 'sometimes|string',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('uploads_avatar'), $filename);
        $validated['photo'] = $filename;
    }

    $mahasiswa->update($validated);
    return $mahasiswa;
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        { 
            $mahasiswa = Mahasiswa::findOrFail($id); 
            $mahasiswa->delete(); 
            return response()->noContent(); 
        } 
    }
}
