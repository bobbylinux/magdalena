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
        DB::table('ta003_cdc')->delete();
        $this->command->info("tabella ta003_cdc pulita");
        $this->call(CDCTableSeeder::class);
        $this->command->info("tabella ta003_cdc popolata");
        DB::table('ta002_sedi')->delete();
        $this->command->info("tabella ta002_sedi pulita");
        $this->call(SediTableSeeder::class);
        $this->command->info("tabella ta002_sedi popolata");
        Model::reguard();
    }
}
