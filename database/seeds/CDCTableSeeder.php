<?php

use Illuminate\Database\Seeder;
use App\CentroDiCosto;

class CDCTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(database_path().'/data/ta003_cdc.json');
        $data = json_decode($json);
        try {
            foreach ($data as $obj) {
                CentroDiCosto::create(array(
                    'c_cdc' => $obj->c_cdc,
                    't_sed' => $obj->t_sed
                ));
            }
        } catch (QueryException  $e) {
            var_dump($e->errorInfo);
        }

    }
}
