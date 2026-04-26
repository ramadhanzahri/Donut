<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::orderBy('name')->get();
        return view('dashboard.admins', compact('admins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:tbl_admin,username',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:admin,superadmin',
            'status'   => 'required|in:aktif,nonaktif',
        ], [
            'username.unique' => 'Username sudah digunakan.',
        ]);

        User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
            'status'   => $request->status,
        ]);

        return redirect()->route('admins.index')
                         ->with('success', 'Admin ' . $request->name . ' berhasil ditambahkan.');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:tbl_admin,username,' . $user->id,
            'password' => 'nullable|string|min:6',
            'role'     => 'required|in:admin,superadmin',
            'status'   => 'required|in:aktif,nonaktif',
        ], [
            'username.unique' => 'Username sudah digunakan.',
        ]);

        $data = [
            'name'     => $request->name,
            'username' => $request->username,
            'role'     => $request->role,
            'status'   => $request->status,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admins.index')
                         ->with('success', 'Admin ' . $request->name . ' berhasil diupdate.');
    }

    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $nama = $user->name;
        $user->delete();

        return redirect()->route('admins.index')
                         ->with('success', 'Admin ' . $nama . ' berhasil dihapus.');
    }

    // Toggle status aktif/nonaktif via AJAX atau redirect
    public function toggleStatus(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Tidak dapat mengubah status akun sendiri.');
        }

        $user->update([
            'status' => $user->status === 'aktif' ? 'nonaktif' : 'aktif'
        ]);

        $label = $user->status === 'aktif' ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', 'Admin ' . $user->name . ' berhasil ' . $label . '.');
    }
}
