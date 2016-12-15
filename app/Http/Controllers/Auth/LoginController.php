<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Model\Conference;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $redirectAfterLogout = "/";

    protected $prefix = "/";

    /**
     * Create a new controller instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->prefix = $request->segment(1);
        $this->redirectTo = $this->prefix;
        $this->redirectAfterLogout = $this->prefix;
    }

    public function username()
    {
        return 'username';
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $conf = Conference::where('url', $this->prefix)->first();
        return view('auth.login', ["prefix" => $this->prefix, "conf" => $conf]);
    }

    public function logout(Request $request)
    {
        $activeGuards = 0;
        $this->guard()->logout();

        foreach (config('auth.guards') as $guard => $guardConfig) {
            if ($guardConfig['driver'] === 'session') {
                $guardName = Auth::guard($guard)->getName();
                if ($request->session()->has($guardName) && $request->session()->get($guardName) === Auth::guard($guard)->user()->getAuthIdentifier()) {
                    $activeGuards++;
                }
            }
        }

        if ($activeGuards === 0) {
            $request->session()->flush();
            $request->session()->regenerate();
        }
        return redirect($this->redirectAfterLogout);

    }
}
