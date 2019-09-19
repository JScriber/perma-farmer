<?php

namespace App\Http\Controllers;

use App\User;
use App\CreditCard;
use App\Subscription;
use App\UserSubscription;
use Illuminate\Http\Request;
use App\Role;

class CompteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRole(Role::clientRole());
        $subscriptions = Subscription::all()->all();

        return view('compte.index',[
            "user"=> $request->user(),
            "subscriptions"=> $subscriptions,
        ]);
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
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required',
            'password'=>'required',
            'creditCard->owner'=>'required',
            'creditCard->type'=>'required',
            'creditCard->card_number'=>'required',
            'creditCard->crypto'=>'required',
            'creditCard->expiration_date'=>'required'
        ]);

        User::create($request->all());

        return redirect()->route('compte.index')
                        ->with('success','Le compte a été créé avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, User $user, $id)
    {
        $user = User::find($id);
        $subscriptions = Subscription::all()->all();

        return view('compte.edit',[
            "user"=> $request->user(),
            "subscriptions"=> $subscriptions,
        ], compact('compte'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, $id)
    {
        $request->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required',
            'password'=>'required',
            'owner'=>'required',
            'type'=>'required',
            'card_number'=>'required',
            'crypto'=>'required',
            'expiration_date'=>'required'
        ]);

        User::find($id)->update($request->all());
        // $user = User::find($id);
        // $user->firstname =  $request->get('firstname');
        // $user->lastname = $request->get('lastname');
        // $user->email = $request->get('email');
        // $user->password = $request->get('password');
        // $user->creditCard->owner = $request->get('owner');
        // $user->creditCard->type = $request->get('type');
        // $user->creditCard->card_number = $request->get('card_number');
        // $user->creditCard->crypto = $request->get('crypto');
        // $user->creditCard->expiration_date = $request->get('expiration_date');
        // $user->save();
        // $user->update($request->all());

        return redirect()->route('compte.index')
        ->with('success', 'Compte mis à jour.');
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, $id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/')
        ->with('success', 'Compte supprimé avec succès.');
    }
}
