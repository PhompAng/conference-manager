<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Conference;

class PaperController extends Controller
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
        return view('author.paper', ["prefix" => $this->prefix, "menu" => "paper", "title" => "Paper Submission", "conf" => $conf]);
    }
}
