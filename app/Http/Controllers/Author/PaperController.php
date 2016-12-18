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

class PaperController extends Controller
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

    protected function validator(array $data) {
        return Validator::make($data, [
            'title' => 'required|max:255',
            'abstract' => 'required',
            'topics.*' => 'required|max:255',
            'presentation' => 'in:1,2',
            'authors_name.*' => 'required|max:255',
            'authors_affiliation.*' => 'required|max:255',
            'authors_country.*' => 'required|max:255',
            'authors_email.*' => 'required|email|max:255',
            'authors_co_author.*' => 'required|boolean',
            'file' => 'required|max:10000000|mimes:pdf',
        ]);
    }

    public function submit(Request $request) {
        $data = $request->all();
        $conf = Conference::where('url', $this->prefix)->first();
        $user = Auth::user();

        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->back()->with(["prefix" => $this->prefix, "menu" => "paper", "title" => "Paper Submission", "conf" => $conf, "user" => $user])->withInput($data)->withErrors($validator);
        }

        $paper = new Paper();
        $paper->fill($data);

        $authors = [];
        for($i=0;$i<sizeof($data['authors_co_author']);$i++) {
            $author['name'] = $data['authors_name'][$i];
            $author['affiliation'] = $data['authors_affiliation'][$i];
            $author['country'] = $data['authors_country'][$i];
            $author['email'] = $data['authors_email'][$i];
            $author['co_author'] = $data['authors_co_author'][$i];
            $authors[] = $author;
        }

        $paper->authors = $authors;

        $file = $request->file('file');
        $filename = $this->prefix . "/" . $user->id . "/" . $paper->id . "_" . str_random(10).'.pdf';
        Storage::disk('local')->put($filename,  File::get($file));

        $paper->file = $filename;

        $paper->user()->associate($user);
        $paper->conference()->associate($conf);
        $paper->save();

        return redirect($this->prefix.'/list')->with(['success' => 'Success!']);
    }

    public function index($url=null) {
        $conf = Conference::where('url', $this->prefix)->first();
        $user = Auth::user();
        return view('author.paper', ["prefix" => $this->prefix, "menu" => "paper", "title" => "Paper Submission", "conf" => $conf, "user" => $user]);
    }

    public function getPaper($url, $user_id, $file) {
        if (Auth::user()->id != $user_id) {
            return abort(403, 'Unauthorized action.');
        }
        return response(Storage::disk('local')->get($url.'/'.$user_id.'/'.$file), 200, ['Content-Type' => 'application/pdf']);
    }
}
