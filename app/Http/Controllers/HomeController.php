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

class HomeController extends Controller
{

    private $user;
    private $socio;
    private $dataRiferimento;

    public function __construct(DataRiferimento $dataRiferimento, Socio $socio, User $user)
    {
        $this->dataRiferimento = $dataRiferimento;
        $this->socio = $socio;
        $this->user = $user;
    }

    public function showHome()
    {

        $dataRif = $this->dataRiferimento->getActiveDate();
        $candidati = $this->socio->getSociCandidati();
        if (Auth::check()) {
            return view('index', compact("dataRif","candidati"));
        } else {
            return view('auth.login');
        }


    }


    public function showDashboard()
    {
        //devo prende le informazioni dell'utente
        $socio = $this->socio->getSocioInfo(Auth::user()->c_soc);
        return view('dashboard', compact('socio'));
    }

    public function showEsito()
    {
        return view('esito');
    }
}
