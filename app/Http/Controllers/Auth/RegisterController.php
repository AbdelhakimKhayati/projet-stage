<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
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
        ],[
            'name.required' => 'Le champ Nom est obligatoire.',
            'name.string' => 'Le champ Nom doit être une chaîne de caractères.',
            'name.max' => 'Le champ Nom ne doit pas dépasser :max caractères.',
            'email.required' => 'Le champ Adresse e-mail est obligatoire.',
            'email.string' => 'Le champ Adresse e-mail doit être une chaîne de caractères.',
            'email.email' => 'Le champ Adresse e-mail doit être une adresse e-mail valide.',
            'email.max' => 'Le champ Adresse e-mail ne doit pas dépasser :max caractères.',
            'email.unique' => 'L\'adresse e-mail est déjà utilisée par un autre utilisateur.',
            'password.required' => 'Le champ Mot de passe est obligatoire.',
            'password.string' => 'Le champ Mot de passe doit être une chaîne de caractères.',
            'password.min' => 'Le champ Mot de passe doit comporter au moins :min caractères.',
            'password.confirmed' => 'Le champ Confirmation du mot de passe ne correspond pas.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
