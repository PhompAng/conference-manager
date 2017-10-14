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
            $papers = $user->papers()->where('conference_id', $conf->id)->get();
            return view('author.list', [
                "prefix" => $this->prefix,
                "menu" => "list",
                "title" => "Paper List",
                "conf" => $conf,
                "papers" => $papers]);
        } else {
            $papers = Paper::where('conference_id', $conf->id)->get();
            $reviewers = $conf->users->where('role', '>=', 2);
            $this->getAvgAndBpp($papers);

            return view('reviewer.list', [
                "prefix" => $this->prefix,
                "menu" => "list",
                "title" => "Paper List",
                "conf" => $conf,
                "papers" => $papers,
                "reviewers" => $reviewers]);
        }
    }

    private function getAvgAndBpp($papers) {
        for ($i=0;$i<count($papers);$i++) {
            $avg = 0;
            $bpp = 0;
            for ($j=0;$j<count($papers[$i]->reviewers);$j++) {
                $papers[$i]->reviewers[$j]->pivot['score'] = json_decode($papers[$i]->reviewers[$j]->pivot->score, true);
                if (isset($papers[$i]->reviewers[$j]->pivot['score'])) {
                    $avg += $papers[$i]->reviewers[$j]->pivot['score']['4.1'];
                }
                if (isset($papers[$i]->reviewers[$j]->pivot['bpp_recommend']) && $papers[$i]->reviewers[$j]->pivot['bpp_recommend'] == 1) {
                    $bpp++;
                }
            }
            if (count($papers[$i]->reviewers) != 0) {
                $avg = $avg/count($papers[$i]->reviewers);
            } else {
                $avg = 0;
            }
            $papers[$i]['avg'] = $avg;
            $papers[$i]['bpp'] = $bpp;
        }
    }
}
