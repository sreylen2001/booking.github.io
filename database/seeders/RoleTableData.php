<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('new_roles')->insert([
            'name' => 'Customer',
            'description' => 'default customer'

        ]);

        DB::table('new_roles')->insert([
            'name' => 'Admin',
            'description' => 'default admin'

        ]);

        DB::table('new_roles')->insert([
            'name' => 'Driver',
            'description' => 'default driver'

        ]);
    }
}
