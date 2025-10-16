<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SignupController extends Controller
{
    /**
     * Tampilkan halaman signup
     */
    public function index()
    {
        return view('signup');
    }

    /**
     * Proses simpan user baru
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed', 
            // "confirmed" butuh input password_confirmation di form
        ]);

        // Simpan user baru
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password), // password harus di-hash
        ]);

        // Auto login setelah signup
        Auth::login($user);

        // Redirect ke dashboard
        return redirect()->route('signin')
        ->with('successL', 'Account created & logged in successfully!');
    }
}
