<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function index()
    {
        $member = User::with('member')
            ->where('role', 'member')
            ->whereHas('member')
            ->get();
        return view('admin.member.index', compact('member'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
                'username' => 'required|string|max:100|unique:members,username',
                'telepon' => 'required|numeric|digits_between:10,15',
                'role' => 'required|in:member,kasir,admin',
            ]);

            $user = new User();
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->password = bcrypt($validated['password']);
            $user->role = $validated['role'];
            $user->save();

            $member = new Member();
            $member->user_id = $user->id;
            $member->nama = $validated['name'];
            $member->username = $validated['username'];
            $member->telepon = $validated['telepon'];
            $member->alamat = null;
            $member->poin = 0;
            $member->save();

            return redirect()->route('admin.member.index')->with('success', 'Member berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::where('role', 'member')->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|string|max:100|unique:members,username,' . $user->member->id,
            'telepon' => 'required|numeric|digits_between:10,15',
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:member,kasir,admin',
        ]);

        try {
            DB::transaction(function () use ($user, $validated) {
                $updateData = [
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'role' => $validated['role'],
                ];

                if (!empty($validated['password'])) {
                    $updateData['password'] = bcrypt($validated['password']);
                }

                $user->update($updateData);

                $user->member->update([
                    'nama' => $validated['name'], // ✅ TAMBAH INI
                    'username' => $validated['username'],
                    'telepon' => $validated['telepon'],
                ]);
            });

            return redirect()->route('admin.member.index')->with('success', 'Data member berhasil diperbarui');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal update member: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::where('role', 'member')->findOrFail($id);

            DB::transaction(function () use ($user) {
                $user->member()->delete();
                $user->delete();
            });

            return redirect()->route('admin.member.index')->with('success', 'Member berhasil dihapus');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus member: ' . $e->getMessage());
        }
    }
}