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
        $user->password = '$2y$10$q/CIlEIIiz5oHaBxa4UHb.5d9JAl4jotHc/8QihN24ZTl0yqcaHlm';
        $user->primerNombre = 'Admin';
        $user->primerApellido = 'del';
        $user->segundoApellido = 'Sistema';
        $user->save();
    }
}
