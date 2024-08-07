<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use App\Models\DoctorSpecialization;
use App\Models\MedicalCheckUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    //
    public function dashboard(){
       // Ambil pengguna yang sedang login
        $user = Auth::user()->load(['doctor.appointments', 'doctor.medicalCheckups', 'doctor.schedules']);

        // Notifikasi
        $notifications = $user->notifications;
        $unreadNotifications = $user->unreadNotifications;

            $totalMedicalCheckUpMenunggu = MedicalCheckup::where('id_doctor', $user->doctor->id)->count();
        $totalAppointmentBelumDidiagnosa = Appointment::where('doctor_id', $user->doctor->id)
                                        ->where('diagnosed', 0)
                                        ->count(); // Ensure you call count() to get the integer value
        $totalAppointmentMenunggu = Appointment::where('doctor_id', $user->doctor->id)
            ->where('status', 'pending')
            ->count(); // Ensure you call count() to get the integer value
        $totalJadwal = DoctorSchedule::where('doctor_id', $user->doctor->id)->count();



        // Kirim data ke view
        return view('content.dokter.dashboard', compact(
            'user',
            'notifications',
            'unreadNotifications',
            'totalMedicalCheckUpMenunggu',
            'totalAppointmentMenunggu',
            'totalJadwal',
            'totalAppointmentBelumDidiagnosa'
        ));

    }
    public function profile()
    {
        $user = Auth::user();
        $specializations = DoctorSpecialization::all();
        return view('content.dokter.profile', compact('user','specializations' ));
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'speciality_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = Auth::user();
        Doctor::where('user_id', $user->id)->update([
           'speciality_id' => $validator->validated()['speciality_id'],
        ]);
        return redirect()->back()->with(['success' => 'Profil berhasil diupdate']);

    }

    public function myAppointment(){
        $user = Auth::user()->load('doctor');
        $user->load(['doctor.appointments' => function ($query) {
                    $query->with('employee.user');
                }]);
        return view('content.appointment.dokter.appointment_history', compact('user'));
    }



}
