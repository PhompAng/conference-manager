<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Model\Conference;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    protected $redirectTo = "/";
    protected $prefix = "/";

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

    public function showLinkRequestForm()
    {

        $conf = Conference::where('url', $this->prefix)->first();
        return view('auth.passwords.email', ["prefix" => $this->prefix, "conf" => $conf]);
    }


}
