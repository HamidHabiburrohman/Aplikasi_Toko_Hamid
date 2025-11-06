<?php

namespace App\Http\Controllers\kasir;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{

    public function index()
    {
        $kategori = Kategori::all();
        return view('kasir.kategori.index', compact('kategori'));
    }


    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_kategori' => 'required|max:100'
            ],
            [
                'nama_kategori.required' => 'Nama kategori harus diisi ya'
            ]
        );

        Kategori::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('kategori.index')->with('create','Kategori berhasil ditambah');
    }


    public function update(Request $request, string $id)
    {
        $kategori = Kategori::findOrFail($id);

        $request->validate(
            [
                'nama_kategori' => 'required|max:100'
            ],
            [
                'nama_kategori.required' => 'Nama kategori harus diisi ya'
            ]
        );

        $kategori->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('kategori.index')->with('edit','Kategori berhasil diedit');
    }


    public function destroy(string $id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('delete','Kategori berhasil dihapus');
    }
}
