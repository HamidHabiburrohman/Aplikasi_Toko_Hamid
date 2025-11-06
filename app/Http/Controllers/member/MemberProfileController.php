<?php
namespace App\Http\Controllers\member;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberProfileController extends Controller
{
    // Menampilkan profil member
    public function index()
    {
        $member = auth()->user()->member;
        return view('member.profile.index', compact('member'));
    }

    // Update profil member
    public function update(Request $request)
    {
        $member = auth()->user()->member;
        
        $validated = $request->validate([
            'nama' => 'sometimes|required|string|max:100',
            'telepon' => 'sometimes|required|string|max:15',
        ]);

        $member->update($validated);
        return redirect()->route('member.profile')->with('success', 'Profil berhasil diperbarui');
    }
}