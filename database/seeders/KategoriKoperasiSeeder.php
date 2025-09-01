<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriKoperasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriKoperasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriKoperasi::create([
            "jenis_koperasi" => "Produksi"
        ]);
        KategoriKoperasi::create([
            "jenis_koperasi" => "Konsumsi"
        ]);
        KategoriKoperasi::create([
            "jenis_koperasi" => "Simpan Pinjam"
        ]);
        KategoriKoperasi::create([
            "jenis_koperasi" => "Serba Usaha"
        ]);
    }
}
