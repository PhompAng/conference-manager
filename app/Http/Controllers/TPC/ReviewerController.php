<?php

namespace App\Http\Controllers\TPC;

use App\Model\Conference;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewerController extends Controller
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
        $user = Auth::user();
        $reviewer = $conf->users->where('role', '>=', 2);
        return view('tpc.reviewer', ["prefix" => $this->prefix, "menu" => "reviewer", "title" => "Reviewer", "user" => $user, "conf" => $conf, "reviewers" => $reviewer]);
    }
}
