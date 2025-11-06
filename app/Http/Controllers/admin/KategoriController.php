<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('admin.kategori.index', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_kategori' => 'required|max:100|unique:kategoris,nama_kategori',
                'deskripsi' => 'nullable|string|max:500',
            ],
            [
                'nama_kategori.required' => 'Nama kategori harus diisi ya',
                'nama_kategori.unique' => 'Nama kategori sudah ada',
            ]
        );

        // Generate slug otomatis dari nama_kategori
        $slug = Str::slug($request->nama_kategori);
        
        // Cek jika slug sudah ada, tambahkan angka
        $originalSlug = $slug;
        $count = 1;
        while (Kategori::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'slug' => $slug,
            'deskripsi' => $request->deskripsi,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('admin.kategori.index')->with('create','Kategori berhasil ditambah');
    }

    public function update(Request $request, string $id)
    {
        $kategori = Kategori::findOrFail($id);

        $request->validate(
            [
                'nama_kategori' => 'required|max:100|unique:kategoris,nama_kategori,' . $id,
                'slug' => 'required|unique:kategoris,slug,' . $id,
                'deskripsi' => 'nullable|string|max:500',
            ],
            [
                'nama_kategori.required' => 'Nama kategori harus diisi ya',
                'nama_kategori.unique' => 'Nama kategori sudah ada',
                'slug.required' => 'Slug harus diisi',
                'slug.unique' => 'Slug sudah ada',
            ]
        );

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'slug' => $request->slug,
            'deskripsi' => $request->deskripsi,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('admin.kategori.index')->with('edit','Kategori berhasil diedit');
    }

    public function destroy(Kategori $kategori)
    {
        // Cek apakah kategori digunakan oleh produk
        if ($kategori->produks()->count() > 0) {
            return redirect()->route('admin.kategori.index')
                ->with('error', 'Tidak bisa menghapus kategori karena masih digunakan oleh produk');
        }

        $kategori->delete();

        return redirect()->route('admin.kategori.index')->with('delete','Kategori berhasil dihapus');
    }
}