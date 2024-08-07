<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateEmployeeProfileRequest;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Employee;
use App\Models\MedicalCheckUp;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    //

    public function dashboard(){
         $user = Auth::user()->load(['employee.appointments', 'employee.medicalCheckups']);
         $totalAppointmentMenunggu = Appointment::where('employee_id',$user->employee->id)->where('status','pending')->count();
        $totalAppointmentApproved = Appointment::where('employee_id',$user->employee->id)->where('status','approved')->count();
        $totalAppointmentBelumDidiagnosa = Appointment::where('employee_id',$user->employee->id)->where('diagnosed',0)->count();
        $totalAppointmentSudahDiagnosa = Appointment::where('employee_id',$user->employee->id)->where('diagnosed',1)->count();
        $totalMedicalCheckUpMenunggu = MedicalCheckUp::where('id_employee',$user->employee->id)->where('status',0)->count();
        // Kirim data ke view
        return view('content.pegawai.dashboard', compact('user', 'totalAppointmentMenunggu', 'totalAppointmentApproved', 'totalAppointmentBelumDidiagnosa', 'totalMedicalCheckUpMenunggu', 'totalAppointmentSudahDiagnosa'));
    }
    public function profile(){
        $user = Auth::user()->load('employee');
        return view('content.pegawai.profile', compact('user'));
    }
    public function myJadwal()
    {
        $user = Auth::user()->load('employee');
        $mcus = MedicalCheckUp::where('id_employee', $user->employee->id)->paginate(10);
        return view('content.pegawai.medical-check-up.jadwalku', compact('user', 'mcus'));
    }
         public function updateProfileEmployee(Request $request)
    {
        // Validasi data yang dikirimkan
             $request->validate([
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:L,P',
            'position' => 'required|string|max:255',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_relationship' => 'required|string|max:255',
            'emergency_contact_number' => 'required|string|max:255',
            'emergency_contact_address' => 'required|string|max:255',
            'medical_history' => 'required|string',
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();

        // Update data employee
        $employee = $user->employee;
        $employee->date_of_birth = $request->date_of_birth;
        $employee->gender = $request->gender;
        $employee->position = $request->position;
        $employee->emergency_contact_name = $request->emergency_contact_name;
        $employee->emergency_contact_relationship = $request->emergency_contact_relationship;
        $employee->emergency_contact_number = $request->emergency_contact_number;
        $employee->emergency_contact_address = $request->emergency_contact_address;
        $employee->medical_history = $request->medical_history;

        // Simpan perubahan ke database
        $employee->save();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Profil berhasil diperbaharui');
    }

    public function myAppointment()
    {
    $user = Auth::user()->load('employee');

    if ($user->employee) {
        $appointments = $user->employee->appointments()->with('doctor.user')->paginate(5);
    } else {
        $appointments = collect(); // empty collection if no employee is associated
    }

    return view('content.appointment.pegawai.index', compact('user', 'appointments'));
    }
    public function myDiagnosis(){
         $user = Auth::user();
    $appointments = $user->employee->appointments()
        ->with('doctor.user', 'diagnoses.medicines')
        ->paginate(5); // Ganti angka 10 dengan jumlah item yang diinginkan per halaman

    return view('content.pegawai.diagnosa.index', compact('user', 'appointments'));
    }
    public function myDiagnosisDetail($id){
          $user = Auth::user();
          $appointment = $user->employee->appointments()
              ->with( 'diagnoses.medicines', 'doctor.speciality')
            ->find($id);
          return view('content.pegawai.diagnosa.detail', compact('user', 'appointment'));
    }
    public function myMedicalCheckUp(){
         $medicalCheckUps = MedicalCheckUp::with(['doctor.user','pemeriksaanMinors' => function ($query) {
            $query->with(['nilaiRujukan', 'pemeriksaanMajor']);
        }])
            ->where('id_employee', Auth::user()->employee->id)
            ->paginate(10);
        return view('content.pegawai.medical-check-up.index', compact('medicalCheckUps'));
    }
    public function showMyCheckUp($id){
         $medicalCheckUps = MedicalCheckUp::with(['pemeriksaanMinors' => function ($query) {
            $query->with(['nilaiRujukan', 'pemeriksaanMajor']);
        }])->with('doctor.user')->findOrFail($id);
        return view('content.pegawai.medical-check-up.detail', compact('medicalCheckUps'));
    }


}
