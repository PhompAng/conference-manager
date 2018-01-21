<?php

namespace App\Http\Controllers\TPC;

use App\Mail\PaperNotify;
use App\Model\Paper;
use App\Model\Conference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
        $paper->status = 'Accepted';
        $paper->save();
        return redirect()->back()->with(['success' => 'Accept paper success!']);
    }

    public function rejected($url = null, $paper_id) {
        $paper = Paper::find($paper_id);
        $this->authorize('decision', $paper);

        $paper->decision = 'Rejected';
        $paper->status = 'Rejected';
        $paper->save();
        return redirect()->back()->with(['success' => 'Reject paper success!']);
    }

    public function notify($url = null, $paper_id) {
        $paper = Paper::find($paper_id);
        $paper->notify = true;
        $paper->save();

        $conf = $paper->conference;
        Mail::to("tingtong003tomy@gmail.com")->send(new PaperNotify($conf, $paper));
//        Mail::to($paper->user->email)->queue(new PaperNotify($conf, $paper));
//        return view('mails.notify', [
//            "conf" => $conf,
//            "paper" => $paper
//        ]);
        return redirect()->back()->with(['success' => 'Send Success']);
    }

    private function getAvgAndBpp($papers) {
        for ($i=0;$i<count($papers);$i++) {
            $avg = 0;
            $bpp = 0;
            $count = 0;
            for ($j=0;$j<count($papers[$i]->reviewers);$j++) {
                $papers[$i]->reviewers[$j]->pivot['score'] = json_decode($papers[$i]->reviewers[$j]->pivot->score, true);
                if (isset($papers[$i]->reviewers[$j]->pivot['score'])) {
                    $score = 0;
                    $score += $papers[$i]->reviewers[$j]->pivot['score']['1.1'];
                    $score += $papers[$i]->reviewers[$j]->pivot['score']['1.2'];
                    $score += $papers[$i]->reviewers[$j]->pivot['score']['2.1'];
                    $score += $papers[$i]->reviewers[$j]->pivot['score']['2.2'];
                    $score += $papers[$i]->reviewers[$j]->pivot['score']['2.3'];
                    $score += $papers[$i]->reviewers[$j]->pivot['score']['2.4'];
                    $score += $papers[$i]->reviewers[$j]->pivot['score']['2.5'];
                    $score += $papers[$i]->reviewers[$j]->pivot['score']['2.6'];
                    $score += $papers[$i]->reviewers[$j]->pivot['score']['3.1'];
                    $score += $papers[$i]->reviewers[$j]->pivot['score']['3.2'];
                    $score = $score / 10;
                    $avg += $score;
                    $count += 1;
                }
                if (isset($papers[$i]->reviewers[$j]->pivot['bpp_recommend']) && $papers[$i]->reviewers[$j]->pivot['bpp_recommend'] == 1) {
                    $bpp++;
                }
            }
            if (count($papers[$i]->reviewers) != 0) {
                $avg = $avg/$count;
            } else {
                $avg = 0;
            }
            $papers[$i]['avg'] = $avg;
            $papers[$i]['bpp'] = $bpp;
        }
    }
}
