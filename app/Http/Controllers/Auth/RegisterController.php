<?php

namespace App\Http\Controllers\Auth;

use App\Model\Conference;
use App\User;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected $prefix = '/';

    /**
     * Create a new controller instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->middleware('guest');
        $this->prefix = $request->segment(1);
        $this->redirectTo = $this->prefix;
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
            'title' => 'required|numeric',
            'academic_position' => 'required|numeric',
            'name' => 'required|max:255',
            'family_name' => 'required|max:255',
            'affiliation' => 'required|max:255',
            'country' => 'required|max:255',
            'mobile' => 'required|max:255',
            'fax' => 'max:255',
            'username' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|numeric|between:1,2',
        ]);
    }

//    protected function showRegistrationForm() {
//
//    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        $conf = Conference::where('url', self::$prefix)->first();
//        print_r(Conference::find(1));
//        dd($conf);
        return $conf->users()->create([
            'title' => $data['title'],
            'academic_position' => $data['academic_position'],
            'name' => $data['name'],
            'family_name' => $data['family_name'],
            'affiliation' => $data['affiliation'],
            'country' => $data['country'],
            'mobile' => $data['mobile'],
            'fax' => $data['fax'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
        ]);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register', ['prefix' => $this->prefix]);
    }


}
