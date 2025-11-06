<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class SigninController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function showsignin()
    {
        if (Auth::check()) {
            return redirect()->route('member.beranda');
        }
        return view('Signin');
    }

    public function actionsignin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $role = Auth::user()->role;

             session()->flash('success', 'Berhasil signin, selamat datang ' . Auth::user()->name . '!');

            if ($role === 'admin') {
                return redirect()->route('admin.beranda');
            } elseif ($role === 'kasir') {
                return redirect()->route('kasir.beranda');
            } else {
                return redirect()->route('member.beranda');
            }
        }
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }


    public function actionlogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('signin')->with(['succes' => 'Anda berhasil log out']);
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
