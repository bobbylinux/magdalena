<?php
namespace App\Http\Controllers\Auth;

use App\Socio;
use App\User;
use Illuminate\Support\Facades\Auth as Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector as Redirect;
use Illuminate\Session\SessionManager;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';


    protected $socio;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Socio $socio)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->socio = $socio;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Login method, show the login view
     *
     *
     * @return View
     */
    public function showLogin()
    {
        return view('users.login');
    }

    /**
     * Login method, do the login
     *
     *
     * @return View
     */
    public function doLogin(Request $request)
    {
        // create our user data for the authentication
        $userdata = array(
            't_usr' => $request->get('username'),
            't_pwd' => $request->get('password')
        );

        if ($this->socio->validate($userdata)) {
            // attempt to do the login
            if (\Auth::attempt($userdata)) {
                Session::put('utente_user', $userdata['username']);
                Session::put('utente_id', Auth::user()->id);
                Session::put('utente_admin', Auth::user()->f_admin);

                if (Auth::user()->f_admin == "S") {
                    return Redirect::to('dashboard');
                } else {
                    return Redirect::to('/');
                }
            } else {
                // validation not successful, send back to form
                return \Redirect::to('login')->with('errore_auth',"Errore autenticazione. Contattare l'amministratore.")->withInput($request->except("password"));
            }
        } else {
            $errors = $this->utente->getErrors();
            return Redirect::to('login')->withErrors($errors)->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        }
    }
}
