<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\DetailDiagnosa;
use App\Models\Diagnoses;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DiagnosaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $user = Auth::user();
    $appointments = $user->doctor->appointments()
        ->with('employee.user', 'diagnoses.medicines')
        ->where('diagnosed', true)
        ->paginate(5); // Ganti angka 10 dengan jumlah item yang diinginkan per halaman

    return view('content.dokter.diagnosa.index', compact('user', 'appointments'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
           // Ambil dokter yang sedang login
    $doctor = Auth::user()->doctor;

    // Ambil appointments milik dokter yang sedang login
    $appointments = $doctor->appointments()
        ->where('diagnosed', false) // Hanya appointment yang belum didiagnosa
        ->where('status', 'approved')// Hanya appointment dengan status approved
        ->orderBy('appointment_date', 'asc')
        ->paginate(5);

    return view('content.dokter.diagnosa.create', compact('appointments'));
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
        $medicines = Medicine::all();
        $appointment = Appointment::find($id);
        return view('content.dokter.diagnosa.edit', compact('appointment','medicines'));
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
public function submitAllResep(Request $request)
{
    // Validasi data dari request
               $validator = Validator::make($request->all(), [
                'appointment_id' => 'required|integer',
                'employee_id' => 'required|integer',
                'doctor_id' => 'required|integer',
                'diagnosa' => 'required|string',
                'dataResep' => 'required|array',
                'dataResep.*.id' => 'required|integer|exists:medicines,id',
                'dataResep.*.dosis' => 'required|string',
                'dataResep.*.jumlah' => 'required|integer|min:1'
            ], [
                'appointment_id.required' => 'ID Janji temu wajib diisi',
                'employee_id.required' => 'ID Karyawan wajib diisi',
                'doctor_id.required' => 'ID Dokter wajib diisi',
                'diagnosa.required' => 'Diagnosa wajib diisi',
                'dataResep.required' => 'Obat wajib diisi',
                'dataResep.*.id.required' => 'Obat wajib diisi',
                'dataResep.*.dosis.required' => 'Dosis wajib diisi',
                'dataResep.*.jumlah.required' => 'Jumlah obat wajib diisi',
                'dataResep.*.jumlah.min' => 'Jumlah obat minimal 1'
            ]);


    if ($validator->fails()) {
        return response()->json(['success' => false, 'message' => $validator->errors()], 422);
    }

    $data = $validator->validated();

    try {
        // Gunakan transaksi database untuk memastikan konsistensi data
        DB::transaction(function () use ($data) {
            // Simpan diagnosa
            $diagnosa = Diagnoses::create([
                'appointment_id' => $data['appointment_id'],
                'employee_id' => $data['employee_id'],
                'doctor_id' => $data['doctor_id'],
                'diagnosa' => $data['diagnosa']
            ]);

            // Simpan resep obat
            foreach ($data['dataResep'] as $resep) {
                $medicine = Medicine::findOrFail($resep['id']);

                // Validasi stok
                if ($medicine->stock < $resep['jumlah']) {
                    throw new \Exception("Stok obat {$medicine->name} tidak mencukupi.");
                }

                // Kurangi stok
                $medicine->stock -= $resep['jumlah'];
                $medicine->save();

                // Simpan detail resep
                DetailDiagnosa::create([
                    'id_diagnosis' => $diagnosa->id,
                    'id_medicine' => $resep['id'],
                    'dosis_obat' => $resep['dosis'],
                    'jumlah' => $resep['jumlah']
                ]);
            }

            // Tandai appointment sebagai diagnosed
            $appointment = Appointment::find($data['appointment_id']);
            $appointment->diagnosed = true;
            $appointment->save();
        });

        return response()->json(['status' => 'success', 'message' => 'Diagnosa berhasil dibuat'], 200);
    } catch (\Exception $e) {
        // Tangkap dan beri pesan kesalahan yang jelas
        return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
    }
}




}
