<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permission list
        // Permission::create(['name' => 'products.products']);
        Permission::create(['name' => 'roles.roles']);

        //Admin
        $admin = Role::create(['name' => 'Admin']);

        // $admin->givePermissionTo([
        //     'products.index',
        //     'products.edit',
        //     'products.show',
        //     'products.create',
        //     'products.destroy'
        // ]);
        //$admin->givePermissionTo('products.index');
        $admin->givePermissionTo(Permission::all());
       
        //Guest
        $guest = Role::create(['name' => 'Guest']);

        // $guest->givePermissionTo([
        //     'products.products'
        // ]);

        //User Admin
        $user = User::find(1); //Admin
        $user->assignRole('Admin');

        //All user
        $users = factory(User::class, 10)->create();
            foreach($users as $user){
                $user->assignRole('Guest');
        }
    }
}
