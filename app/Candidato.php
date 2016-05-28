<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidato extends BaseModel
{

    protected $table = "ts004_candidati";


    public function store($data) {
        $this->c_soc = $data['c_soc'];
        $this->c_rif = $data['c_rif'];
        self::save();
    }

    public function edit($data) {
        $this->c_soc = $data['c_soc'];
        $this->c_rif = $data['c_rif'];
        $this->save();
    }

    public function trash() {
        $this->delete();
    }

    public function getCandidati($c_rif) {
        return $this->join('ta001_soci','ta001_soci.c_soc','=','ts004_candidati.c_soc')->where('c_rif','=',$c_rif)->orderby('t_cgn','asc')->orderby('t_nom','asc')->get();
    }

}
