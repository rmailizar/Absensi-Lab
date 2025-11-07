<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Filter berdasarkan role (jika dikirim dari AJAX)
        if ($request->has('role') && $request->role !== 'Semua Role') {
            $query->where('role', strtolower($request->role));
        }

        // Pencarian (jika dikirim dari AJAX)
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Pagination (10 per halaman)
        $users = $query->orderBy('name')->paginate(5);

        // Jika request dari AJAX, kirim hanya table (agar tidak reload total)
        if ($request->ajax()) {
            return view('users.partials.table', compact('users'))->render();
        }

        return view('users.index', compact('users'));
    }

    public function home()
    {
        return view('users.home');
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // ✅ Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,asisten lab',
        ], [
            'email.unique' => 'Email sudah digunakan.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            'password.min' => 'Password harus memiliki minimal 8 karakter.',
            'role.in' => 'Role harus admin atau asisten lab.',
        ]);

        // ✅ Simpan user baru
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['message' => 'User berhasil ditambahkan.'], 200);
        }

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$user->id}",
            'password' => 'nullable|min:8',
            'role' => 'required|in:admin,asisten lab',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json(['message' => 'User berhasil diperbarui.']);
    }

    public function destroy(User $user, Request $request)
    {
        if (auth()->id() === $user->id) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json(['message' => 'Anda tidak dapat menghapus akun Anda sendiri.'], 400);
            }
            return redirect()->route('users.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['message' => 'User berhasil dihapus.']);
        }

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
