<?php

namespace App\Http\Controllers;

use App\Model\Paper;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Conference;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PaperListController extends Controller
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
        if ($user->role == 1) {
            $papers = $user->papers()->where('conference_id', $conf->id)->get();return view('author.list', ["prefix" => $this->prefix, "menu" => "list", "title" => "Paper List", "conf" => $conf, "papers" => $papers]);
        } else {
            $papers = Paper::where('conference_id', $conf->id)->get();
            $reviewers = $conf->users->where('role', '>=', 2);
            return view('reviewer.list', ["prefix" => $this->prefix, "menu" => "list", "title" => "Paper List", "conf" => $conf, "papers" => $papers, "reviewers" => $reviewers]);
        }

    }
}
