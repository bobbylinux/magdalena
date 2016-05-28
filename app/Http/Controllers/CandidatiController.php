<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Candidato;
use App\DataRiferimento;
use App\Voto;
use App\Socio;

class CandidatiController extends Controller
{

    private $candidato;
    private $dataRiferimento;
    private $voto;
    private $socio;

    public function __construct(Candidato $candidato, DataRiferimento $dataRiferimento, Voto $voto, Socio $socio)
    {
        $this->candidato = $candidato;
        $this->voto = $voto;
        $this->socio = $socio;
        $this->dataRiferimento = $dataRiferimento;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataRif = $this->dataRiferimento->getDateList();
        return view('candidati.index', compact("dataRif"));
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
        $tabella = "";
        if (isset($request->c_soc) && isset($request->c_rif)) {
            $c_soc = $request->get('c_soc');
            $c_rif = $request->get('c_rif');

            $checkCandidatoPresente = $this->candidato->where('c_rif', '=', $c_rif)->where('c_soc', '=', $c_soc)->count();


            $checkEsisteCandidato = $this->socio->where('c_soc', '=', $c_soc)->count();

            if ($checkCandidatoPresente == 0 && $checkEsisteCandidato > 0) {
                $data = array(
                    'c_soc' => $c_soc,
                    'c_rif' => $c_rif
                );

                $this->candidato->store($data);
            }
            $tabella = $this->generaTabellaCandidati($c_rif);


        }

        return json_encode($tabella);
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
        $return = array();
        $return['errore'] = false;
        $return['messaggio'] = "ok";

        try {
            $candidato = $this->candidato->find($id);
            $voto = $this->voto->where('c_soc_vot', '=', $candidato->c_soc)->count();

            if ($voto == 0) {
                $candidato->trash();
            } else {
                throw new \Exception('Impossibile cancellare il candidato poichè presente un vincolo referenziale nel database voti.');
            }

        } catch (Exception $err) {
            $return['errore'] = true;
            $return['messaggio'] = $err->getMessage();
        }

        return json_encode($return);
    }

    public function getTabellaCandidati(Request $request)
    {
        if (isset($request->c_rif)) {
            $candidati = $this->candidato->getCandidati($request->get('c_rif'));
            $tabella = "";
            if (count($candidati) > 0) {

                $tabella = '<div class="col-xs-6 col-xs-offset-3"><table class="table table-striped"><thead><tr><th class="col-lg-1">Codice Badge</th><th class="col-lg-2">Cognome</th><th class="col-lg-2">Nome</th><th class="col-lg-1 text-center"></th></tr></thead><tbody>';

                foreach ($candidati as $candidato) {
                    $tabella .= '<tr><td>';
                    $tabella .= $candidato->c_soc;
                    $tabella .= '</td><td>';
                    $tabella .= $candidato->t_cgn;
                    $tabella .= '</td><td>';
                    $tabella .= $candidato->t_nom;
                    $tabella .= '</td><td><a class="btn btn-danger btn-sm btn-cancella-candidato" data-id="' . $candidato->id . '" data-token="' . csrf_token() . '"><i class="fa fa-times"></i></a>';
                    $tabella .= '</td></tr>';
                }

                $tabella .= '</tbody></table></div>';
            }

            return json_encode($tabella);
        }
    }

    private function generaTabellaCandidati($c_rif)
    {

        $candidati = $this->candidato->getCandidati($c_rif);
        $tabella = "";
        if (count($candidati) > 0) {

            $tabella = '<div class="col-xs-6 col-xs-offset-3"><table class="table table-striped"><thead><tr><th class="col-lg-1">Codice Badge</th><th class="col-lg-2">Cognome</th><th class="col-lg-2">Nome</th><th class="col-lg-1 text-center"></th></tr></thead><tbody>';

            foreach ($candidati as $candidato) {
                $tabella .= '<tr><td>';
                $tabella .= $candidato->c_soc;
                $tabella .= '</td><td>';
                $tabella .= $candidato->t_cgn;
                $tabella .= '</td><td>';
                $tabella .= $candidato->t_nom;
                $tabella .= '</td><td><a class="btn btn-danger btn-sm btn-cancella-candidato" data-id="' . $candidato->id . '" data-token="' . csrf_token() . '"><i class="fa fa-times"></i></a>';
                $tabella .= '</td></tr>';
            }

            $tabella .= '</tbody></table></div>';
        }

        return ($tabella);
    }
}
