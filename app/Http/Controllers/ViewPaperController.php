<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ViewPaperController extends Controller
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

    public function getPaper($url, $user_id, $file) {
        if (Auth::user()->role == 1 && Auth::user()->id != $user_id) {
            return abort(403, 'Unauthorized action.');
        }
        return response(Storage::disk('local')->get($url.'/'.$user_id.'/'.$file), 200, ['Content-Type' => 'application/pdf']);
    }
}
