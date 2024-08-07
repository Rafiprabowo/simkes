<?php

namespace App\Http\Controllers;

use App\Models\DoctorSpecialization;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SpecilitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $specialities = DoctorSpecialization::all();
        return view('content.admin.doctor-speciality.index', compact('specialities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('content.admin.doctor-speciality.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('doctor_specializations', 'name')],
        ]);
        DoctorSpecialization::create([
            'name' => $request->get('name'),
        ]);
        return redirect()->route('specialities.index')->with('success', 'Spesialisasi berhasil ditambahkan');
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
        $speciality = DoctorSpecialization::find($id);
        return view('content.admin.doctor-speciality.edit', compact('speciality'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
         $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('doctor_specializations', 'name')->ignore($id)],
        ]);

        DoctorSpecialization::find($id)->update([
            'name' => $request->get('name'),
        ]);
        return redirect()->route('specialities.index')->with('success', 'Spesialisasi berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        DoctorSpecialization::where('id', $id)->delete();
        return redirect()->route('specialities.index')->with('success', 'Spesialisasi berhasil dihapus');
    }
}
