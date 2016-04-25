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

class SociController extends Controller
{

    protected $socio;
    protected $sede;
    protected $cdc;
    protected $data;
    /**
     * Constructor for Dipendency Injection
     *
     * @return none
     *
     */
    public function __construct(Socio $socio, Sede $sede, CentroDiCosto $cdc, DataRiferimento $data)
    {
        $this->socio = $socio;
        $this->sede = $sede;
        $this->cdc = $cdc;
        $this->data = $data;
        $this->middleware('guest', ['except' => 'logout']);
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
        return view('soci.create',compact("sedi","cdc","data"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userdata = array(
            'c_soc' => $request->get('codice-socio'),
            'c_bdg' => $request->get('username_c'),
            't_cgn' => $request->get('password'),
            't_nom' => $request->get('password_c'),
            'ruolo_utente' => Input::get('ruolo_utente'),
            'confermato' => true
        );
        if ($this->utente->validate($userdata, 'Signin')) {
            $result = $this->utente->store($userdata);
            return Redirect::action('UtentiController@index');
        } else {
            $errors = $this->utente->getErrors();
            return redirect()->back()->withInput(Input::except('password', 'password_c'))->withErrors($errors);
        }
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
        //
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
        //
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

    /**
     * Do the login
     *
     * @return Redirect
     *
     */
    public function doLogin(Request $request)
    {
        // create our user data for the authentication
        $userdata = array(
            't_usr' => $request->get('username'),
            't_pwd' => $request->get('password')
        );
        if ($this->socio->validate($userdata)) {
            // attempt to do the login
            if (Auth::attempt($userdata)) {
                Session::put('utente_user', $userdata['username']);
                Session::put('utente_id', Auth::user()->c_soc);

                if (Auth::user()->f_admin == "S") {
                    return Redirect::to('dashboard');
                } else {
                    return Redirect::to('/');
                }
            } else {
                // validation not successful, send back to form
                return Redirect::to('login')->with('errore_auth', "errore")->withInput($request->except('password'));
            }
        } else {
            // validation not successful, send back to form
            return Redirect::to('login')->with('errore_auth', "errore")->withInput($request->except('password'));
        }
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
}
