<?php

namespace App\Http\Controllers\Reviewer;

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

    protected function validator(array $data) {
        return Validator::make($data, [
            'score'    => 'required|array|size:11',
            'score.*'    => 'required|in:1,2,3,4,5',
            'bpp_recommend' => 'required|boolean',
            'comment_str' => 'max:1500',
            'comment_weak' => 'max:1500',
            'comment_reviewer' => 'max:1500'
        ]);
    }

    public function index($url, $paper_id) {
        $paper = Paper::find($paper_id);
        $this->authorize('view_review', $paper);
        $conf = Conference::where('url', $this->prefix)->first();
        $reviewers = $paper->reviewers;
        for ($i=0;$i<count($reviewers);$i++) {
            $reviewers[$i]->pivot['score'] = json_decode($reviewers[$i]->pivot->score, true);
        }

        return view('reviewer.review.index', [
            "prefix" => $this->prefix,
            "menu" => "list",
            "title" => "Review of Paper " . $paper->id . ": ".$paper->title,
            "conf" => $conf,
            "reviews" => $reviewers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($url=null, $paper_id)
    {
        $paper = Paper::find($paper_id);
        $this->authorize('review', $paper);

        $conf = Conference::where('url', $this->prefix)->first();
        return view('reviewer.review.create', [
            "prefix" => $this->prefix,
            "menu" => "list",
            "title" => "Review Paper " . $paper->id . ": ".$paper->title,
            "conf" => $conf,
            "paper" => $paper]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$url,$paper_id)
    {
        $paper = Paper::find($paper_id);
        $this->authorize('review', $paper);
        $data = $request->except('_token');
        $conf = Conference::where('url', $this->prefix)->first();
        $user = Auth::user();

        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with([
                    "prefix" => $this->prefix,
                    "menu" => "list",
                    "title" => "Review Paper " . $paper->id . ": ".$paper->title,
                    "conf" => $conf,
                    "paper" => $paper])
                ->withInput($data)
                ->withErrors($validator);
        }

        $data['score'] = json_encode($data['score'], JSON_UNESCAPED_UNICODE);

        $paper->reviewers()->updateExistingPivot($user->id, $data);
        return redirect($this->prefix.'/review_list')->with(['success' => 'Review Success!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($url, $paper_id, $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function assign($url=null, $paper_id, $user_id) {
        $paper = Paper::find($paper_id);
        $this->authorize('assign', $paper);

        $paper->reviewers()->attach($user_id);
        return redirect()->back()->with(['success' => 'Assign reviewer success!']);
    }

    public function unassign($url=null, $paper_id, $user_id) {
        $paper = Paper::find($paper_id);
        $this->authorize('assign', $paper);

        $paper->reviewers()->detach($user_id);
        return redirect()->back()->with(['success' => 'Unassign reviewer success!']);
    }
}
