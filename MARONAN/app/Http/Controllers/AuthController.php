<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister()
{
    return view('auth.register');
}

public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'phone' => 'required',
        'password' => 'required|min:6|confirmed',
        'address' => 'required',
        'village' => 'required',
        'farmer_id_number' => 'required',
        'farm_address' => 'required',
        'land_area' => 'required',
        'main_commodity' => 'required',
        'commitment_statement' => 'required',
        'supporting_document' => 'required|file|mimes:jpg,jpeg,png,pdf'
    ]);

    // Upload dokumen
    $documentPath = $request->file('supporting_document')->store('documents', 'public');

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => Hash::make($request->password),
        'role' => 'petani',
        'address' => $request->address,
        'village' => $request->village,
        'farmer_id_number' => $request->farmer_id_number,
        'farm_address' => $request->farm_address,
        'land_area' => $request->land_area,
        'main_commodity' => $request->main_commodity,
        'commitment_statement' => $request->commitment_statement,
        'supporting_document' => $documentPath,
        'verification_status' => 'pending',
        'rejection_count' => 0,
    ]);

    return redirect('/login')->with('success', 'Registrasi berhasil. Menunggu verifikasi admin.');
}

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::user();

            // Cek role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($user->role === 'petani') {

                // Cek verifikasi
                if ($user->verification_status !== 'approved') {
                    Auth::logout();
                    return back()->with('error', 'Akun belum diverifikasi admin.');
                }

                return redirect()->route('petani.dashboard');
            }
        }

        return back()->with('error', 'Email atau password salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}