<?php

namespace App\Http\Controllers;

use App\Models\Userrest;
use Illuminate\Http\Request;


class AdminUserController extends Controller
{
    public function index()
    {
        // Ambil semua user kecuali admin saat ini
        $user = Userrest::where('role', '!=', 'admin')->get();

        return view('/admin/user', compact('user'));
    }

    public function edit($id)
    {
        // Ambil data user berdasarkan ID
        $user = Userrest::findOrFail($id);

        return view('/admin/user_edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:userrest,email,' . $id,
        ]);

        // Update data user
        $user = Userrest::findOrFail($id);
        $user->update($request->only(['name', 'email']));

        return redirect()->route('admin.user')->with('success', 'User updated successfully.');
    }
}
