<?php

namespace App\Http\Controllers\TPC;

use App\Model\Conference;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
{
    protected $prefix = "/";

    /**
     * PaperController constructor.
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->prefix = $request->segment(1);
    }

    public function index($url=null) {
        $conf = Conference::where('url', $this->prefix)->first();
        $authors = $conf->users->where('role', 1);
        return view('tpc.author', ["prefix" => $this->prefix, "menu" => "author", "title" => "Authors", "conf" => $conf, "authors" => $authors]);
    }
}
