<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Socio extends BaseModel
{
    protected $table = "ta001_soci";


    protected $primaryKey = 'c_soc';

    /**
     * The function for store in database from view
     *
     * @data array
     */
    public function store($data)
    {
        $this->c_soc = $data['c_soc'];
        $this->c_bdg = $data['c_bdg'];
        $this->t_cgn = $data['t_cgn'];
        $this->t_nom = $data['t_nom'];
        $this->c_sed = $data['c_sed'];
        $this->c_tip_soc = $data['c_tip_soc'];
        $this->t_usr = $data['t_usr'];
        $this->t_pwd = $data['t_pwd'];
        $this->f_sgn_in = $data['f_sgn_in'];
        $this->f_cnd = $data['f_cnd'];
        $this->c_rif = $data['c_rif'];
        self::save();
    }

    /**
     * The function for update in database from view
     *
     * @data array
     */
    public function edit($data)
    {
        $this->c_soc = $data['c_soc'];
        $this->c_bdg = $data['c_bdg'];
        $this->t_cgn = $data['t_cgn'];
        $this->t_nom = $data['t_nom'];
        $this->c_sed = $data['c_sed'];
        $this->c_tip_soc = $data['c_tip_soc'];
        $this->t_usr = $data['t_usr'];
        $this->t_pwd = $data['t_pwd'];
        $this->f_sgn_in = $data['f_sgn_in'];
        $this->f_cnd = $data['f_cnd'];
        $this->c_rif = $data['c_rif'];
        $this->save();
    }
    /**
     * The function for delete in database from view
     *
     * @data array
     */
    public function trash() {
        $this->delete();
    }
}
