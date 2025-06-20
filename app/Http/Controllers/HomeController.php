<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all_permissions = Permission::pluck('name')->toArray();
        $auth_user_roles = Auth::user()->roles->pluck('name')->toArray();

        $auth_user_permissions = [];
        foreach ($auth_user_roles as $role) {
            $auth_user_permissions = array_merge($auth_user_permissions, Role::where('name', $role)->first()->permissions->pluck('name')->toArray());
        }
        dd($auth_user_permissions);

        $registered_beedi_worker = 999999;
        $registered_cine_worker = 999999;
        $registered_non_coal_mine_worker = 999999;
        $under_process_beedi_worker = 111111;
        $under_process_cine_worker = 111111;
        $under_process_non_coal_mine_worker = 111111;

        return view('dashboard', compact('registered_beedi_worker', 'registered_cine_worker', 'registered_non_coal_mine_worker', 'under_process_beedi_worker', 'under_process_cine_worker', 'under_process_non_coal_mine_worker', 'all_permissions', 'auth_user_permissions'));
    }
}
