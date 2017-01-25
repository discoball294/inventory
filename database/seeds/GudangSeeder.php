<?php

use Illuminate\Database\Seeder;

class GudangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gudang')->truncate();
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 5; $i++){
            $gudang = new \App\Gudang();
            $gudang->nama = 'Gudang'.($i+1);
            $gudang->keterangan = $faker->realText(10,1);
            $gudang->save();
        }
    }
}
