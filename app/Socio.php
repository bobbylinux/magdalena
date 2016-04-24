<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Factory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Socio extends BaseModel
{
    protected $table = "ta001_soci";


    protected $primaryKey = 'c_soc';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        't_usr', 't_pwd'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        't_pwd',
    ];

    // validate the info, create rules for the inputs
    /**
     * The variable for validation rules
     *
     */
    protected $rules = array(
        'username' => 'required|email', // make sure the email is an actual email
        'password' => 'required|alphaNum|min:4' // password can only be alphanumeric and has to be greater than 3 characters
    );

    private $errors = "";

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
    public function trash()
    {
        $this->delete();
    }

    public static function randStrGen($len)
    {
        $result = "";
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $charArray = str_split($chars);
        for ($i = 0; $i < $len; $i++) {
            $randItem = array_rand($charArray);
            $result .= "" . $charArray[$randItem];
        }
        return $result;
    }

    public function getSociCandidati() {
        return ($this->where('f_cnd','=','S')->select('t_nom','t_cgn','c_soc')->get());
    }
}
