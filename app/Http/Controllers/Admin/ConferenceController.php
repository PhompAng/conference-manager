<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Conference;
use Illuminate\Support\Facades\Validator;

class ConferenceController extends Controller
{
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $confs = Conference::all();
        return view('admin.page.home', ["title" => "Home", "menu" => "home", "confs" => $confs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.add', ["title" => "Add Conference", "menu" => "add"]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
