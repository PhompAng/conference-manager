<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Model\Conference;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    protected $prefix = "/";

    /**
     * Create a new controller instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->prefix = $request->segment(1);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($url=null)
    {
        $conf = Conference::where('url', $this->prefix)->first();
        return view('author.home', ["prefix" => $this->prefix, "menu" => "home", "title" => "Home", "conf" => $conf ]);
    }
}
