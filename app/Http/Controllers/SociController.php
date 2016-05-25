<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\LangLang;
use App\Http\Controllers\Controller as BaseController;

use App\Sede;
use App\CentroDiCosto;
use App\DataRiferimento;
use App\Http\Controllers\Controller;
use App\Socio;
use App\User;

class SociController extends Controller
{

    protected $socio;
    protected $user;
    protected $sede;
    protected $cdc;
    protected $data;

    /**
     * Constructor for Dipendency Injection
     *
     * @return none
     *
     */
    public function __construct(Socio $socio, User $user, Sede $sede, CentroDiCosto $cdc, DataRiferimento $data)
    {
        $this->socio = $socio;
        $this->user = $user;
        $this->sede = $sede;
        $this->cdc = $cdc;
        $this->data = $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $soci = $this->socio->orderby("t_cgn", "asc")->orderby("t_nom", "asc")->paginate(10);
        return view('soci.index', compact('soci'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sedi = $this->sede->getSediList();
        $cdc = $this->cdc->getCDCList();
        $data = $this->data->getDateList();
        return view('soci.create', compact("sedi", "cdc", "data"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (isset($request->amministratore)) {
            $admin = true;
        } else {
            $admin = false;
        }
        $data = array(
            'codice_socio' => $request->get('codice-socio'),
            'codice_badge' => $request->get('codice-badge'),
            'cognome' => $request->get('cognome'),
            'nome' => $request->get('nome'),
            'codice_cdc' => $request->get('cdc'),
            'codice_sede' => $request->get('sede'),
            'username' => $request->get('username'),
            'password' => $request->get('password'),
            'conferma_password' => $request->get('conferma-password'),
            'admin' => $admin
        );


        if (!$this->socio->validate($data,$this->socio->rulesStore)->fails()) {
            $this->socio->store($data);
            $this->user->store($data);
            return Redirect::action('SociController@index');
        }

        return Redirect::action('SociController@create')->withInput()->withErrors($this->socio->getErrors());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->where('c_soc', '=', $id)->first();
        $socio = $this->socio->where('c_soc', '=', $id)->first();
        $sedi = $this->sede->getSediList();
        $cdc = $this->cdc->getCDCList();
        $data = $this->data->getDateList();
        return view('soci.edit', compact("socio", "user", "sedi", "cdc", "data"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (isset($request->amministratore)) {
            $admin = true;
        } else {
            $admin = false;
        }
        $data = array(
            'codice_socio' => $request->get('codice-socio'),
            'codice_badge' => $request->get('codice-badge'),
            'cognome' => $request->get('cognome'),
            'nome' => $request->get('nome'),
            'codice_cdc' => $request->get('cdc'),
            'codice_sede' => $request->get('sede'),
            'username' => $request->get('username'),
            'password' => $request->get('password'),
            'conferma_password' => $request->get('conferma-password'),
            'admin' => $admin
        );

        $user = $this->user->where('c_soc','=',$id)->first();
        $socio = $this->socio->where('c_soc','=', $id)->first();

        $this->socio->rulesUpdate["username"] =  'required|unique:users,username,'.$user->id.'|min:5|max:128';
        $this->socio->rulesUpdate["codice_socio"] =  'required|unique:ta001_soci,c_soc,'.$socio->c_soc.',c_soc|min:1|max:16';
        $this->socio->rulesUpdate["codice_badge"] =  'required|unique:ta001_soci,c_bdg,'.$socio->c_soc.',c_soc|min:1|max:16';

        if (!$this->socio->validate($data,$this->socio->rulesUpdate)->fails()) {
            $user->edit($data);
            $socio->edit($data);
            return Redirect::action('SociController@index');

        }


        return Redirect::action('SociController@edit', [$id])->withInput()->withErrors($this->socio->getErrors());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Login method, show the login view
     *
     *
     * @return View
     */
    public function showLogin()
    {
        return view('users.login');
    }

    public function getSociCandidati(Request $request)
    {
        $result = $this->socio->getSociCandidati();
        $return_array[] = array();
        foreach ($result as $data) {
            $return_array[] = array('label' => $data->t_cgn . " " . $data->t_nom, 'value' => $data->t_cgn . " " . $data->t_nom, 'id' => $data->c_soc);
        }
        return json_encode($return_array);
    }

    public function searchSocio(Request $request) {
        $key = '%'.trim(strtolower($request->get('ricerca-socio'))).'%';
        $soci = $this->socio->where('c_bdg','ilike', $key)->orWhere('t_cgn','ilike', $key)->orWhere('t_nom','ilike', $key)->orderby("t_cgn", "asc")->orderby("t_nom", "asc")->paginate(10);
        return view('soci.index', compact('soci'));
    }
}
