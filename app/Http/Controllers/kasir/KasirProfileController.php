<?php
namespace App\Http\Controllers\kasir;

use App\Models\Kasir;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KasirProfileController extends Controller
    {
    // Menampilkan profil kasir
    public function index()
    {
        $kasir = auth()->user()->kasir;
        return view('kasir.profile', compact('kasir'));
    }

    // Update profil kasir
    public function update(Request $request)
    {
        $kasir = auth()->user()->kasir;
        
        $validated = $request->validate([
            'nama' => 'sometimes|required|string|max:100',
            'telepon' => 'sometimes|required|string|max:15',
        ]);

        $kasir->update($validated);
        return redirect()->route('kasir.profile')->with('success', 'Profil berhasil diperbarui');
    }
}