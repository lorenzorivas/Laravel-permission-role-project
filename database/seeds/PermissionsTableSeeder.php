<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use App\Task;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $task = Task::create([
        //     'user_id' => '1',
        //     'title' => 'Tarea de prueba',
        //     'is_complete' => true,
        // ]);
        //Permission list
        // Permission::create(['name' => 'products.products']);
        Permission::create(['name' => 'roles.roles']);
        Permission::create(['name' => 'task.task']);
        Permission::create(['name' => 'books.books']);
        Permission::create(['name' => 'gallery.gallery']);

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

        $guest->givePermissionTo([
            'task.task'
        ]);

        //User Admin
        $user = User::find(1); //Admin
        $user->assignRole('Admin');

        //All user
        $users = factory(User::class, 9)->create();
            foreach($users as $user){
                $user->assignRole('Guest');
        }
    }
}
