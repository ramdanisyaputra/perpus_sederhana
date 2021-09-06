<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Author::create([
            'nama' => 'Ramdani',
            'tanggal_lahir' => '2002-11-09',
            'alamat' => 'Jl.Raya puncak kecamatan cisarua',
            'telp' => '081214373106',
        ]);
    }
}
