<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\VarDumper\Cloner\Data;
use App\DataRiferimento;
use App\User;
use App\Socio;
use App\Voto;

class HomeController extends Controller
{

    private $user;
    private $socio;
    private $dataRiferimento;
    private $voto;

    public function __construct(DataRiferimento $dataRiferimento, Socio $socio, User $user, Voto $voto)
    {
        $this->dataRiferimento = $dataRiferimento;
        $this->socio = $socio;
        $this->user = $user;
        $this->voto = $voto;
    }

    public function showHome()
    {

        $dataRiferimento = $this->dataRiferimento->getActiveDate();

        $candidati = $this->socio->getSociCandidati();
        if (Auth::check()) {
            //controllo se ha già votato
            $codiceSocio = Auth::user()->c_soc;
            if (!is_null($dataRiferimento) && count($this->voto->getVotiPerSocio($codiceSocio, $dataRiferimento->c_rif)) == 0) {
                $dataRif = $dataRiferimento->c_rif;
            }
            return view('index', compact("dataRif", "candidati"));
        } else {
            return view('auth.login');
        }


    }


    public function showDashboard()
    {
        $socio = $this->socio->getSocioInfo(Auth::user()->c_soc);
        return view('dashboard', compact('socio'));

    }

    public function showEsito()
    {
        return view('esito');
    }
}
