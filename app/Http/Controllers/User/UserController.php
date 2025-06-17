<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\User\NewUserNotification;
use App\Http\Requests\User\StoreUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->get();
        $users->each(function ($user) {
            $user->role = $user->roles->pluck('name')->implode(', ');
            $user->role_label = collect($user->roles->pluck('name'))->map(function($role) {
                return config('constants.ROLES_LABEL')[strtoupper($role)] ?? $role;
            })->implode(', ');
        });
        return view('pages.User.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $roles = Role::all()->map(function ($role) {
            $role->role_label = config('constants.ROLES_LABEL')[strtoupper($role->name)] ?? $role->name;
            return $role;
        });

        return view('pages.User.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $plain_random_password = Str::random(8);
            $hashed_random_password = Hash::make($plain_random_password);
            $data = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $hashed_random_password,
            ];

            $user_role = $request->input('role');
            $user = User::create($data);
            $user->assignRole($user_role);

            Mail::to($request->input('email'))->send(new NewUserNotification($user, $plain_random_password));

            return redirect()->route('users.index')->with('success', 'User created successfully.');
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('roles')->findOrFail($id);
        $user->role = $user->roles->pluck('name')->implode(', ');
        $user->role_label = collect($user->roles->pluck('name'))->map(function($role) {
            return config('constants.ROLES_LABEL')[strtoupper($role)] ?? $role;
        })->implode(', ');
        $user->permissions = $user->getPermissionsViaRoles()->pluck('name');
        return view('pages.User.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $worker_relationship = User::with('codeDirectory')->findOrFail($id);
        $worker_relationship->table_name_label = $this->table_name;
        return view('pages.User.edit', [
            'worker_relationship' => $worker_relationship,
            'table_name' => $this->table_name
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        try {
            $worker_relationship = User::findOrFail($id);

            $data = [
                'code' => $request->input('code'),
                'name' => $request->input('name'),
                'table_name' => $request->input('table_name'),
            ];

            $code_directory = $worker_relationship->codeDirectory;
            $code_directory->update($data);

            $worker_relationship->update([
                'name' => $data['name'],
            ]);

            return redirect()->route('worker-relationship.index')->with('success', 'Worker Relationship updated successfully.');
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $worker_relationship = User::findOrFail($id);
            $worker_relationship->codeDirectory()->delete();
            $worker_relationship->delete();
            return redirect()->route('worker-relationship.index')->with('success', 'Worker Relationship deleted successfully.');
        } catch (\Throwable $th) {
            return view('errors.error', ['message' => $th->getMessage()]);
        }
    }
}
