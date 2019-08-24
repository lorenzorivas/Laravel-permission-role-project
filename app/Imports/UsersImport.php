<?php

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
