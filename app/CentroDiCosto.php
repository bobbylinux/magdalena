<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CentroDiCosto extends BaseModel
{

    protected $table = "ta003_cdc";


    protected $primaryKey = 'c_cdc';

    /**
     * The variable for validation rules
     *
     */
    public $rulesSave = array(
        'codice' => 'required|unique:ta003_cdc,c_cdc|min:1|max:3',
        'descrizione' => 'required|max:100'
    );

    public $rulesUpdate = array(
        'descrizione' => 'required|max:100'
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
        $this->c_cdc = $data['codice'];
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
        $this->c_cdc = $data['codice'];
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

    public function getCDCList() {
        return $this->orderBy('t_sed')->lists('t_sed', 'c_cdc')->all();
    }
}
