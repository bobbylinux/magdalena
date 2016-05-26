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

}
