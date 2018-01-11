<?php

namespace App\Http\Controllers\Auth;

use App\Model\Conference;
use App\User;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;

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
        $conf = Conference::where('url', $this->prefix)->first();
        return $conf->users()->create([
            'title' => $data['title'],
            'academic_position' => $data['academic_position'],
            'name' => $data['name'],
            'family_name' => $data['family_name'],
            'affiliation' => $data['affiliation'],
            'country' => $data['country'],
            'mobile' => $data['mobile'],
            'fax' => $data['fax'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
        ]);
    }

    public function register(Request $request)
    {
        $data = $request->all();
        $conf = Conference::where('url', $this->prefix)->first();
        if ($conf->users()->where('email', $data['email'])->count() > 0) {
            return redirect()->back()->withInput($data)->withErrors(['email' => 'duplicate email']);
        }
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $conf = Conference::where('url', $this->prefix)->first();
        return view('auth.register', ['prefix' => $this->prefix, "conf" => $conf]);
    }


}
