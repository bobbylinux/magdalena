<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\DataRiferimento;

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
        $abilitato = 'N';

        if (isset($request->abilitato)) {
            $abilitato = 'S';
        }

        $dataInizio = date('Y-m-d', strtotime(str_replace('/', '-', $request->get('data-inizio'))));
        $dataFine = date('Y-m-d', strtotime(str_replace('/', '-', $request->get('data-fine'))));
        $userdata = array(
            'd_rif_ini' => $dataInizio,
            'd_rif_fin' => $dataFine,
            't_des' => $request->get('descrizione'),
            'n_vot_min' => $request->get('min-voti'),
            'n_vot_max' => $request->get('max-voti'),
            'f_att' => $abilitato
        );

        $this->dataRiferimento->store($userdata);

        return Redirect::action('DateRiferimentoController@index');
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
        var_dump($request);

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
