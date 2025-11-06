<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SupplierController extends Controller
{
    public function index()
    {
        $supplier = Supplier::all();
        return view('admin.supplier.index', compact('supplier'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_supplier' => 'required|max:100|unique:suppliers,nama_supplier',
                'kode_supplier' => 'required|unique:suppliers,kode_supplier',
                'telepon' => 'required|string|max:20',
                'email' => 'nullable|email|max:100',
                'alamat' => 'required|string|max:500',
                'kota' => 'required|string|max:100',
                'kode_pos' => 'nullable|string|max:10',
                'nama_kontak' => 'nullable|string|max:100',
                'catatan' => 'nullable|string|max:500',
            ],
            [
                'nama_supplier.required' => 'Nama supplier harap diisi',
                'nama_supplier.unique' => 'Nama supplier sudah ada',
                'kode_supplier.required' => 'Kode supplier wajib diisi',
                'kode_supplier.unique' => 'Kode supplier sudah digunakan',
                'telepon.required' => 'Telepon diisi ya',
                'telepon.max' => 'Telepon maksimal 20 digit',
                'email.email' => 'Format email tidak valid',
                'alamat.required' => 'Alamat diisi ya',
                'kota.required' => 'Kota wajib diisi',
                'kode_pos.max' => 'Kode pos maksimal 10 karakter',
                'nama_kontak.max' => 'Nama kontak maksimal 100 karakter',
            ]
        );

        Supplier::create([
            'nama_supplier' => $request->nama_supplier,
            'kode_supplier' => $request->kode_supplier,
            'telepon' => $request->telepon,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'kode_pos' => $request->kode_pos,
            'nama_kontak' => $request->nama_kontak,
            'catatan' => $request->catatan,
            'is_active' => true,
        ]);

        return redirect()->route('admin.pemasok.index')->with('create', 'Supplier berhasil ditambahkan');
    }

    public function update(Request $request, string $id)
    {
        $supplier = Supplier::findOrFail($id);

        $request->validate(
            [
                'nama_supplier' => 'required|max:100|unique:suppliers,nama_supplier,' . $id,
                'kode_supplier' => 'required|unique:suppliers,kode_supplier,' . $id,
                'telepon' => 'required|string|max:20',
                'email' => 'nullable|email|max:100',
                'alamat' => 'required|string|max:500',
                'kota' => 'required|string|max:100',
                'kode_pos' => 'nullable|string|max:10',
                'nama_kontak' => 'nullable|string|max:100',
                'catatan' => 'nullable|string|max:500',
            ],
            [
                'nama_supplier.required' => 'Nama supplier harap diisi',
                'nama_supplier.unique' => 'Nama supplier sudah ada',
                'kode_supplier.required' => 'Kode supplier wajib diisi',
                'kode_supplier.unique' => 'Kode supplier sudah digunakan',
                'telepon.required' => 'Telepon diisi ya',
                'telepon.max' => 'Telepon maksimal 20 digit',
                'email.email' => 'Format email tidak valid',
                'alamat.required' => 'Alamat diisi ya',
                'kota.required' => 'Kota wajib diisi',
                'kode_pos.max' => 'Kode pos maksimal 10 karakter',
                'nama_kontak.max' => 'Nama kontak maksimal 100 karakter',
            ]
        );

        $supplier->update([
            'nama_supplier' => $request->nama_supplier,
            'kode_supplier' => $request->kode_supplier,
            'telepon' => $request->telepon,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'kode_pos' => $request->kode_pos,
            'nama_kontak' => $request->nama_kontak,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('admin.pemasok.index')->with('edit', 'Supplier berhasil diedit');
    }

    public function destroy(string $id)
    {
        $supplier = Supplier::findOrFail($id);

        // Cek apakah supplier masih digunakan oleh produk
        if ($supplier->produks()->count() > 0) {
            return redirect()->route('admin.pemasok.index')
                ->with('error', 'Tidak bisa menghapus supplier karena masih digunakan oleh produk');
        }

        $supplier->delete();

        return redirect()->route('admin.pemasok.index')->with('delete', 'Supplier berhasil dihapus');
    }

    // Bonus: Method untuk generate kode supplier otomatis
    public function generateKodeSupplier()
    {
        $lastSupplier = Supplier::orderBy('id', 'desc')->first();
        
        if ($lastSupplier) {
            $lastNumber = (int) substr($lastSupplier->kode_supplier, 4);
            $newNumber = $lastNumber + 1;
            $kodeSupplier = 'SUP-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        } else {
            $kodeSupplier = 'SUP-001';
        }

        return response()->json(['kode_supplier' => $kodeSupplier]);
    }
}