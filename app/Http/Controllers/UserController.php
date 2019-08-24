<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Activitylog\Models\Activity;
use App\User;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::all();
        $permissions = Permission::all();

        $busqueda  = $request->get('busqueda');

        $users = User::orderBy('id', 'ASC')->busqueda($busqueda)->paginate(5);

        $total_roles = Role::all()->count();
        $total_permissions = Permission::all()->count();

        return view('roles.users',compact('roles', 'total_roles', 'permissions', 'total_permissions', 'users', 'busqueda'));
    }

    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function import() 
    {
        Excel::import(new UsersImport, request()->file('file'));
        
        return back()->with('info', 'Importado con éxito!');
    }
}