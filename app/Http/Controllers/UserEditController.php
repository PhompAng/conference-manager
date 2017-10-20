<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Conference;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserEditController extends Controller
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
            'fax' => 'max:255',
        ]);
    }

    public function update(Request $request) {
        $data = $request->all();
        $conf = Conference::where('url', $this->prefix)->first();
        $validator = $this->validator($data);
        if ($validator->fails()) {
            return view('edit')->with(["prefix" => $this->prefix, "menu" => "personal", "title" => "Personal Information", "conf" => $conf, "user" => $request])->withErrors($validator);
        }

        Auth::user()->update($data);
        return view('edit', ["prefix" => $this->prefix, "menu" => "personal", "title" => "Personal Information", "conf" => $conf, "user" => Auth::user()]);
    }

    public function index($url=null) {
        $conf = Conference::where('url', $this->prefix)->first();
        $user = Auth::user();
        return view('edit', ["prefix" => $this->prefix, "menu" => "personal", "title" => "Personal Information", "conf" => $conf, "user" => $user]);
    }


}
