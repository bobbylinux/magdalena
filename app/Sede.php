<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Sede extends BaseModel
{
    protected $table = "ta002_sedi";

    protected $primaryKey = 'c_sed';

    /**
     * The variable for validation rules
     *
     */
    protected $rules = array(
        'codice' => 'required|min:1|max:3',
        'descrizione' => 'required|max:100',
    );

    /**
     * The variable for validation rules
     *
     */
    protected $errors = "";

    /**
     * The function that incapsulate the error variable
     *
     * @errors array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * The function for store in database from view
     *
     * @data array
     */
    public function store($data)
    {
        $this->c_sed = $data['codice'];
        $this->t_sed = $data['descrizione'];
        self::save();
    }

    /**
     * The function for update in database from view
     *
     * @data array
     */
    public function edit($data)
    {
        $this->c_sed = $data['codice'];
        $this->t_sed = $data['descrizione'];
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


    public function getSediList() {
        return $this->lists('t_sed', 'c_sed')->all();
    }
}
