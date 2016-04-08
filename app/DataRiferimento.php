<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataRiferimento extends BaseModel
{
    protected $table = "ts002_dat_rif";


    protected $primaryKey = 'c_rif';

    /**
     * The function for store in database from view
     *
     * @data array
     */
    public function store($data)
    {
        $this->d_rif_ini = $data['d_rif_ini'];
        $this->d_rif_fin = $data['d_rif_fin'];
        $this->t_des = $data['t_des'];
        $this->f_att = $data['f_att'];
        self::save();
    }

    /**
     * The function for update in database from view
     *
     * @data array
     */
    public function edit($data)
    {
        $this->d_rif_ini = $data['d_rif_ini'];
        $this->d_rif_fin = $data['d_rif_fin'];
        $this->t_des = $data['t_des'];
        $this->f_att = $data['f_att'];
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
