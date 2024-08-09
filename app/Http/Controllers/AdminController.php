<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Doctor;
use App\Models\DoctorSpecialization;
use App\Models\Employee;
use App\Models\Pharmacist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function dashboard(){
        $totalDokter = Doctor::all()->count();
        $totalPegawai = Employee::all()->count();
        $totalApoteker = Pharmacist::all()->count();
        $totalAdmin = Admin::all()->count();
        return view('content.admin.dashboard', compact('totalDokter', 'totalPegawai', 'totalApoteker', 'totalAdmin'));
    }
    public function profile(){
        $user = Auth::user()->load('admin');
        return view('content.admin.profile', compact('user'));
    }
   public function buatCheckUpPegawai(){
    $doctors = Doctor::whereHas('speciality', function ($query) {
        $query->where('name', 'Dokter Umum');
    })
    ->with('user') // Assuming you have a user relationship on the Doctor model
    ->get();

    $employees = Employee::with('user')
        ->get()
        ->sortBy(function($employee) {
            return $employee->user->first_name . ' ' . $employee->user->last_name;
        });

    return view('content.admin.buat_check_up_pegawai', compact('doctors', 'employees'));
}


    public function updateProfile(Request $request){
        $user = Auth::user();
        $request->validate([
        'name' => 'required',
        'phone' => 'required',
        'address' => 'required',
        'spesialisasi' => 'required',
    ]);

        DB::transaction(function() use($user, $request){
            $user->name = $request->get('name');
        $user->address = $request->get('address');
        $user->phone = $request->get('phone');
        $user->save();

           Admin::updateOrCreate(
            ['user_id' => $user->id],

        );
        });
        return redirect()->back()->with('success', 'Profil berhasil diubah');
    }

    public function changeRole()
    {
        return view('content.admin.change_role_user');
    }

    public function updateRole(Request $request)
{
    $user = Auth::user();
    $request->validate([
        'id' => 'required',
        'role' => 'required',
    ]);

    try {
        DB::transaction(function() use ($request, $user) {
            $selectedUser = User::findOrFail($request->get('id'));

            if ($user->id === $selectedUser->id) {
                throw new \Exception("You can't edit your own role!");
            }

            $oldRole = $selectedUser->role;
            $newRole = $request->get('role');

            $selectedUser->role = $newRole;
            $selectedUser->save();
            // Delete related data based on old role
            if ($oldRole === 'apoteker') {
                Pharmacist::where('user_id', $selectedUser->id)->delete();
            } elseif ($oldRole === 'doctor') {
                Doctor::where('user_id', $selectedUser->id)->delete();
            } elseif ($oldRole === 'employee') {
                Employee::where('user_id', $selectedUser->id)->delete();
            }
            // Buat data baru di tabel terkait berdasarkan peran baru
            if ($newRole === 'apoteker') {
                Pharmacist::create(['user_id' => $selectedUser->id]);
            } elseif ($newRole === 'doctor') {
                Doctor::create(['user_id' => $selectedUser->id]);
            } elseif ($newRole === 'employee') {
                Employee::create(['user_id' => $selectedUser->id]);
            }
        });

        return redirect()->route('admin.changeRole')->with('success', 'Role updated successfully and related data removed.');

    } catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }
}

}
