<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth:admin');
    }

    public function index() {
        return view('admin.home', ["title" => "Home"]);
    }
}
