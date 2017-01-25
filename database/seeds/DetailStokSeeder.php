<?php

use Illuminate\Database\Seeder;

class DetailStokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('detail_stok')->truncate();
        $faker = Faker\Factory::create();
        $shuffled_barang = \App\Barang::all()->shuffle();

        for ($i = 0; $i < 10 ; $i++){
            $detail_stok = new \App\DetailStok();
            $detail_stok->stok_id = \App\Stok::all()->random()->id;
            $detail_stok->barang_id = $shuffled_barang[$i]['id'];
            $detail_stok->unit = $shuffled_barang[$i]['unit'];
            $detail_stok->jumlah = rand(1,20);
            $detail_stok->save();
        }
    }
}
