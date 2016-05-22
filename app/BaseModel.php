<?php namespace App;

use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model {
    /**
     * The variable for errors messages
     *
     */
    protected $messages = array(
    );


    /**
     * The variable for disable timestamps in insert/update tables
     */

    public $timestamps = false;

    /**
     * The variable for validation rules
     *
     */
    protected $rules = array(
    );
    /**
     * The function for validate
     *
     * @data array
     */
    public function validate($data, $rules = null)
    {
        $rules = (is_null($rules)) ? $this->rules : $rules;
        $validation = Validator::make($data, $rules, $this->messages);
        if ($validation->fails()) {
            // set errors
            $this->errors = $validation->messages();
        }
        return $validation;
    }
    /**
     * The function that incapsulate the error variable
     *
     * @errors array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}