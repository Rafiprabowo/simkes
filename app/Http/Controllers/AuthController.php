<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function login()
    {
        return view('auth.login');
    }
    public function register()
    {
        return view('auth.register');
    }
    public function attemptLogin(Request $request){
    // Validasi input
    $validated = $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string|min:8'
    ]);

    // Coba login dengan kredensial yang diberikan
    if (Auth::attempt($validated)) {
        // Regenerasi session untuk keamanan
        $request->session()->regenerate();

        // Redirect berdasarkan peran pengguna
        $roleRoutes = [
            'admin' => '/admin/',
            'dokter' => '/dokter/',
            'pegawai' => '/pegawai/',
            'apoteker' => '/apoteker/'
        ];
        $role = Auth::user()->role;
        return isset($roleRoutes[$role])
            ? redirect($roleRoutes[$role])
            : redirect('/home');
    }

    // Gagal login
    return redirect()->route('login')->with('error', 'Email atau password salah');
}


    public function attemptRegister(Request $request){
         $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8',
        ]);
          if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
           $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'password' => Hash::make($request->input('password')),
            'role' => 'pegawai', // Default role
        ]);

         Employee::create([
            'user_id' => $user->id,
        ]);

          return redirect()->route('login')->with('success', 'Akun anda berhasil dibuat');

    }
    public function logout(Request $request) :RedirectResponse{
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
