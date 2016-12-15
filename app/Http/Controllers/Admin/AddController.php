<?php

namespace App\Http\Controllers\Admin;

use App\Model\Conference;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AddController extends Controller
{

    /**
     * AddController constructor.
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth:admin');
    }

    protected function validator(array $data) {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'url' => 'required|max:20',
        ]);
    }

    public function submit(Request $request) {
        $data = $request->all();

        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->back()->with(["title" => "Add Conference", "menu" => "add"])->withInput($data)->withErrors($validator);
        }

        $conf = new Conference();
        $conf->fill($data);
        $conf->save();

        return redirect('/admin')->with(['success' => 'Success!']);
    }

    public function index() {
        return view('admin.page.add', ["title" => "Add Conference", "menu" => "add"]);
    }
}
