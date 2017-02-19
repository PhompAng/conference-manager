<?php

namespace App\Http\Controllers\Reviewer;

use App\Model\Paper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    protected $prefix = "/";

    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->prefix = $request->segment(1);
    }

    public function index($url=null, $paper_id) {
        $paper = Paper::find($paper_id);
//        foreach ($paper->reviewers as $rew) {
//            print_r($rew->pivot->comment_str);
//        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
