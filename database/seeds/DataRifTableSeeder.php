<?php

use Illuminate\Database\Seeder;
use App\DataRiferimento;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;

class DataRifTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(database_path().'/data/ts002_dat_rif.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            try {
                DataRiferimento::create(array(
                    'c_rif' => $obj->c_rif,
                    'd_rif_ini' => $obj->d_rif_ini,
                    'd_rif_fin' => $obj->d_rif_fin,
                    't_des' => $obj->t_des,
                    'f_att' => $obj->f_att
                ));
            } catch (QueryException  $e) {
                var_dump($e->errorInfo );
            }
        }
    }
}
