<?php

namespace App\Http\Controllers\Auth;

use App\Socio;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

//use App\Http\Requests\Auth\LoginRequest;
//use App\Http\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{

    /**
     * the model instance
     * @var User
     */
    protected $user;

    /**
     * The Guard implementation.
     *
     * @var Authenticator
     */
    protected $auth;

    /**
     * The socio model.
     *
     * @var Socio
     */
    protected $socio;

    /**
     * The sysdate variable.
     *
     * @var Now
     */
    protected $now;

    /**
     * Create a new authentication controller instance.
     *
     * @param  Authenticator $auth
     * @return void
     */
    public function __construct(Guard $auth, User $user, Socio $socio)
    {
        $this->user = $user;
        $this->auth = $auth;
        $this->socio = $socio;
        $this->now = date('Y-m-d');
        $this->middleware('guest', ['except' => ['getLogout']]);
    }

    /**
     * Show the application login form.
     *
     * @return Response
     */
    public function getLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  LoginRequest $request
     * @return Response
     */
    public function postLogin(Request $request)
    {

        $user = User::where('username', '=', $request->username)->first();

        if (isset($user)) {
            if ($user->password == md5($request->password)) { // If their password is still MD5
                $user->password = bcrypt($request->password); // Convert to new format
                $user->save();
            }
            $remember = (null !== $request->get("remember-me")) ? true : false;
            if ($this->auth->attempt($request->only('username', 'password'), $remember)) {
                if ($request->ajax()) {
                    return Response::json(array(
                        'code' => '200', //OK
                        'msg' => 'OK'));
                } else if ($this->auth->user()->admin == true) {
                    return redirect('dashboard');

                } else {
                    return redirect('/');
                }
            }
        }


        if ($request->ajax()) {
            return Response::json(array(
                'code' => '500', //OK
                'msg' => $this->getFailedLoginMessage()));
        } else {
            return redirect('/login')->withErrors([
                'email' => $this->getFailedLoginMessage()
            ]);
        }
    }

    /**
     * Log the user out of the application.
     *
     * @return Response
     */
    public function getLogout()
    {
        $this->auth->logout();

        return redirect('/');
    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {
        return Lang::has('auth.failed') ? Lang::get('auth.failed') : 'These credentials do not match our records.';
    }

    /**
     * Confirm the registration procedure through a code control
     *
     * @return \Illuminate\View\View
     *
     */
    public function verifyUser($code)
    {
        if (!$code) {
            $data['errore'] = true;
            $data['titolo'] = Lang::choice("messages.errore", 0);
            $data['conferma'] = Lang::choice('messages.errore_signin', 0);
            return view('auth.confirm', $data);
        }

        $user = $this->user->where('codice_conferma', '=', $code)->first();

        if (!$user) {
            $data['errore'] = true;
            $data['titolo'] = Lang::choice("messages.errore", 0);
            $data['conferma'] = Lang::choice('messages.errore_signin', 0);
            return view('auth.confirm', $data);
        } else {

            $user->confermato = true;
            $user->codice_conferma = null;
            $user->save();
            $data['conferma'] = Lang::choice('messages.conferma_testo', 0);
            $data['errore'] = false;
            $data['titolo'] = Lang::choice('messages.conferma_titolo', 0);
            return view('auth.confirm', $data);
        }
    }

    /**
     * Change your password submit
     *
     * @return \Illuminate\View\View
     *
     */
    public function getPassword()
    {
        return view('auth.password');
    }

    /**
     * Change your password submit
     *
     * @return \Illuminate\View\View
     *
     */
    public function postPassword(Request $request)
    {
        $data = array(
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'password_c' => $request->get('password_c')
        );

        //validate user
        $validatorUser = $this->user->validate($data, $this->user->passwordChangeRules);
        if ($validatorUser->fails()) {
            $errors = $this->user->getErrors();
            return Redirect::action('Auth\AuthController@getPassword')->withInput()->withErrors($errors);
        }
        //se validato devo aggiornare il db
        $user = $this->user->where('username', '=', $data['email'])->first();

        $codice = str_random(30);

        $data['codice'] = $codice;

        $user->password($data);

        //invio mail di conferma
        Mail::send('email.password', ['codice' => $codice, 'user' => $user], function ($message) use ($user, $codice) {
            $message->to($user->username, $user->username)
                ->subject('Conferma cambio password');
        });
        //ritorno alla home page
        return redirect('/');
    }
}
