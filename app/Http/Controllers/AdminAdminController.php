<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Employee;
use App\Models\Pharmacist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class AdminAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $admins = Admin::with('user')->paginate(5);
        return view('content.admin.admin.index',compact('admins'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('content.admin.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
           $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
             'gender' => 'required'
        ]);

        // Buat user baru
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'username' => $request->username,
            'password' =>$request->password,
            'address' => $request->address,
            'phone' => $request->phone,
            'role' => 'admin',
        ]);

        $admin = Admin::create([
            'user_id' => $user->id,
            'gender' => $request->get('gender'),
        ]);

        return redirect()->route('admins.index')->with('success', 'Admin berhasil ditambahkan');
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
        $admin = Admin::with('user')->findOrFail($id);
        return view('content.admin.admin.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, $id)
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
        'gender' => 'required|in:L,P',
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
    ]);

    try {
        DB::beginTransaction();

        // Cari user berdasarkan ID
        $user = User::findOrFail($id);

        // Perbarui data user
        $user->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
        ]);

        // Perbarui data admin jika ada
        $admin = Admin::where('user_id', $user->id)->firstOrFail();
        $admin->update([
            'gender' => $request->input('gender'),
            // tambahkan update field lain yang mungkin perlu untuk admin di sini
        ]);

        DB::commit();
        return redirect()->route('admins.index')->with('success', 'Admin berhasil diubah');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Ada kesalahan saat update admin']);
    }
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $admin = Admin::find($id);
        $admin->user->delete();
        $admin->delete();
        return redirect()->route('admins.index')->with('success', 'Admin berhasil dihapus');
    }
}
