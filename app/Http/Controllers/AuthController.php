<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showregister(){
        return view('auth.register');
    }
    
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|min:1',
            'email' => 'required|max:255|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ], [
            'name.required' => 'Username wajib diisi!',
            'name.max' => 'Username max 255 karakter!',
            'name.min' => 'Username min 1 karakter!',
            'email.required' => 'Email wajib diisi!',
            'email.max' => 'Email max 255 karakter!',
            'email.email' => 'Email tidak valid! (harus ada simbol @)',
            'email.unique' => 'Email sudah terdaftar!',
            'password.required' => 'Password wajib diisi!',
            'password.confirmed' => 'Konfirmasi password tidak cocok!',
            'password.min' => 'Password minimal 8 karakter!',
        ]);

        $usercount = Users::count();
        $user = new Users;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = $usercount === 0 ? "admin" : "user";
        $user->save();
        
        return redirect()->route('login')->with('success', 'Registrasi telah berhasil! Silakan login.');
    }

    public function showlogin(){
        // Redirect jika sudah login
        if (Auth::check()) {
            return redirect()->route('dashboard.home.index');
        }
        
        return view('auth.login');
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Password minimal 8 karakter!',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            // Redirect ke dashboard home dengan fallback
            try {
                return redirect()->intended(route('dashboard.home.index'))
                    ->with('success', 'Selamat datang, ' . Auth::user()->name . '!');
            } catch (\Exception $e) {
                // Fallback jika route tidak ditemukan
                return redirect('/dashboard/home')
                    ->with('success', 'Selamat datang, ' . Auth::user()->name . '!');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }
}
