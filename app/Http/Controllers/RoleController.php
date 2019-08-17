<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $users = User::orderBy('id', 'ASC')->paginate(5);

        $total_roles = Role::all()->count();
        $total_permissions = Permission::all()->count();

        return view('roles.index',compact('roles', 'total_roles', 'permissions', 'total_permissions', 'users'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ],
            [ 
                'name.required' => 'Has olvidado asignar un nombre al Rol',
                'permission.required' => 'Debes elegir al menos un permiso'
            ]);
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return back()->with('success','Role created successfully');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'permission' => 'required',
       ],
            [ 
                'permission.required' => 'Debes elegir al menos un permiso'
            ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));

        return back()->with('info','Role updated successfully');
    }

    public function destroy($id)
    {
        $role = Role::find($id)->delete();
        return back()->with('info', 'Rol eliminado correctamente');
    }

    public function storepermission(Request $request)
    {
    	$this->validate($request, [
        'name' => 'required|unique:permissions,name',
        ],
            [ 
                'name.required' => 'Has olvidado asignar un nombre al permiso',
                'name.unique' => 'Este permiso ya ha sido registrado'
            ]);

    	$permission = new Permission;
        $permission->name = $request->get('name');
        $permission->guard_name = 'web';
        $permission->save();
    	// $permission = Permission::create($request->all());
    	return back()->with('info', 'Permiso creado con exito');
    }

    public function updatepermission(Request $request, $id)
    {
    	$this->validate($request, [
        'name' => 'required|unique:permissions,name',
        ],
            [ 
                'name.required' => 'Has olvidado asignar un nombre al permiso',
                'name.unique' => 'Este permiso ya ha sido registrado'
            ]);

    	$permission = Permission::find($id);
        $permission->update($request->all());
        return back()->with('info', 'Permiso actualizado con exito');
    }

    public function destroypermission($id)
    {
        $permission = Permission::find($id)->delete();
        return back()->with('info', 'Permiso eliminado correctamente');
    }

    public function assignrole(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        $user->roles()->sync($request->get('roles'));
        return back()->with('info', 'Rol actualizado con éxito');
    }
}
