<?php

use Illuminate\Database\Seeder;

class SediTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::table('ta002_sedi')->insert([
                'c_sed' => 142,
                't_sed' => 'CFT società cooperativa'
            ]);
            DB::table('ta002_sedi')->insert([
                'c_sed' => '838',
                't_sed' => 'BHO'
            ]);
        } catch (QueryException  $e) {
            var_dump($e->errorInfo);
        }
    }
}
