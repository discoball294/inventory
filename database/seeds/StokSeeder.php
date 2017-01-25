<?php

use Illuminate\Database\Seeder;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stok')->truncate();
        $faker = Faker\Factory::create();
        $keterangan = ['Barang Masuk','Barang Keluar'];
        for ($i=0;$i<10;$i++){
            $stok = new \App\Stok();
            $stok->gudang_id = \App\Gudang::all()->random()->id;
            $stok->tanggal = $faker->dateTimeThisMonth;
            $stok->keterangan = $keterangan[rand(0,1)];
            $stok->save();
        }
    }
}
