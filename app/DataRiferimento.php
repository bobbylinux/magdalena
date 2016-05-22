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
        $this->n_vot_min = $data['n_vot_min'];
        $this->n_vot_max = $data['n_vot_max'];
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
        $this->n_vot_min = $data['n_vot_min'];
        $this->n_vot_max = $data['n_vot_max'];
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

    public function getActiveDate() {
        $now = date('Y-m-d');
        return $this/*->where('d_rif_ini','<=',$now)->where('d_rif_fin','>=',$now)*/->first();

    }

    public function getDateList() {
        return $this->orderBy('d_rif_ini')->lists('d_rif_ini', 'c_rif')->all();
    }
}
