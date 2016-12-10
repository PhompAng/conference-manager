<?php

namespace App\Http\Controllers\Author;

use App\Model\Paper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Conference;
use Illuminate\Support\Facades\Auth;

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

    public function submit(Request $request) {
        $data = $request->all();
        $conf = Conference::where('url', $this->prefix)->first();
        $user = Auth::user();

        $paper = new Paper();
        $paper->fill($data);
        $paper->user()->associate($user);
        $paper->conference()->associate($conf);
        $paper->save();

        dd($paper);
    }

    public function index($url=null) {
        $conf = Conference::where('url', $this->prefix)->first();
        return view('author.paper', ["prefix" => $this->prefix, "menu" => "paper", "title" => "Paper Submission", "conf" => $conf]);
    }
}
