<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataRiferimento;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\VarDumper\Cloner\Data;

class HomeController extends Controller
{

	private $dataRiferimento;

	public function __construct(DataRiferimento $dataRiferimento){
		$this->dataRiferimento = $dataRiferimento;
	}

    public function showHome() {
    	/*if (\Auth::check()) {
    		return view('dashboard');
		} else {
	    	return view('users.login');
		}*/
		//valuto le votazioni attive

		$dataRif = $this->dataRiferimento->getActiveDate();

		return view('index',compact("dataRif"));

    }
}
