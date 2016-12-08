<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Model\Conference;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EditController extends Controller
{
    protected $prefix = "/";

    /**
     * EditController constructor.
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->prefix = $request->segment(1);
    }

    protected function validator(array $data) {
        return Validator::make($data, [
            'title' => 'required|numeric',
            'academic_position' => 'required|numeric',
            'name' => 'required|max:255',
            'family_name' => 'required|max:255',
            'affiliation' => 'required|max:255',
            'country' => 'required|max:255',
            'mobile' => 'required|max:255',
            'email' => 'required|email|max:255',
            'fax' => 'max:255',
        ]);
    }

    public function update(Request $request) {
        $data = $request->all();
        $conf = Conference::where('url', $this->prefix)->first();
        $validator = $this->validator($data);
        if ($validator->fails()) {
            return view('author.edit')->with(["prefix" => $this->prefix, "menu" => "personal", "conf" => $conf, "user" => $request])->withErrors($validator);
        }

        Auth::user()->update($data);
        return view('author.edit', ["prefix" => $this->prefix, "menu" => "personal", "conf" => $conf, "user" => Auth::user()]);
    }

    public function index($url=null) {
        $conf = Conference::where('url', $this->prefix)->first();
        $user = Auth::user();
        return view('author.edit', ["prefix" => $this->prefix, "menu" => "personal", "conf" => $conf, "user" => $user]);
    }


}
