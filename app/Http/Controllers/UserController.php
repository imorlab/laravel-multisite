<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'superadmin']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $users = User::with('site')->paginate(10);
        return view('superadmin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $sites = Site::all();
        return view('superadmin.users.create', compact('sites'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Password::defaults()],
            'site_id' => ['nullable', 'exists:sites,id'],
            'is_superadmin' => ['boolean'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'site_id' => $validated['site_id'],
            'is_superadmin' => $validated['is_superadmin'] ?? false,
        ]);

        return redirect()->route('superadmin.users.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        $sites = Site::all();
        return view('superadmin.users.edit', compact('user', 'sites'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', Password::defaults()],
            'site_id' => ['nullable', 'exists:sites,id'],
            'is_superadmin' => ['boolean'],
        ]);

        $userData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'site_id' => $validated['site_id'],
            'is_superadmin' => $validated['is_superadmin'] ?? false,
        ];

        if (!empty($validated['password'])) {
            $userData['password'] = Hash::make($validated['password']);
        }

        $user->update($userData);

        return redirect()->route('superadmin.users.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'No puedes eliminar tu propio usuario.');
        }

        $user->delete();

        return redirect()->route('superadmin.users.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}
