<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('Auth.login');
    }

    public function profile()
    {
        return view('Auth.profile');
    }

    public function login(Request $request)
    {
        // Validasi request
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Tambahkan filter role user
        $credentials['role'] = 'user';

        // Attempt login
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate(); // Proteksi session hijacking
            return redirect()->route('dashboard')->with('toast_success', 'Selamat Datang! ' . Auth::user()->name);
        }

        // Jika gagal
        return back()->with('toast_error', 'Email atau password salah!')->withInput();
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => 'user',
            'password' => bcrypt($request->password),
        ]);

        // Auth::login($user);
        return redirect()->route('login')->with('toast_success', 'Berhasil Daftar!');
    }




    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('toast_success', 'Berhasil logout!');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Cek user sudah ada?
        $user = User::where('email', $googleUser->email)->first();

        // Jika belum, buat user baru otomatis
        if (!$user) {
            $user = User::create([
                'name'  => $googleUser->name,
                'email' => $googleUser->email,
                'role'  => 'user',
                'password' => bcrypt(str()->random(16)),
            ]);
        }

        Auth::login($user);

        return redirect('/');
    }

    public function validateRegis(Request $request)
    {
        $messages = [
            'name.required' => 'Nama tidak boleh kosong.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password tidak boleh kosong.',
            'password.min' => 'Password minimal 6 karakter.',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        return response()->json(['success' => true]);
    }

    public function validateLogin(Request $request)
    {
        $messages = [
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password tidak boleh kosong.',
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        return response()->json(['success' => true]);
    }
}
