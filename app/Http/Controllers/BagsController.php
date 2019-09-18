<?php

namespace App\Http\Controllers;

use App\Bag;
use Illuminate\Http\Request;
use App\UserSubscription;

class BagsController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Bag $bag)
    {
        $bags = Bag::latest()->paginate(5);
        $clients = UserSubscription::all()->all();
        return view('bags.index',[
            "bags"=>$bags,
            "subscriptions"=>$clients
        ])->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bags.create');
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
            'reference' => 'required',
        ]);

        Bag::create($request->all());

        return redirect()->route('bags.index')
                        ->with('success','Le sac a été créer avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bag  $bag
     * @return \Illuminate\Http\Response
     */
    public function edit(Bag $bag)
    {
        $clients = UserSubscription::all()->all();
        return view('bags.edit',[
            "bag"=>$bag,
            "subscriptions"=>$clients
        ]);
        // return view('bags.edit',compact('bag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bag  $bag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bag $bag)
    {
        $request->validate([
            'reference' => 'required',
            'client_subscription_id' => 'required',
        ]);


        if ($request['client_subscription_id'] == -1) {
            $database_bag = App\Bag::all()->find($bag->id);

            $client = $database_bag->client;
        }





        //recupéré user
        $bag->update($request->all());

        return redirect()->route('bags.index')
                        ->with('success','Le sac a été mis a jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bag  $bag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bag $bag)
    {
        $bag->delete();

        return redirect()->route('bags.index')
                        ->with('success','Le sac a été supprimer avec succès');
    }
}
