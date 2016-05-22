<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Voto;
use App\DataRiferimento;

class VotiController extends Controller
{

    protected $voto;

    protected $dataRiferimento;

    /**
     * Constructor for Dipendency Injection
     *
     * @return none
     *
     */
    public function __construct(Voto $voto, DataRiferimento $dataRiferimento)
    {
        $this->voto = $voto;
        $this->dataRiferimento = $dataRiferimento;
    }

    private function getVotoIstance()
    {
        return new Voto();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataRif = $this->dataRiferimento->get();
        return view('voti.index', compact("dataRif"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $c_rif = $this->dataRiferimento->getActiveDate()->c_rif;
        $voti = $request->voti;
        $data = array();
        foreach ($voti as $id) {
            $dataTmp = array(
                'c_soc' => Auth::user()->c_soc,
                'c_soc_vot' => $id,
                'd_vot' => date('Y-m-d H:i:s'),
                'c_rif' => $c_rif
            );

            $this->getVotoIstance()->store($dataTmp);
            array_push($data, $dataTmp);
        }

        return json_encode($data);

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

    public function getDettagli($id) {
        $tabella = "";

        $tabella .= $this->getClassifica($id) . $this->getVotantiPerCDC($id);
        return json_encode($tabella);
    }

    public function getClassifica($id)
    {
        if ($id > 0) {

            $classifica = $this->voto->getClassifica($id);

            $tabella = '<div class="row div-dettagli"><h3 class="text-center">Classifica</h3>';
            $tabella .= '<div class="col-lg-8 col-lg-offset-2">';
            $tabella .= '<table class="table table-striped"><thead><tr><th class="col-lg-2">Codice Badge</th><th class="col-lg-4">Cognome</th><th class="col-lg-4">Nome</th><th class="col-lg-2">Voti</th></tr></thead><tbody>';
            foreach ($classifica as $row) {
                $tabella .= '<tr><td>' . $row->c_bdg . '</td><td>' . $row->t_cgn . '</td><td>' . $row->t_nom . '</td><td>' . $row->voti . '</td></tr>';
            }
            $tabella .= '</tbody></table></div></div>';

            return ($tabella);
        } else {
            return (null);
        }
    }

    public function getVotantiPerCDC($id) {
        if ($id > 0) {

            $votanti = $this->voto->getVotantiPerCDC($id);

            $tabella = '<div class="row div-dettagli"><h3 class="text-center">Votanti per CDC</h3>';
            $tabella .= '<div class="col-lg-8 col-lg-offset-2">';
            $tabella .= '<table class="table table-striped"><thead><tr><th class="col-lg-2">Codice CDC</th><th class="col-lg-8">Descrizione</th><th class="col-lg-2">Votanti</th></tr></thead><tbody>';
            foreach ($votanti as $row) {
                $tabella .= '<tr><td>' . $row->c_cdc . '</td><td>' . $row->t_sed . '</td><td>' . $row->votanti . '</td></tr>';
            }
            $tabella .= '</tbody></table></div></div>';

            return ($tabella);

        } else {
            return (null);
        }
    }

    public function getAstenutiPerCDC($id) {
        if ($id > 0) {

            $votanti = $this->voto->getAstenutiPerCDC($id);

            $tabella = '<div class="row div-dettagli"><h3 class="text-center">Astenuti per CDC</h3>';
            $tabella .= '<div class="col-lg-8 col-lg-offset-2">';
            $tabella .= '<table class="table table-striped"><thead><tr><th class="col-lg-2">Codice CDC</th><th class="col-lg-8">Descrizione</th><th class="col-lg-2">Astenuti</th></tr></thead><tbody>';
            foreach ($votanti as $row) {
                $tabella .= '<tr><td>' . $row->c_cdc . '</td><td>' . $row->t_sed . '</td><td>' . $row->astenuti . '</td></tr>';
            }
            $tabella .= '</tbody></table></div></div>';

            return ($tabella);

        } else {
            return (null);
        }
    }

}
