<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Crate;

class CrateController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRole(Role::adminRole());
        $crate = Crate::all()->all();
        return view('crates.index',[
            "crates"=>$crate
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'reference' => 'required',
        ]);

        Crate::create($request->all());

        return redirect()->route('crates.index')
                        ->with('success','Le cageot a été créé avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Crate $crate)
    {
        return view('crates.edit',[
            "crate"=>$crate ,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Crate $crate)
    {
        $request->validate([
            'reference' => 'required'
        ]);
        $crate->update($request->all());

        return redirect()->route('crates.index')
                        ->with('success','Le cageot a été mis a jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Crate $crate)
    {
        $crate->delete();

        return redirect()->route('crates.index')
                        ->with('success','Le cageot a été supprimé avec succès');
    }
}
