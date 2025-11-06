<?php
namespace App\Http\Controllers\admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        return Admin::with('user')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:admins',
            'telepon' => 'required|string|max:15',
            'user_id' => 'required|exists:users,id'
        ]);

        return Admin::create($validated);
    }

    public function show(Admin $admin)
    {
        return $admin->load('user');
    }

    public function update(Request $request, Admin $admin)
    {
        $validated = $request->validate([
            'nama' => 'sometimes|required|string|max:100',
            'email' => 'sometimes|required|email|max:100|unique:admins,email,'.$admin->id,
            'telepon' => 'sometimes|required|string|max:15',
            'user_id' => 'sometimes|required|exists:users,id'
        ]);

        $admin->update($validated);
        return $admin->load('user');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return response()->noContent();
    }
}