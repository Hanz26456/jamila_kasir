<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $users = User::paginate(10);
        return view('admin.pages.users.index', compact('users'));
    }

    public function create() {
        return view('admin.pages.users.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,kasir',
        ]);

        $validated['password'] = Hash::make($request->password);
        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function edit(User $user) {
        return view('admin.pages.users.edit', compact('user'));
    }

    public function update(Request $request, User $user) {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,kasir',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'min:8';
        }

        $validated = $request->validate($rules);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);
        return redirect()->route('admin.users.index')->with('success', 'Data pengguna diperbarui!');
    }

    public function destroy(User $user) {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri!');
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Pengguna dihapus!');
    }
}