<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereIn('role', ['petugas', 'user'])->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'nisn'     => 'required|string|max:20|unique:users',
            'kelas'    => 'required|string|max:50',
            'jurusan'  => 'required|string|max:100',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role'     => 'required|in:petugas,user',
        ]);

        User::create([
            'name'     => $request->name,
            'nisn'     => $request->nisn,
            'kelas'    => $request->kelas,
            'jurusan'  => $request->jurusan,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('admin.users.index')
                         ->with('success', 'Akun berhasil dibuat!');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'nisn'    => 'required|string|max:20|unique:users,nisn,'.$user->id,
            'kelas'   => 'required|string|max:50',
            'jurusan' => 'required|string|max:100',
            'email'   => 'required|email|unique:users,email,'.$user->id,
            'role'    => 'required|in:petugas,user',
        ]);

        $data = $request->only(['name','nisn','kelas','jurusan','email','role']);
        if ($request->filled('password')) {
            $request->validate(['password' => 'min:6|confirmed']);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
                         ->with('success', 'Akun berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')
                         ->with('success', 'Akun berhasil dihapus!');
    }
}