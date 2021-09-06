<?php

namespace Database\Seeders;

use App\Models\NonAdmin;
use Illuminate\Database\Seeder;

class NonAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NonAdmin::create([
            'nama' => 'non_admin',
            'username' => 'non_admin',
            'password' => bcrypt('non_admin')
        ]);
    }
}
