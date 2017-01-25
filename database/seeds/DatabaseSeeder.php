<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(BarangSeeder::class);
         $this->call(GudangSeeder::class);
         $this->call(StokSeeder::class);
         $this->call(DetailStokSeeder::class);
    }
}
