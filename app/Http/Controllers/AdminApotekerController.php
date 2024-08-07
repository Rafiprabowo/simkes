<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Pharmacist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
class AdminApotekerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    $pharmacists = Pharmacist::with('user')->paginate(5);
        return view('content.admin.apoteker.index', compact('pharmacists'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('content.admin.apoteker.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users',
        'email' => 'required|string|email|max:255|unique:users',
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'password' => 'required|string|min:8',
        'gender' => 'required|in:L,P', // Sesuaikan dengan nilai yang benar-benar digunakan
        // 'role' => 'required|in:apoteker', // Opsi jika role tidak hardcoded
    ]);

    // Mulai transaksi
    DB::beginTransaction();
    try {
        // Buat user baru
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'apoteker', // Hardcoded role
        ]);

        // Buat pharmacist baru yang berelasi dengan user
        Pharmacist::create([
            'user_id' => $user->id,
            'gender' => $request->gender,
        ]);

        // Commit transaksi jika semua berjalan lancar
        DB::commit();

        return redirect()->route('apotekers.index')->with('success', 'Apoteker berhasil ditambahkan');
    } catch (\Exception $e) {
        // Rollback transaksi jika terjadi error
        DB::rollBack();
        return back()->withErrors(['error' => 'Ada kesalahan saat membuat apoteker']);
    }
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
        $apoteker = Pharmacist::with('user')->findOrFail($id);
        return view('content.admin.apoteker.edit', compact('apoteker'));
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
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'gender' => 'required|string|max:1', // Menggunakan max:1 untuk memastikan panjang karakter
    ]);

    try {
        DB::beginTransaction();

        // Cari user
        $user = User::findOrFail($id);

        // Update Pharmacist
        $pharmacist = Pharmacist::where('user_id', $user->id)->firstOrFail();
        $pharmacist->update([
            'gender' => $request->get('gender'),
        ]);

        // Update User
        $user->update([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'username' => $request->get('username'), // Jangan lupa mengupdate username
            'email' => $request->get('email'), // Jangan lupa mengupdate email
            'address' => $request->get('address'),
            'phone' => $request->get('phone'),
        ]);

        DB::commit();
        return redirect()->route('apotekers.index')->with('success', 'Apoteker berhasil diubah');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Ada kesalahan saat membuat apoteker']);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $pharmacist = Pharmacist::find($id);
        $pharmacist->user->delete();
        $pharmacist->delete();
        return redirect()->route('apotekers.index')->with('success', 'Apoteker berhasil dihapus');
    }


}
