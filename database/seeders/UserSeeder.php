<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->email = 'admin@admin.com';
        $user->password = '$2y$10$x.eZrhwj0biiJzhCPCkFOe1YOQQe.K66e0itAFWbEyKZW5XeuoHWK';
        $user->primerNombre = 'Admin';
        $user->primerApellido = 'del';
        $user->segundoApellido = 'Sistema';
        $user->rol = 3;
        $user->save();
    }
}
