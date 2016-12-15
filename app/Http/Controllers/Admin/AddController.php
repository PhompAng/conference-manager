<?php

namespace App\Http\Controllers\Admin;

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

    public function index() {
        return view('admin.page.add', ["title" => "Add Conference", "menu" => "add"]);
    }
}
