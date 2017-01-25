<?php

use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('barang')->truncate();
        $faker = Faker\Factory::create();
        $unit = ['Pcs','Karton'];
        for ($i = 0; $i<10;$i++){
            $barang = new \App\Barang();
            $barang->nama_barang = $faker->company;
            $barang->deskripsi = $faker->catchPhrase;
            $barang->unit = $unit[rand(0,1)];
            $barang->stok = rand(0,10);
            $barang->keterangan = $faker->bs;
            $barang->save();
        }


    }
}
