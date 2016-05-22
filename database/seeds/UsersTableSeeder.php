<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Socio;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash as Hash;
use Illuminate\Contracts\Hashing\Hasher;


class UsersTableSeeder extends Seeder
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
        $password = Socio::randStrGen(8);
        $userFile = "";
        $fileName = database_path().'/data/utenti.txt';
        foreach ($data as $obj) {
            $username = strtolower(str_replace('\'','',$obj->t_nom)).'.'.strtolower(str_replace('\'','',$obj->t_cgn).'.'.$obj->c_bdg);
            $username = str_replace('à','a',$username);
            $username = str_replace('è','e',$username);
            $username = str_replace('é','e',$username);
            $username = str_replace('ì','i',$username);
            $username = str_replace('ò','o',$username);
            $username = str_replace('ù','u',$username);
            $username = str_replace(' ','',$username);
            $password = Socio::randStrGen(8);
            try {
                User::create(array(
                    'c_soc' => $obj->c_soc,
                    'username' => $username,
                    'password' =>  bcrypt($password),
                ));
                $userFile .="username => ". $username . " password => " . $password . "\r\n";
            } catch (QueryException  $e) {
                var_dump($e->errorInfo );
            }
        }

        File::put($fileName,$userFile);
    }
}
