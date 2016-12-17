<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
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

    protected function editValidator(array $data) {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'url' => 'required|max:20',
            'open' => 'required|date',
            'close' => 'required|date',
            'paper_deadline' => 'required|date',
            'acceptance' => 'required|date',
            'camera_deadline' => 'required|date',
            'pre_regis' => 'required|date',
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
        return view('admin.page.create', ["title" => "Create Conference", "menu" => "add"]);
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
        $conf = Conference::find($id);
        return view('admin.page.show', ["title" => $conf->name, "menu" => "home", "conf" => $conf]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $conf = Conference::find($id);
        return view('admin.page.edit', ["title" => "Edit " . $conf->name, "menu" => "home", "conf" => $conf]);
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
        $conf = Conference::find($id);
        $data = $request->all();
        $validator = $this->editValidator($data);
        if ($validator->fails()) {
            return redirect()->back()->with(["title" => "Edit " . $conf->name, "menu" => "home", "conf" => $conf])->withInput($data)->withErrors($validator);
        }

        $conf->update($data);
        return redirect('/admin')->with(['success' => 'Success!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Conference::find($id)->delete();
        return redirect('/admin')->with(['success' => 'Delete Success!']);
    }
}
