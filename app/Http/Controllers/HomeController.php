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
        $dataRif = $this->dataRiferimento->getActiveDate();
        $candidati = $this->socio->getSociCandidati();
        if (Auth::check()) {
            //controllo se ha già votato
            $codiceSocio = Auth::user()->c_soc;
            $dataRif = $dataRif->c_rif;
            if (count($this->voto->getVotiPerSocio($codiceSocio,$dataRif)) == 0){
                return view('index', compact("dataRif", "candidati"));
            } else {
                return view('esito');
            }
        } else {
            return view('auth.login');
        }


    }


    public function showDashboard()
    {
        //devo prende le informazioni dell'utente
        if (Auth::check()) {
            if (Auth::user()->admin) {
                $socio = $this->socio->getSocioInfo(Auth::user()->c_soc);
                return view('dashboard', compact('socio'));
            }
            return $this->showHome();
        }

        return view('users.login');

    }

    public function showEsito()
    {
        return view('esito');
    }
}
