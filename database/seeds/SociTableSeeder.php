<?php

use Illuminate\Database\Seeder;
use App\Socio;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;


class SociTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $json = File::get(database_path().'/data/ta001_soci.json');
        $data = json_decode($json);

        foreach ($data as $obj) {
            try {
                echo $obj->c_bdg ."\n";
                Socio::create(array(
                    'c_soc' => $obj->c_soc,
                    'c_bdg' => $obj->c_bdg,
                    't_cgn' => $obj->t_cgn,
                    't_nom' => $obj->t_nom,
                    'c_cdc' => $obj->c_cdc,
                    'c_sed' => $obj->c_sed,
                    'c_tip_soc' => $obj->c_tip_soc,
                    't_usr' => $obj->t_usr,
                    't_pwd' => $obj->t_pwd,
                    'f_sgn_in' => $obj->f_sgn_in,
                    'f_cnd' => $obj->f_cnd,
                    'c_rif' => $obj->c_rif,
                ));
            } catch (QueryException  $e) {
                var_dump($e->errorInfo );
            }
        }
    }
}
