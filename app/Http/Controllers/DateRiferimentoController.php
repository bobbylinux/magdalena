<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\DataRiferimento;
use PhpSpec\Exception\Exception;

class DateRiferimentoController extends Controller
{

    private $dataRiferimento;


    public function __construct(DataRiferimento $dataRiferimento)
    {
        $this->dataRiferimento = $dataRiferimento;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataRiferimento = $this->dataRiferimento->orderby("d_rif_ini", "asc")->orderby("d_rif_fin", "asc")->paginate(10);
        return view('dateRiferimento.index', compact('dataRiferimento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dateRiferimento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attivo = 'N';

        if (isset($request->attivo)) {
            $attivo = 'S';
        }

        $dataInizio = date('Y-m-d', strtotime(str_replace('/', '-', $request->get('data-inizio'))));
        $dataFine = date('Y-m-d', strtotime(str_replace('/', '-', $request->get('data-fine'))));
        $data = array(
            'data_inizio' => $dataInizio,
            'data_fine' => $dataFine,
            'descrizione' => $request->get('descrizione'),
            'numero_voti_minimo' => $request->get('min-voti'),
            'numero_voti_massimo' => $request->get('max-voti'),
            'attivo' => $attivo
        );
        if (!$this->dataRiferimento->validate($data)->fails()) {
            $this->dataRiferimento->store($data);
            return Redirect::action('DateRiferimentoController@index');
        } else {
            $errors = $this->dataRiferimento->getErrors();
            return Redirect::action('DateRiferimentoController@create')->withInput()->withErrors($errors);
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
        $dataRiferimento = $this->dataRiferimento->where('c_rif','=',$id)->first();
        return view('dateRiferimento.edit',compact('dataRiferimento'));
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
        $attivo = 'N';

        if (isset($request->attivo)) {
            $attivo = 'S';
        }

        $dataInizio = date('Y-m-d', strtotime(str_replace('/', '-', $request->get('data-inizio'))));
        $dataFine = date('Y-m-d', strtotime(str_replace('/', '-', $request->get('data-fine'))));
        $data = array(
            'data_inizio' => $dataInizio,
            'data_fine' => $dataFine,
            'descrizione' => $request->get('descrizione'),
            'numero_voti_minimo' => $request->get('min-voti'),
            'numero_voti_massimo' => $request->get('max-voti'),
            'attivo' => $attivo
        );

        if (!$this->dataRiferimento->validate($data)->fails()) {
            $dataRiferimento = $this->dataRiferimento->where('c_rif','=',$id)->first();
            $dataRiferimento->edit($data);
            return Redirect::action('DateRiferimentoController@index');
        } else {
            $errors = $this->dataRiferimento->getErrors();
            return Redirect::action('DateRiferimentoController@edit', [$id])->withInput()->withErrors($errors);
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
            $dataRiferimento = $this->dataRiferimento->where('c_rif','=',$id)->first();
            $dataRiferimento->trash();
        } catch (Exception $err) {
            $return['errore'] = true;
            $return['messaggio'] = $err->getMessage();
        }

        return json_encode($return);
    }
}
