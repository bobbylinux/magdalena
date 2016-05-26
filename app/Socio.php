<?php

namespace App;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator as Validator;
use Illuminate\Support\Facades\Hash as Hash;
use Illuminate\Support\Facades\Mail as Mail;

class Socio extends BaseModel  {

    protected $table = "ta001_soci";

    protected $primaryKey = 'c_soc';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    // validate the info, create rules for the inputs
    /**
     * The variable for validation rules
     *
     */
    public $rulesStore = array(
        'codice_socio' => 'required|unique:ta001_soci,c_soc|min:1|max:16',
        'codice_badge' => 'required|unique:ta001_soci,c_bdg|min:1|max:16',
        'cognome' => 'required|min:2|max:128',
        'nome' => 'required|min:1|max:128',
        'codice_sede' => 'required|exists:ta002_sedi,c_sed',
        'codice_cdc' => 'required|exists:ta003_cdc,c_cdc',
        'username' => 'required|unique:users|min:5|max:128',
        'password' => 'required|min:8|max:64',
        'conferma_password' => 'required|same:password'
    );

    public $rulesUpdate = array(
        'cognome' => 'required|min:2|max:128',
        'nome' => 'required|min:1|max:128',
        'codice_sede' => 'required|exists:ta002_sedi,c_sed',
        'codice_cdc' => 'required|exists:ta003_cdc,c_cdc'
    );

    public $rulesPassword = array(
        'password' => 'required|min:8|max:64',
        'conferma_password' => 'required|min:8|max:64|same:password'
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
        $this->c_soc = $data['codice_socio'];
        $this->c_bdg = $data['codice_badge'];
        $this->t_cgn = $data['cognome'];
        $this->t_nom = $data['nome'];
        $this->c_sed = $data['codice_sede'];
        $this->c_cdc = $data['codice_cdc'];
        self::save();
    }

    /**
     * The function for update in database from view
     *
     * @data array
     */
    public function edit($data)
    {
        $this->c_soc = $data['codice_socio'];
        $this->c_bdg = $data['codice_badge'];
        $this->t_cgn = $data['cognome'];
        $this->t_nom = $data['nome'];
        $this->c_sed = $data['codice_sede'];
        $this->c_cdc = $data['codice_cdc'];
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
        return ($this->join('ts004_candidati','ts004_candidati.c_soc','=','ta001_soci.c_soc')->select('ta001_soci.t_nom','ta001_soci.t_cgn','ta001_soci.c_soc')->orderBy('t_cgn','asc')->orderBy('t_nom','asc')->get());
    }

    public function getSocioInfo($cod_socio) {
        return $this->where('c_soc','=',$cod_socio)->first();
    }
}
