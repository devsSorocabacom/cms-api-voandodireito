<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['id' => 1, 'label' => 'Administrador']
        ];

        DB::table('roles')->insert($roles);
    }
}
