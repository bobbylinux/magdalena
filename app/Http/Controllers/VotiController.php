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
        $dataRif = $this->dataRiferimento->paginate(10);
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

    public function valida(Request $request) {
        $result = array();

        if (count($request->voti) == $this->dataRiferimento->getActiveDate()->n_vot_max) {
            $result['errore'] = true;
            $result['messaggio'] = "Al massimo possono essere scelte " . count($request->voti) . " preferenze";
        } else {
            $result['errore'] = false;
            $result['messaggio'] = "ok";
        }

        return json_encode($result);
    }

    public function votanti($id)
    {
        $dataRif = $this->dataRiferimento->where('c_rif','=',$id)->first();
        $votanti = $this->voto->getVotanti($id);
        return view('voti.votanti', compact("votanti","dataRif"));
    }

    public function votantiSede($id)
    {
        $dataRif = $this->dataRiferimento->where('c_rif','=',$id)->first();
        $votanti = $this->voto->getVotantiPerSede($id);
        return view('voti.votanti_sede', compact("votanti","dataRif"));
    }

    public function votantiCDC($id)
    {
        $dataRif = $this->dataRiferimento->where('c_rif','=',$id)->first();
        $votanti = $this->voto->getVotantiPerCDC($id);
        return view('voti.votanti_cdc', compact("votanti","dataRif"));
    }

    public function classifica($id)
    {
        $dataRif = $this->dataRiferimento->where('c_rif','=',$id)->first();
        $classifica = $this->voto->getClassifica($id);
        return view('voti.classifica', compact("classifica","dataRif"));
    }

    public function searchVotantiCDC(Request $request)
    {
        $id = $request->get('c_rif');
        $key = "%".strtolower(trim($request->get('ricerca-cdc')))."%";
        $dataRif = $this->dataRiferimento->where('c_rif','=',$id)->first();
        $votanti = $this->voto->searchVotantiPerCDC($id, $key);
        return view('voti.votanti_cdc', compact("votanti","dataRif"));
    }

}
