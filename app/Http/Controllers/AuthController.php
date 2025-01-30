<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credential = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'Harap mengisi kolom email',
                'email.email' => 'Harap mengisi kolom email dengan email yang valid',
                'password.required' => 'Harap mengisi kolom password',
            ],
        );

        if (Auth::attempt($credential)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }
        return back()->with('error', 'Email atau password salah');
    }

    public function change_password_view()
    {
        $title = 'User';
        $subtitle = [
            'subtitle' => 'Ubah Password',
            'route' => 'dashboard',
        ];
        return view('auth.change_password', compact('title', 'subtitle'));
    }

    public function change_password(Request $request)
    {
        $validatedData = $request->validate(
            [
                'old_password' => 'required',
                'password' => 'required|confirmed',
            ],
            [
                'old_password.required' => 'Harap mengisi kolom password lama',
                'password.required' => 'Harap mengisi kolom password baru',
                'password.confirmed' => 'Password baru tidak cocok dengan konfirmasi',
            ],
        );

        $user = Auth::user();

        // Verifikasi password lama
        if (!Hash::check($validatedData['old_password'], $user->password)) {
            return back()
                ->withErrors(['old_password' => 'Password lama tidak cocok'])
                ->withInput();
        }

        try {
            $user->update([
                'password' => Hash::make($validatedData['password']),
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal mengupdate password: ' . $e->getMessage());
            return back()->with('error', 'Gagal mengubah password. Silakan coba lagi.');
        }

        // Logout setelah perubahan password (opsional)
        Auth::logout();

        return redirect()->route('login')->with('success', 'Password berhasil diubah. Silakan login kembali.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil logout');
    }
}
