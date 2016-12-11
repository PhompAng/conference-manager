<?php

namespace App\Http\Controllers\Author;

use App\Model\Paper;
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
        $papers = $user->papers()->where('conference_id', $conf->id)->get();
        return view('author.list', ["prefix" => $this->prefix, "menu" => "list", "title" => "Paper List", "conf" => $conf, "papers" => $papers]);
    }
}
