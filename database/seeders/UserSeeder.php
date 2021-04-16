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
        $user->email = 'test@gmail.com';
        $user->password = '$2y$10$q/CIlEIIiz5oHaBxa4UHb.5d9JAl4jotHc/8QihN24ZTl0yqcaHlm';
        $user->primerNombre = 'test';
        $user->primerApellido = 'com';
        $user->segundoApellido = 'com';
        $user->save();

        $user1 = new User();
        $user1->email = 'rick@gmail.com';
        $user1->password = '$2y$10$ZN91VpVVbm9jhdlox5AbL.1Zxboi.GJgRrHKhIGu172akgeSPpGyS';
        $user1->primerNombre = 'Richard';
        $user1->primerApellido = 'Camacho';
        $user1->segundoApellido = 'Hernández';
        $user1->rol = 2;
        $user1->rango = 8;
        $user1->programa = 3;
        $user1->save();

        $user2 = new User();
        $user2->email = 'malito@gmail.com';
        $user2->password = '$2y$10$2Gj0DGXh3t8MmttXV2p9juY2Gk8AoqQNMt.ag.nv.eyi2NQdN9pDm';
        $user2->primerNombre = 'Maria';
        $user2->segundoNombre = 'Alejandra';
        $user2->primerApellido = 'Torrenegra';
        $user2->segundoApellido = 'Anaya';
        $user2->rol = 1;
        $user2->rango = 8;
        $user2->programa = 3;
        $user2->save();
    }
}
