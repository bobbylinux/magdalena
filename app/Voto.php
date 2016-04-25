<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voto extends BaseModel
{
    protected $table = "ts001_voti";

    /**
     * The function for store in database from view
     *
     * @data array
     */
    public function store($data)
    {
    }

    /**
     * The function for update in database from view
     *
     * @data array
     */
    public function edit($data)
    {
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
