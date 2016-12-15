<?php

namespace App\Http\Controllers\Admin;

use App\Model\Conference;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth:admin');
    }

    public function index() {
        $confs = Conference::all();
        return view('admin.page.home', ["title" => "Home", "menu" => "home", "confs" => $confs]);
    }
}
