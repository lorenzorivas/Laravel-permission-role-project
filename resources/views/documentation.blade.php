@extends('layouts.app')

@section('content')
<div class="container">
<main role="main" class="container">
  <div class="row">
    <div class="blog-main">
      <h1 class="pb-4 mb-4 border-bottom">
        Documentación
      </h1>

      <div class="blog-post">

        <p>Este proyecto cuenta con los siguientes componentes:</p>
        <ul>
          <li><a href="https://github.com/spatie/laravel-permission" style="text-decoration: none;" target="_blank">spatie/laravel-permission</a></li>
          <li><a href="https://github.com/spatie/laravel-activitylog" style="text-decoration: none;" target="_blank">spatie/laravel-activitylog</a></li>
          <li><a href="https://github.com/twbs/bootstrap" style="text-decoration: none;" target="_blank">Bootstrap 4.3.1</a></li>
          <li><a href="https://laravelcollective.com/" style="text-decoration: none;" target="_blank">LaravelCollective</a></li>
          <li><a href="https://docs.laravel-excel.com/3.1/getting-started/" style="text-decoration: none;" target="_blank">Maatwebsite/excel</a></li>
        </ul>
        
        <h2>#Inicio</h2>
        <p>Clonar repositorio desde github:</p>
        <p><kbd>λ git clone https://github.com/lorenzorivas/Laravel-permission-role-project.git</kbd></p>
        <p>Inportamos e instalamos todos los paquetes de proveedor necesarios con el script de carga automática:</p>
        <p><kbd>λ composer install</kbd></p>
        <p>Copiamos el contenido del archivo .env.example en .env y definimos las propiedades de la BBDD en el archivo .env:</p>
        <pre><code>
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=app
DB_USERNAME=root
DB_PASSWORD=root
        </code></pre>
        <p>Creamos la llave encriptada:</p>
        <pre><code>
public function run()
{
    App\User::create([
        'name'      => 'Admin',
        'email'     => 'admin@admin.com',
        'password'     => bcrypt('qwe123'),
    ]);
}
        </code></pre>
        <p>Y correr las migraciones y seeders:</p>
        <p><kbd>λ php artisan migrate:refresh --seed</kbd></p>

        <h2>#Trabajar con Roles y permisos</h2>
        <p>Cuando defines una ruta, deberás elegir si tendra un middleware o estará disponible para todos. Si decides que tendrá un filtro de solicitudes HTTP, deberás dejar tu ruta en el middleware Auth y asignarle un permiso (tú lo defines):</p>
        <pre><code>
<span style="color: #1c78c0;">Route::middleware</span>(['auth'])-><span style="color: #1c78c0;">group</span>(<span style="color: #1c78c0;">function</span> () {
<span class="text-muted">[...]</span>
<span style="color: #1c78c0;">Route::get</span>('products', 'ProductController@index')-><span style="color: #1c78c0;">name</span>('products.index')
	-><span style="color: #1c78c0;">middleware</span>('permission:products.products');
<span class="text-muted">[...]</span>
});
        </code></pre>
        <p>Ahora simplemente ve al Panel de gestión de usuarios, agrega el nuevo permiso "products.products" y asignalo a un rol existe o a uno nuevo, y ya está. Ah! asigna ese rol a un usuario.</p>
        
        <h2>#Trabajar con Actividades</h2>
        <p>Si deseas tener la visibilidad de la actividad de los usuarios sobre tu Modelo Productos, debes agregar lo siguiente en el model.php:</p>
        <pre><code>
namespace App;
<span class="text-muted">[...]</span>
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use Notifiable, HasRoles, LogsActivity;
<span class="text-muted">[...]</span>
    protected static $logName = 'User Activitylog';
    protected static $logAttributes = ['name', 'email', 'profile_image'];
<span class="text-muted">[...]</span>
}
        </code></pre>

        <h2>#Trabajar con Export/Import</h2>
        <p>Primero hay que crear un export.php:</p>
        <p><kbd>λ php artisan make:export UsersExport --model=User</kbd></p>
        <p>En la siguiente estructura de carpetas:</p>
        <pre><code>
.
├── app
│   ├── Exports
│   │   ├── UsersExport.php
│ 
└── composer.json
        </code></pre>
        <p>El nuevo archivo UsersExport.php tendrá el siguiente código:</p>
        <pre><code>
namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    public function collection()
    {
        return User::all();
    }
}
        </code></pre>
        <p>En el controlador de usuarios se agrega lo siguiente:</p>
        <pre><code>
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class UsersController extends Controller 
{
    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
        </code></pre>
        <p>Crear la ruta para esta exportación:</p>
        <p><kbd>λ <span style="color: #1c78c0;">Route::get</span>('users/export/', 'UserController@export')-><span style="color: #1c78c0;">name</span>('users.export')-><span style="color: #1c78c0;">middleware</span>('permission:roles.roles');</kbd></p>
        <p>Finalmente, en la blade agregar el siguiente código:</p>
        <pre><code>
&lt;a href="&#123;&#123; route('users.export') &#125;&#125;"&gt;Exportar&lt;/a&gt;
        </code></pre>


        <p>Primero hay que crear un import.php:</p>
        <p><kbd>λ php artisan make:import UsersImport --model=User</kbd></p>
        <p>En la siguiente estructura de carpetas:</p>
        <pre><code>
.
├── app
│   ├── Imports
│   │   ├── UsersImport.php
│ 
└── composer.json
        </code></pre>
        <p>El nuevo archivo UsersExport.php tendrá el siguiente código:</p>
        <pre><code>
namespace App\Imports;

use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements ToModel, WithValidation
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function rules(): array
    {
        return [
            '1' => 'unique:users,email'
        ];

    }

    public function customValidationMessages()
    {
        return [
            '1.unique' => 'Correo ya está en uso.',
        ];
    }

    public function model(array $row)
    {
        $user = User::create([
            'name'     => $row[0],
            'email'    => $row[1], 
            'password' => Hash::make($row[2]),
        ]);

        $user->assignRole('guest');
    }
}
        </code></pre>
        <p>En el controlador de usuarios se agrega lo siguiente:</p>
        <pre><code>
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class UsersController extends Controller 
{
    public function import() 
    {
        Excel::import(new UsersImport, request()->file('file'));
        
        return back()->with('success', 'Importado con éxito!');
    }
}
        </code></pre>
        <p>Crear la ruta para esta exportación:</p>
        <p><kbd><span style="color: #1c78c0;">Route::post</span>('userimport', 'UserController@import')-><span style="color: #1c78c0;">name</span>('users.import')-><span style="color: #1c78c0;">middleware</span>('permission:roles.roles');</kbd></p>
        <p>Finalmente, en la blade agregar el siguiente código:</p>
        <pre><code>
&lt;form action="&#123;&#123; route('users.import') &#125;&#125;" method="POST" enctype="multipart/form-data" class="was-validated"&gt;
@csrf
  &lt;div class="custom-file"&gt;
    &lt;input type="file" name="file" class="custom-file-input" id="validatedCustomFile" required&gt;
    &lt;label class="custom-file-label" for="validatedCustomFile">Choose file...&lt;/label&gt;
  &lt;/div&gt;
  &lt;br&gt;
  &lt;br&gt;
&lt;button type="submit" class="btn btn-info btn-lg btn-block btn-sm">Subir&lt;/button&gt;
&lt;/form&gt;
        </code></pre>

      <nav class="blog-pagination">
        <a class="btn btn-outline-primary" href="#">Older</a>
      </nav>

    </div><!-- /.blog-main -->

  </div><!-- /.row -->

</main><!-- /.container -->
</div>
@endsection