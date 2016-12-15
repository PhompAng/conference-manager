<?php

namespace App\Http\Controllers\Admin;

use App\Model\Conference;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddController extends Controller
{

    /**
     * AddController constructor.
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth:admin');
    }

    public function submit(Request $request) {
        $data = $request->all();

        $conf = new Conference();
        $conf->fill($data);
        $conf->save();

        return redirect('/admin')->with(['success' => 'Success!']);
    }

    public function index() {
        return view('admin.page.add', ["title" => "Add Conference", "menu" => "add"]);
    }
}
