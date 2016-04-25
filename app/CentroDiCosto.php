<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CentroDiCosto extends BaseModel
{

    protected $table = "ta003_cdc";


    protected $primaryKey = 'c_cdc';

    /**
     * The function for store in database from view
     *
     * @data array
     */
    public function store($data)
    {
        $this->c_cdc = $data['c_cdc'];
        $this->t_sed = $data['t_sed'];
        self::save();
    }

    /**
     * The function for update in database from view
     *
     * @data array
     */
    public function edit($data)
    {
        $this->c_cdc = $data['c_cdc'];
        $this->t_sed = $data['t_sed'];
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

    public function getCDCList() {
        return $this->orderBy('t_sed')->lists('t_sed', 'c_cdc')->all();
    }
}
