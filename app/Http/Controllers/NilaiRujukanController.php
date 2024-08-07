<?php

namespace App\Http\Controllers;

use App\Models\NilaiRujukan;
use App\Models\PemeriksaanMinor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NilaiRujukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $minors = PemeriksaanMinor::with('nilaiRujukan')->get();
        return view('content.admin.nilai-rujukan.index', compact('minors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $minors = PemeriksaanMinor::all();
        return view('content.admin.nilai-rujukan.create', compact('minors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'id_pemeriksaan_minor' => ['required', 'exists:pemeriksaan_minors,id', Rule::unique('nilai_rujukans', 'id_pemeriksaan_minor')],
            'l' => 'required',
            'p' => 'required',
            'satuan' => 'required',
        ]);
        NilaiRujukan::create([
            'id_pemeriksaan_minor' => $request->id_pemeriksaan_minor,
            'gender' => 'L',
            'reference_value' => $request->l,
            'satuan' => $request->satuan
        ]);
        NilaiRujukan::create([
            'id_pemeriksaan_minor' => $request->id_pemeriksaan_minor,
            'gender' => 'P',
            'reference_value' => $request->p,
            'satuan' => $request->satuan
        ]);

        return redirect()->route('nilai-rujukans.index')->with('success', 'Nilai Rujukan berhasil ditambahkan');
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
        $minor = PemeriksaanMinor::with('nilaiRujukan')->findOrFail($id);
        return view('content.admin.nilai-rujukan.edit', compact('minor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $request->validate([
        'id_pemeriksaan_minor' => [
            'required',
            'exists:pemeriksaan_minors,id',
            Rule::unique('nilai_rujukans', 'id_pemeriksaan_minor')->ignore($id, 'id_pemeriksaan_minor'),
        ],
        'l' => 'required',
        'p' => 'required',
        'satuan' => 'required',
    ]);

    // Update nilai rujukan untuk gender 'P'
    NilaiRujukan::where('id_pemeriksaan_minor', $id)->where('gender', 'P')->update([
        'reference_value' => $request->p,
        'satuan' => $request->satuan
    ]);

    // Update nilai rujukan untuk gender 'L'
    NilaiRujukan::where('id_pemeriksaan_minor', $id)->where('gender', 'L')->update([
        'reference_value' => $request->l,
        'satuan' => $request->satuan
    ]);

    return redirect()->route('nilai-rujukans.index')->with('success', 'Nilai Rujukan berhasil diubah');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        NilaiRujukan::where('id_pemeriksaan_minor', $id)->delete();
        return redirect()->route('nilai-rujukans.index')->with('success', 'Data deleted successfully.');
    }
}
