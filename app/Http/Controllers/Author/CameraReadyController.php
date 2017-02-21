<?php

namespace App\Http\Controllers\Author;

use App\Model\Paper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Conference;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CameraReadyController extends Controller
{
    protected $prefix = "/";

    /**
     * PaperController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->prefix = $request->segment(1);
    }

    /**
     * Display a listing of the resource.
     *
     * @param null $url
     * @return \Illuminate\Http\Response
     */
    public function index($url=null) {
        $conf = Conference::where('url', $this->prefix)->first();
        $user = Auth::user();
        $papers = $user->papers()->where('conference_id', $conf->id)->where('status', 'accepted')->get();
        return view('author.camera_ready.index', ["prefix" => $this->prefix, "menu" => "camera", "title" => "Camera Ready Submission", "conf" => $conf, "papers" => $papers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param null $url
     * @param $paper_id
     * @return \Illuminate\Http\Response
     */
    public function create($url=null, $paper_id)
    {
        $conf = Conference::where('url', $this->prefix)->first();
        $paper = Paper::find($paper_id);
        return view('author.camera_ready.create', ["prefix" => $this->prefix, "menu" => "camera", "title" => "Camera Ready Submission", "conf" => $conf, "paper" => $paper]);
    }

    protected function validator(array $data) {
        return Validator::make($data, [
            'file' => 'required|max:10000000|mimes:pdf',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param null $url
     * @param $paper_id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $url=null, $paper_id)
    {
        $data = $request->all();
        $conf = Conference::where('url', $this->prefix)->first();
        $user = Auth::user();
        $paper = Paper::find($paper_id);

        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->back()->with(["prefix" => $this->prefix, "menu" => "camera", "title" => "Camera Ready Submission", "conf" => $conf, "paper" => $paper])->withErrors($validator);
        }

        $file = $request->file('file');
        $filename = $this->prefix . "/" . $user->id . "/" . $paper->id . "_" . str_random(10).'_camera_ready.pdf';
        Storage::disk('local')->put($filename,  File::get($file));

        $paper->camera_ready = $filename;
        $paper->save();
        return redirect($this->prefix.'/camera_ready')->with(['success' => 'Success!']);
    }

}
