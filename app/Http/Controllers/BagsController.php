<?php

namespace App\Http\Controllers;

use App\Bag;
use App\Role;
use Illuminate\Http\Request;
use App\UserSubscription;
use Illuminate\Http\Response;

class BagsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRole(Role::adminRole());

        $bags = Bag::all()->all();
        $clients = UserSubscription::all()->all();

        return view('bags.index',[
            "bags"=>$bags,
            "subscriptions"=>$clients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('bags.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'reference' => 'required',
        ]);

        Bag::create($request->all());

        return redirect()->route('bags.index')
                        ->with('success','Le sac a été créé avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bag  $bag
     * @return Response
     */
    public function edit(Bag $bag)
    {
        $clients = UserSubscription::all()->all();

        return view('bags.edit',[
            "bag"=>$bag,
            "subscriptions"=>$clients
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Bag  $bag
     * @return Response
     */
    public function update(Request $request, Bag $bag)
    {
        $request->validate([
            'reference' => 'required',
            'client_subscription_id' => 'required',
        ]);

        // Find the bag to update.
        $database_bag = Bag::all()->find($bag->id);

        // Change the reference.
        $database_bag->reference = $request['reference'];


        // Change the user subscription.
        if ($request['client_subscription_id'] == -1) {

            $database_bag->user_subscription_id = null;
        } else {
            $client_subscription = UserSubscription::all()->find($request['client_subscription_id']);

            $database_bag->userSubscription()->associate($client_subscription);
        }

        // Persist.
        $database_bag->save();


        return redirect()->route('bags.index')
                        ->with('success','Le sac a été mis a jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Bag $bag
     * @return Response
     * @throws \Exception
     */
    public function destroy(Bag $bag)
    {
        $bag->delete();

        return redirect()->route('bags.index')
                        ->with('success','Le sac a été supprimé avec succès');
    }
}
