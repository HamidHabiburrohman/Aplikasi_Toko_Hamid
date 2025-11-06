<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Kasir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class KasirController extends Controller
{
    public function index()
    {
        $kasir = User::with('kasir')->where('role', 'kasir')->get();
        return view('admin.kasir.index', compact('kasir'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'username' => 'required|string|max:100|unique:kasirs,username', // pastikan tabelnya kasirs (plural)
            'telepon'  => 'required|numeric|digits_between:10,15',
        ]);

        try {
            DB::transaction(function () use ($validated) {
                $user = User::create([
                    'name'     => $validated['name'],
                    'email'    => $validated['email'],
                    'password' => bcrypt($validated['password']),
                    'role'     => 'kasir',
                ]);

                $user->kasir()->create([
                    'username' => $validated['username'],
                    'telepon'  => $validated['telepon'],
                ]);
            });

            return redirect()->route('admin.kasir.index')->with('success', 'Kasir berhasil ditambahkan');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambah kasir: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::where('role', 'kasir')->findOrFail($id);

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|string|max:100|unique:kasirs,username,' . $user->kasir->id,
            'telepon'  => 'required|numeric|digits_between:10,15',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        try {
            DB::transaction(function () use ($user, $validated) {
                $updateData = [
                    'name'  => $validated['name'],
                    'email' => $validated['email'],
                ];

                if (!empty($validated['password'])) {
                    $updateData['password'] = bcrypt($validated['password']);
                }

                $user->update($updateData);

                $user->kasir->update([
                    'username' => $validated['username'],
                    'telepon'  => $validated['telepon'],
                ]);
            });

            return redirect()->route('admin.kasir.index')->with('success', 'Data kasir berhasil diperbarui');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal update kasir: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::where('role', 'kasir')->findOrFail($id);
            
            DB::transaction(function () use ($user) {
                $user->kasir()->delete();
                $user->delete();
            });

            return redirect()->route('admin.kasir.index')->with('success', 'Kasir berhasil dihapus');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus kasir: ' . $e->getMessage());
        }
    }
}