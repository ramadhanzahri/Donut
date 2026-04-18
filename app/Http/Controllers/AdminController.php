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
        $admins = User::latest()->get();
        return view('dashboard.admins', compact('admins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:tbl_admin,username',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:admin,superadmin',
        ], [
            'name.required'     => 'Nama wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique'   => 'Username sudah dipakai.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 6 karakter.',
            'role.required'     => 'Role wajib dipilih.',
        ]);

        User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('admins.index')
            ->with('success', "Admin \"{$request->name}\" berhasil ditambahkan.");
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:tbl_admin,username,' . $user->id,
            'role'     => 'required|in:admin,superadmin',
            'password' => 'nullable|string|min:6',
        ], [
            'name.required'     => 'Nama wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique'   => 'Username sudah dipakai.',
            'role.required'     => 'Role wajib dipilih.',
            'password.min'      => 'Password minimal 6 karakter.',
        ]);

        $data = [
            'name'     => $request->name,
            'username' => $request->username,
            'role'     => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admins.index')
            ->with('success', "Admin \"{$user->name}\" berhasil diupdate.");
    }

    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()->route('admins.index')
                ->with('error', 'Tidak bisa menghapus akun yang sedang login.');
        }

        $name = $user->name;
        $user->delete();

        return redirect()->route('admins.index')
            ->with('success', "Admin \"{$name}\" berhasil dihapus.");
    }
}
