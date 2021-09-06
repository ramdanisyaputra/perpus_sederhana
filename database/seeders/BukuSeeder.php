<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Buku::create([
            'kode' => 'B501',
            'judul' => 'Biografi Ramdani',
            'author_id' => '1',
            'penerbit' => 'Kompas',
            'tahun_terbit' => '2020',
            'stok' => '50',
            'foto' => '1.jpg'
        ]);
    }
}
