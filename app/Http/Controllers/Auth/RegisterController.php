<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
            'address' => ['required', 'string', 'max:255'],
            'photo' => ['required', 'mimes:jpeg,jpg,png,bmp', 'max:5120'],
            'Technologies' => ['min:2'],
            'experience' => ['required'],
            'companies' => ['required'],
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
        $companies = $data['companies'];
        function single_array($companies)
        {
            foreach ($companies as $key) {
                if (is_array($key)) {
                    $newcom = single_array($key);
                    foreach ($newcom as $k) {
                        $new_arr[] = $k;
                    }
                } else {
                    $new_arr[] = $key;
                }
            }
            return $new_arr;
        }
        $newcom = single_array($companies);
        $com = implode(',', $newcom);

        $photo      =       time() . '.' . $data['photo']->extension();
        $data['photo']->move(public_path('Profile'), $photo);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'address' => $data['address'],
            'photo' => $photo,
            'Technologies' => implode(',', $data['Technologies']),
            'experience' => $data['experience'],
            'companies' => $com,
        ]);
    }
}
