<?php

namespace App\Http\Controllers;

use App\Models\PemeriksaanMinor;
use Illuminate\Http\Request;

class PemeriksaanMinorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getPemeriksaanMinorById($id){
        $pemeriksaanMinor = PemeriksaanMinor::with(['nilaiRujukan', 'pemeriksaanMajor'])->find($id);
        if(!$pemeriksaanMinor){
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        $formattedPemeriksaanMinor = [
            'id' => $pemeriksaanMinor->id,
            'name' => $pemeriksaanMinor->name,
            'is_gender_oriented' => $pemeriksaanMinor->is_gender_oriented,
            'nilai_rujukan' => $pemeriksaanMinor->nilaiRujukan->map(function ($nilai){
                return [
                    'id' => $nilai->id,
                    'gender'=>$nilai->gender,
                    'reference_value' =>  $nilai->reference_value,
                    'satuan' => $nilai->satuan,
                ];
            }),
            'pemeriksaanMajor' => $pemeriksaanMinor->pemeriksaanMajor->name,
        ];
        return response()->json(['status' => 'success', 'data' => $formattedPemeriksaanMinor], 200);
    }

}
