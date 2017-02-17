<?php

namespace App\Http\Controllers\Reviewer;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    protected $prefix = "/";

    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->prefix = $request->segment(1);
    }

    public function makeTPC($conf, $id) {
        $user = User::find($id);
        $user->role = 3;
        $user->save();

        return redirect()->back()->with(['success' => "Make TPC Success!"]);
    }

    public function removeTPC($conf, $id) {
        $user = User::find($id);
        $user->role = 2;
        $user->save();

        return redirect()->back()->with(['success' => "Remove TPC Success!"]);
    }
}
