<?php

namespace App\Http\Controllers;

use App\User;
use App\CreditCard;
use App\Subscription;
use App\UserSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
            'owner'=>'required',
            'type'=>'required',
            'card_number'=>'required',
            'crypto'=>'required',
            'expiration_date'=>'required'
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
            'cards' => [
                'MasterCard',
                'Visa',
                'American Express'
            ]
        ], compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $request->validate([
            'id'=>'required',
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required',
            'card_owner'=>'required',
            'card_type'=>'required',
            'card_number'=>'required',
            'card_crypto'=>'required',
            'card_expiration'=>'required',
            'subscription'=>'required'
        ]);


        $user = User::find($request->id);

        $newPassword = null;
        if(($request->password == $request->password_confirm)){
            $newPassword=$request->password;
        }

        if($newPassword != null){
            $user->update([
                "password"=>Hash::make($newPassword)
            ]);
        }

        $user->update([
            "firstname"=>$request->firstname,
            "lastname"=>$request->lastname,
            "email"=>$request->email
        ]);

        $user->creditCard->update([
            "owner"=>$request->card_owner,
            "type"=>$request->card_type,
            "card_number"=>$request->card_number,
            "crypto"=>$request->card_crypto,
            "expiration_date"=>$request->card_expiration
        ]);

        $subscription = Subscription::find(intval($request->subscription));


        if ($subscription != null)
        {
            $user->userSubscriptions[0]->subscription()->associate($subscription);
            $user->userSubscriptions[0]->save();
        }

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
