<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sede extends BaseModel
{
    protected $table = "ta002_sedi";

    /**
     * The function for store in database from view
     *
     * @data array
     */
    public function store($data)
    {
        $this->c_cdc = $data['c_sed'];
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
        $this->c_cdc = $data['c_sed'];
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
}
