<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        DB::connection()->disableQueryLog();
        Model::unguard();

        DB::table('ta001_soci')->delete();
        $this->command->info("tabella ta001_soci pulita");
        DB::table('ts002_dat_rif')->delete();
        $this->command->info("tabella ts002_dat_rif pulita");
        DB::table('ta002_sedi')->delete();
        $this->command->info("tabella ta002_sedi pulita");
        DB::table('ta003_cdc')->delete();
        $this->command->info("tabella ta003_cdc pulita");
        $this->call(CDCTableSeeder::class);
        $this->command->info("tabella ta003_cdc popolata");
        $this->call(SediTableSeeder::class);
        $this->command->info("tabella ta002_sedi popolata");
        $this->call(DataRifTableSeeder::class);
        $this->command->info("tabella ts002_dat_rif popolata");
        $this->call(SociTableSeeder::class);
        $this->command->info("tabella ta001_soci popolata");
        Model::reguard();
    }
}
