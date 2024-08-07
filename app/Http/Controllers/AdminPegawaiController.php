<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Employee;
use App\Models\Pharmacist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
      $employees = Employee::with(['user', 'appointments'])
    ->withCount('appointments')
    ->orderBy(User::select('first_name')
        ->whereColumn('users.id', 'employees.user_id'))
    ->paginate(5);

return view('content.admin.pegawai.index', compact('employees'))
    ->with('i', (request()->input('page', 1) - 1) * 5);

    }

     public function showAppointments($id)
    {
       $employee = Employee::with(['user', 'appointments.diagnoses'])->findOrFail($id);
    return view('content.admin.pegawai.show_appointments', compact('employee'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('content.admin.pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:8',
            'position' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:L,P',
            'medical_history' => 'nullable|string',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_number' => 'required|string|max:15',
            'emergency_contact_relationship' => 'required|string|max:255',
            'emergency_contact_address' => 'required|string|max:255',
        ]);


        // Simpan data user baru
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'pegawai', // Sesuaikan role sesuai dengan kebutuhan
        ]);

        // Simpan data karyawan yang berelasi dengan user baru
        $employee = Employee::create([
            'user_id' => $user->id,
            'position' => $request->position,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'medical_history' => $request->medical_history,
            'emergency_contact_name' => $request->emergency_contact_name,
            'emergency_contact_number' => $request->emergency_contact_number,
            'emergency_contact_relationship' => $request->emergency_contact_relationship,
            'emergency_contact_address' => $request->emergency_contact_address,
        ]);

        return redirect()->route('pegawais.index')->with('success', 'Pegawai Berhasil Dibuat');
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
        $employee = Employee::with('user')->findOrFail($id);
        return view('content.admin.pegawai.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Validasi input
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'username' => [
            'required',
            'string',
            'max:255',
            Rule::unique('users', 'username')->ignore($id),
        ],
        'email' => [
            'required',
            'string',
            'email',
            'max:255',
            Rule::unique('users', 'email')->ignore($id),
        ],
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'position' => 'required|string|max:255',
        'date_of_birth' => 'required|date',
        'gender' => 'required|in:L,P',
        'medical_history' => 'nullable|string',
        'emergency_contact_name' => 'required|string|max:255',
        'emergency_contact_number' => 'required|string|max:15',
        'emergency_contact_relationship' => 'required|string|max:255',
        'emergency_contact_address' => 'required|string|max:255',
    ]);

    try {
        DB::beginTransaction();

        // Update User
        $user = User::with('employee')->findOrFail($id);
        $userData = $request->only(['first_name', 'last_name', 'username', 'email', 'address', 'phone']);
        $user->update($userData);

        // Update Employee
        $employee = $user->employee()->firstOrFail();
        $employeeData = $request->only([
            'position',
            'date_of_birth',
            'gender',
            'medical_history',
            'emergency_contact_name',
            'emergency_contact_number',
            'emergency_contact_relationship',
            'emergency_contact_address'
        ]);
        $employee->update($employeeData);

        DB::commit();
        return redirect()->route('pegawais.index')->with('success', 'Pegawai berhasil diubah');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Ada kesalahan saat memperbarui pegawai']);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $pegawai = Employee::find($id);
        $pegawai->user->delete();
        $pegawai->delete();
        return redirect()->route('pegawais.index')->with('success', 'Pegawai Berhasil Dihapus');
    }

}
