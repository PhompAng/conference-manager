<?php

namespace App\Http\Controllers\TPC;

use App\Model\Paper;
use App\Model\Conference;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PapersController extends Controller
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

    public function index($url = null)
    {
        $conf = Conference::where('url', $this->prefix)->first();
        $papers = Paper::where('conference_id', $conf->id)->get();
        $reviewers = $conf->users->where('role', '>=', 2);
        $this->getAvgAndBpp($papers);

        return view('tpc.papers', [
            "prefix" => $this->prefix,
            "menu" => "list",
            "title" => "Paper List",
            "conf" => $conf,
            "papers" => $papers,
            "reviewers" => $reviewers]);
    }

    public function accepted($url = null, $paper_id) {
        $paper = Paper::find($paper_id);
        $this->authorize('decision', $paper);

        $paper->decision = 'Accepted';
        $paper->save();
        return redirect()->back()->with(['success' => 'Accept paper success!']);
    }

    public function rejected($url = null, $paper_id) {
        $paper = Paper::find($paper_id);
        $this->authorize('decision', $paper);

        $paper->decision = 'Rejected';
        $paper->save();
        return redirect()->back()->with(['success' => 'Reject paper success!']);
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
