<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\MetodePembayaran;
use Illuminate\Http\Request;

class MetodePembayaranController extends Controller
{
    public function index()
    {
        return MetodePembayaran::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_metode' => 'required|string|max:50|unique:metode_pembayarans',
        ]);

        return MetodePembayaran::create($validated);
    }

    public function show(MetodePembayaran $metodePembayaran)
    {
        return $metodePembayaran;
    }

    public function update(Request $request, MetodePembayaran $metodePembayaran)
    {
        $validated = $request->validate([
            'nama_metode' => 'sometimes|required|string|max:50|unique:metode_pembayarans,nama_metode,' . $metodePembayaran->id,
        ]);

        $metodePembayaran->update($validated);
        return $metodePembayaran;
    }

    public function destroy(MetodePembayaran $metodePembayaran)
    {
        $metodePembayaran->delete();
        return response()->noContent();
    }
}
