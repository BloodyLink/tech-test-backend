<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(array(
            0 => array(
                'name' => 'admin'
            ),
            1 => array(
                'name' => 'usuario'
            ),
            2 => array(
                'name' => 'supervisor'
            )
        ));
    }
}
