<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);


        $credentials['role'] = 'user';


        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();


            Activity::create([
                'user_id' => Auth::id(),
                'activity' => 'login',
                'deskripsi' => 'User ' . Auth::user()->name . ' berhasil login',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ]);
            return redirect()->route('dashboard')->with('toast_success', 'Selamat Datang! ' . Auth::user()->name);
        }

        return back()->with('toast_error', 'Email atau password salah!')->withInput();
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => 'user',
            'password' => bcrypt($request->password),
        ]);

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

        $user = User::where('email', $googleUser->email)->first();

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

    public function profileUpdate(Request $request)
    {
        $user = Auth::user();


        $request->validate([
            'name'     => 'required|min:3',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'alamat'   => 'nullable|min:5',
            'no_telp'  => 'nullable|numeric',
            'password' => 'nullable|min:6',
        ]);


        $user->name    = $request->name;
        $user->email   = $request->email;
        $user->alamat  = $request->alamat;
        $user->no_telp = $request->no_telp;


        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function showLinkRequestForm()
    {
        return view('Auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('toast_success', 'Link reset password telah dikirim ke email Anda!')
            : back()->with('toast_error', 'Email tidak ditemukan!');
    }

    public function showResetForm($token)
    {
        return view('Auth.reset-password', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->password = Hash::make($request->password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('toast_success', 'Password berhasil direset!')
            : back()->with('toast_error', 'Token tidak valid atau email salah!');
    }
}
