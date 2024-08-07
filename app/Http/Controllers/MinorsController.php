<?php

namespace App\Http\Controllers;

use App\Models\PemeriksaanMajor;
use App\Models\PemeriksaanMinor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MinorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $minors = PemeriksaanMinor::all();
        return view('content.admin.pemeriksaan-minor.index', compact('minors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $pemeriksaanMajors = PemeriksaanMajor::all();
        return view('content.admin.pemeriksaan-minor.create', compact('pemeriksaanMajors'));
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
            Rule::unique('pemeriksaan_minors', 'name')
        ],
        'is_gender_oriented' => ['required', 'boolean'],
        'id_pemeriksaan_major' => ['required', 'integer', 'exists:pemeriksaan_majors,id'],
    ], [
        'name.required' => 'Name is required.',
        'name.unique' => 'Name is already taken.',
        'is_gender_oriented.required' => 'Is gender oriented is required.',
        'id_pemeriksaan_major.required' => 'Pemeriksaan major is required.',
        'id_pemeriksaan_major.exists' => 'Pemeriksaan major does not exist.',
    ]);

    PemeriksaanMinor::create($validatedData);

    return redirect()->route('pemeriksaan-minor.index')->with('success', 'Pemeriksaan Minor berhasil ditambahkan.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $minor = PemeriksaanMinor::find($id);
        $pemeriksaanMajors = PemeriksaanMajor::all();
        return view('content.admin.pemeriksaan-minor.edit', compact('minor', 'pemeriksaanMajors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
          $validatedData = $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
            Rule::unique('pemeriksaan_minors', 'name')->ignore($id)
        ],
        'is_gender_oriented' => ['required', 'boolean'],
        'id_pemeriksaan_major' => ['required', 'integer', 'exists:pemeriksaan_majors,id'],
    ], [
            'name.required' => 'Name is required.',
        'name.unique' => 'Name is already taken.',
        'is_gender_oriented.required' => 'Is gender oriented is required.',
        'id_pemeriksaan_major.required' => 'Pemeriksaan major is required.',
        'id_pemeriksaan_major.exists' => 'Pemeriksaan major does not exist.',
    ]);
          PemeriksaanMinor::find($id)->update($validatedData);
          return redirect()->route('pemeriksaan-minor.index')->with('success', 'Pemeriksaan Minor berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        PemeriksaanMinor::destroy($id);
        return redirect()->route('pemeriksaan-minor.index')->with('success', 'Pemeriksaan Minor berhasil dihapus.');
    }
}
