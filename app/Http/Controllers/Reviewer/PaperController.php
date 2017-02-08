<?php

namespace App\Http\Controllers\Reviewer;

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

    public function getPaper($url, $user_id, $file) {
        return response(Storage::disk('local')->get($url.'/'.$user_id.'/'.$file), 200, ['Content-Type' => 'application/pdf']);
    }
}
