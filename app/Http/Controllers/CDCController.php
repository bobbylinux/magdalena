<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\CentroDiCosto;

class CDCController extends Controller
{

    protected $centroDiCosto;

    /**
     * Constructor for Dipendency Injection
     *
     * @return none
     *
     */
    public function __construct(CentroDiCosto $centroDiCosto) {
        $this->centroDiCosto = $centroDiCosto;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cdc = $this->centroDiCosto->orderby('c_cdc')->paginate(10);
        return view('cdc.index', compact("cdc"));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cdc.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array(
            'codice' => $request->get('codice-cdc'),
            'descrizione' => $request->get('descrizione-cdc')
        );
        if (!$this->centroDiCosto->validate($data,$this->centroDiCosto->rulesSave)->fails()) {
            $this->centroDiCosto->store($data);
            return Redirect::action('CDCController@index');
        } else {
            $errors = $this->centroDiCosto->getErrors();
            return Redirect::action('CDCController@create')->withInput()->withErrors($errors);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cdc = $this->centroDiCosto->where('c_cdc','=',$id)->first();
        return view('cdc.edit',compact('cdc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array(
            'codice' => $request->get('codice-cdc'),
            'descrizione' => $request->get('descrizione-cdc')
        );

        $centroDiCosto = $this->centroDiCosto->where('c_cdc','=', $id)->first();

        $this->centroDiCosto->rulesUpdate['codice'] = 'required|unique:ta003_cdc,c_cdc,'.$centroDiCosto->c_cdc.',c_cdc|min:1|max:3';

        if (!$this->centroDiCosto->validate($data,$this->centroDiCosto->rulesUpdate )->fails()) {
            $centroDiCosto->edit($data);
            return Redirect::action('CDCController@index');
        } else {
            $errors = $this->centroDiCosto->getErrors();
            return Redirect::action('CDCController@edit', [$id])->withInput()->withErrors($errors);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $return = array();
        $return['errore'] = false;
        $return['messaggio'] = "ok";
        try {
            $cdc = $this->centroDiCosto->where('c_cdc','=',$id)->first();
            $cdc->trash();
        } catch (QueryException $err) {
            $return['errore'] = true;
            $return['messaggio'] = $err->getMessage();
        }

        return json_encode($return);
    }

    public function searchCDC(Request $request) {
        $key = '%'.trim(strtolower($request->get('ricerca-cdc'))).'%';
        $cdc = $this->centroDiCosto->where('c_cdc','ilike', $key)->orWhere('t_sed','ilike', $key)->orderby("c_cdc", "asc")->orderby("t_sed", "asc")->paginate(10);
        return view('cdc.index', compact('cdc'));
    }
}
