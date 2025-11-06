<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Diskon;
use Illuminate\Http\Request;

class DiskonController extends Controller
{
     public function index()
    {
        return Diskon::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_diskon' => 'required|string|max:20|unique:diskons',
            'jenis_diskon' => 'required|string|max:10',
            'nilai' => 'required|numeric',
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        return Diskon::create($validated);
    }

    public function show(Diskon $diskon)
    {
        return $diskon;
    }

    public function update(Request $request, Diskon $diskon)
    {
        $validated = $request->validate([
            'kode_diskon' => 'sometimes|required|string|max:20|unique:diskons,kode_diskon,'.$diskon->id,
            'jenis_diskon' => 'sometimes|required|string|max:10',
            'nilai' => 'sometimes|required|numeric',
            'tanggal_mulai' => 'sometimes|required|date',
            'tanggal_akhir' => 'sometimes|required|date|after_or_equal:tanggal_mulai',
        ]);

        $diskon->update($validated);
        return $diskon;
    }

    public function destroy(Diskon $diskon)
    {
        $diskon->delete();
        return response()->noContent();
    }
}
