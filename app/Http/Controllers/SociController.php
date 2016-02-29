<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SociController extends Controller
{
    

    public function showLogin() {
    	return view('users.login');
    }

    public function doLogin() {

    }
}
