<?php

namespace App\Http\Controllers\Auth;

use App\Bitacora;
use App\Empresa;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Caffeinated\Shinobi\Models\Role;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'ci' => ['required','integer'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $empresa=Empresa::create([
            'nombre' => $data['namee']
        ]);

        $user=User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'ci' => $data['ci'],
            'password' => Hash::make($data['password']),
            'empresaId' => $empresa->id ,
        ]);
        DB::table('role_user')->insert([[
            'role_id' => 1,
            'user_id' => $user->id
        ]]);
        // $bitacora = Bitacora::create([
        //     'user_id' => $user->id,
        //     'accion' => 'Registrado en el sistema',
        //     'empresaId' => $user->id,
        // ]);
        // $bitacora->save();
        $user->save();
        return $user;
    }
}
