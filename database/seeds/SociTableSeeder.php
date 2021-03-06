<?php

use Illuminate\Database\Seeder;
use App\Socio;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash as Hash;
use Illuminate\Contracts\Hashing\Hasher;


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
        $password = "";
        foreach ($data as $obj) {
            $username = strtolower(str_replace('\'','',$obj->t_nom)).'.'.strtolower(str_replace('\'','',$obj->t_cgn));
            $username = str_replace('à','a',$username);
            $username = str_replace('è','e',$username);
            $username = str_replace('é','e',$username);
            $username = str_replace('ì','i',$username);
            $username = str_replace('ò','o',$username);
            $username = str_replace('ù','u',$username);
            try {
                Socio::create(array(
                    'c_soc' => $obj->c_soc,
                    'c_bdg' => $obj->c_bdg,
                    't_cgn' => $obj->t_cgn,
                    't_nom' => $obj->t_nom,
                    'c_cdc' => $obj->c_cdc,
                    'c_sed' => $obj->c_sed
                ));
            } catch (QueryException  $e) {
                var_dump($e->errorInfo );
            }
        }
    }
}
