<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Conference;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request, $conf) {
        $conf = Conference::find($conf);
        return view('admin.page.users.home', ["title" => "Home", "menu" => "home", "conf" => $conf]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($conf)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $conf)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($conf, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($conf, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $conf, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($conf, $id)
    {
        User::find($id)->delete();
        return redirect('/admin/'.$conf.'/user')->with(['success' => "Delete Success!"]);
    }

    public function setRole($conf, $id, Request $request) {
        $user = User::find($id);
        $user->role = $request->input('role');
        $user->save();
        if ($request->input('role') == 1) {
            $role = "Author";
        } elseif ($request->input('role') == 2) {
            $role = "Reviewer";
        } elseif ($request->input('role') == 3) {
            $role = "TPC";
        }

        return redirect('/admin/'.$conf.'/user')->with(['success' => "Make ". $role ." Success!"]);
    }
}
