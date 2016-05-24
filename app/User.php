<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends BaseModel implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The variable for validation rules
     *
     */
    protected $rules = array(
        'username' => 'required|unique:users|min:5|max:128',
        'password' => 'required|min:8|max:64',
        'conferma_password' => 'required|same:password',
        'codice_socio' => 'required|unique:users|exists:ta001_soci,c_soc'
    );

    /**
     * The variable for validation rules
     *
     */
    protected $errors = "";

    /**
     * The function that incapsulate the error variable
     *
     * @errors array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    public function store($data) {
        $this->username = $data['username'];
        $this->password = bcrypt($data['password']);
        $this->admin = bcrypt($data['admin']);
        $this->c_soc = bcrypt($data['codice_socio']);
        self::save();
    }
}
