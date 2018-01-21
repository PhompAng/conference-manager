<?php

namespace App\Http\Controllers\Author;

use App\Model\Conference;
use App\Model\Paper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    protected $prefix = "/";

    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->prefix = $request->segment(1);
    }

    public function index($url, $paper_id) {
        $paper = Paper::find($paper_id);
        $this->authorize('view_review', $paper);
        $conf = Conference::where('url', $this->prefix)->first();
        $reviewers = $paper->reviewers;

        return view('author.review.index', [
            "prefix" => $this->prefix,
            "menu" => "my_submission",
            "title" => "Review of Paper " . $paper->id . ": ".$paper->title,
            "conf" => $conf,
            "reviews" => $reviewers]);
    }
}
