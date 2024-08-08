<?php

namespace App\Http\Controllers;

use App\Models\DetailPemeriksaan;
use App\Models\Doctor;
use App\Models\Employee;
use App\Models\MedicalCheckUp;
use App\Models\PemeriksaanMinor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MedicalCheckUpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
        {
            $medicalCheckUps = MedicalCheckUp::with(['pemeriksaanMinors' => function ($query) {
                $query->with(['nilaiRujukan', 'pemeriksaanMajor']);
            }])
            ->where('id_doctor', Auth::user()->doctor->id)
            ->where('status', 1) // Menambahkan kondisi untuk hanya menampilkan status 1
            ->paginate(10);

            return view('content.dokter.medical-check-up.index', compact('medicalCheckUps'));
        }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $pemeriksaanMinors = PemeriksaanMinor::all();
        $doctorId = Auth::user()->doctor->id;

        $medicalCheckUps = MedicalCheckUp::with('employee.user')
            ->where('id_doctor', $doctorId)
            ->where('status', 0)
            ->where('date')
            ->get(); // tambahkan get() untuk mengeksekusi query

        return view('content.dokter.medical-check-up.create', compact('pemeriksaanMinors', 'medicalCheckUps'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
         $medicalCheckUps = MedicalCheckUp::with(['pemeriksaanMinors' => function ($query) {
            $query->with(['nilaiRujukan', 'pemeriksaanMajor']);
        }])->with('employee.user')->findOrFail($id);
         $user = Auth::user()->load('doctor');
        return view('content.dokter.medical-check-up.detail', compact('medicalCheckUps', 'user'));

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
    public function storeMcu(Request $request){
          $validated = $request->validate([
        'id_employees' => 'required|array',
        'id_employees.*' => 'exists:employees,id',
        'id_doctor' => 'required|exists:doctors,id',
        'date' => 'required|date',
    ]);

    $doctor = Doctor::find($validated['id_doctor']);
    $date = $validated['date'];

    foreach ($validated['id_employees'] as $employee_id) {
        $medicalCheckUp = MedicalCheckUp::Create([
        'id_employee' => $employee_id,
        'id_doctor' => $request->id_doctor,
        'date' => $request->date
        ]);
    }
        return redirect()->route('jadwalCheckUpPegawai')->with('success', 'Jadwal MCU berhasil dibuat');
    }
    public function updateMcu(Request $request, string $id){
        $request->validate([
            'id_employee' => 'required|exists:employees,id',
            'id_doctor' => 'required|exists:doctors,id',
            'date' => 'required|date',
        ]);
        MedicalCheckUp::find($id)->update($request->all());
        return redirect()->route('jadwalCheckUpPegawai')->with('success', 'Jadwal MCU berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function indexMedicalRecord()
    {
        $medicalCheckUps = MedicalCheckUp::with(['pemeriksaanMinors' => function ($query) {
            $query->with(['nilaiRujukan', 'pemeriksaanMajor']);
        }])
            ->where('id_doctor', Auth::user()->doctor->id)
            ->get();
        return view('content.dokter.medical-check-up.update', compact('medicalCheckUps'));
    }

public function submitAllPemeriksaan(Request $request)
{
    // Validasi request
    $validator = Validator::make($request->all(), [
        'id_employee' => 'required|exists:employees,id',
        'id_doctor' => 'required|exists:doctors,id',
        'medical_check_ups_id' => 'required|exists:medical_check_ups,id',
        'pemeriksaanData' => 'required|array|min:1',
        'pemeriksaanData.*.id' => 'required|exists:pemeriksaan_minors,id',
        'pemeriksaanData.*.nilai' => 'required|string'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422);
    }

    // Hilangkan duplikat pemeriksaan minor berdasarkan ID
    $uniquePemeriksaanData = collect($request->pemeriksaanData)->unique('id')->values();
    Log::info('Unique Pemeriksaan Data: ', $uniquePemeriksaanData->toArray());

    // Mulai transaksi
    DB::beginTransaction();
    try {
        // Ambil record medical check-up
        $medicalCheckUp = MedicalCheckUp::findOrFail($request->medical_check_ups_id);
        Log::info('Medical Check Up Retrieved: ', $medicalCheckUp->toArray());

        // Update record medical check-up
        $medicalCheckUp->update([
            'date' => now(),
            'status' => 1,
        ]);
        Log::info('Medical Check Up Updated: ', $medicalCheckUp->toArray());

        foreach ($uniquePemeriksaanData as $pemeriksaan) {
            $detail = DetailPemeriksaan::updateOrCreate(
                [
                    'id_medical_check_up' => $medicalCheckUp->id,
                    'id_pemeriksaan_minor' => $pemeriksaan['id']
                ],
                [
                    'result' => $pemeriksaan['nilai']
                ]
            );
            Log::info('Detail Pemeriksaan Updated/Created: ', $detail->toArray());
        }



        // Commit transaksi
        DB::commit();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil disimpan'
        ]);
    } catch (\Exception $e) {
        // Rollback transaksi jika ada error
        DB::rollBack();

        Log::error('Error in submitAllPemeriksaan: ' . $e->getMessage());
        Log::error('Exception Trace: ' . $e->getTraceAsString());

        return response()->json([
            'status' => 'error',
            'message' => 'Failed to submit data',
            'error' => $e->getMessage()
        ], 500);
    }
}






}
