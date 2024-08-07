<?php

namespace App\Http\Controllers;

use App\Models\PemeriksaanMajor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MajorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $majors = PemeriksaanMajor::all();
        return view('content.admin.pemeriksaan-major.index', compact('majors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('content.admin.pemeriksaan-major.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('pemeriksaan_majors', 'name')],
        ]);
        PemeriksaanMajor::create([
            'name' => $request->get('name'),
        ]);
        return redirect()->route('pemeriksaan-major.index')->with('success', 'Pemeriksaan major berhasil ditambahkan');
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
        $major = PemeriksaanMajor::find($id);
        return view('content.admin.pemeriksaan-major.edit', compact('major'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
          $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('pemeriksaan_majors', 'name')->ignore($id)],
        ]);

         $major = PemeriksaanMajor::find($id)->update($request->all());
          return redirect()->route('pemeriksaan-major.index')->with('success', 'Pemeriksaan major berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        PemeriksaanMajor::destroy($id);
        return redirect()->route('pemeriksaan-major.index')->with('success', 'Pemeriksaan major berhasil dihapus');
    }
}
