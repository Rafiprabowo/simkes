<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Diagnoses;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiagnosesController extends Controller
{
    //
    public function createDiagnose($id)
    {
        $appointment = Appointment::findOrFail($id);

        // Load related data (if needed)
        $appointment->load('employee.user', 'doctor.user');
        $medicines = Medicine::all();
        return view('content.diagnose.create_diagnose', compact('appointment', 'medicines'));
    }
    public function storeDiagnose(Request $request, $appointmentId)
        {
            $diagnosis = $request->input('diagnose');

            // Simpan diagnosis
            $newDiagnose = Diagnoses::updateOrCreate(
                ['appointment_id' => $appointmentId],
                ['diagnosis' => $diagnosis]
            );

            // Simpan detail diagnosa (medicines)
            foreach ($request->input('medications') as $medication) {
                $newDiagnose->medicines()->attach($medication['medicine_id']);
            }

            return redirect()->back()->with('success', 'Diagnosis berhasil ditambahkan');
        }


}
