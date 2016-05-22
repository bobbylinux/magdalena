<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Sede;

class SediController extends Controller
{

    protected $sede;

    /**
     * Constructor for Dipendency Injection
     *
     * @return none
     *
     */
    public function __construct(Sede $sede) {
        $this->sede = $sede;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sedi = $this->sede->paginate(10);
        return view('sedi.index',compact("sedi"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sedi.create');
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
            'codice' => $request->get('codice-sede'),
            'descrizione' => $request->get('descrizione-sede')
        );

        if (!$this->sede->validate($data)->fails()) {
            $this->sede->store($data);
            return Redirect::action('SediController@index');
        } else {
            $errors = $this->sede->getErrors();
            return Redirect::action('SediController@create')->withInput()->withErrors($errors);
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
        $sede = $this->sede->where('c_sed','=',$id)->first();
        return view('sedi.edit',compact('sede'));
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
            'codice' => $request->get('codice-sede'),
            'descrizione' => $request->get('descrizione-sede')
        );
        if (!$this->sede->validate($data)->fails()) {
            $sede = $this->sede->where('c_sed','=', $id)->first();
            $sede->edit($data);
            return Redirect::action('SediController@index');
        } else {
            $errors = $this->sede->getErrors();
            return Redirect::action('SediController@edit', [$id])->withInput()->withErrors($errors);
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
        //
    }
}
