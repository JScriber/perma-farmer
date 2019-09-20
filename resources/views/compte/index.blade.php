@extends('layouts.app')

@section('content')

<div class="container">
    <div class="logo-image"></div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-compte">
                <div class="compte-header">{{ __('Mon Compte') }}</div>
                <div class="card-body compte-card">
                    <p><h3>Identité: </h3></p>

                        <p> Prénom : {{$user->firstname}}</p>
                        <p> Nom : {{$user->lastname}}</p>

                        <br />

                    <p><h3>Compte: </h3></p>

                        <p> E-mail : {{$user->email}}</p>
                        <p> Mot de passe : <input type="password" value="{{$user->password}}" disabled > </p>

                        <br />
                        <p><h3>Moyen de paiement: </h3></p>
                            <p> Propriétaire : {{$user->creditCard->owner}}</p>
                            <p> Type : {{$user->creditCard->type}}</p>
                            <p> Numéro de carte : {{$user->creditCard->card_number}}</p>
                            <p> Cryptogramme : {{$user->creditCard->crypto}}</p>
                            <p> Date expiration : {{$user->creditCard->expiration_date}}</p>
                            <br />
                            <p><h3>Formule :</h3></p>
                            <p> {{$user->userSubscriptions[0]->subscription->name}}</p>
                            <p> {{$user->userSubscriptions[0]->subscription->max_weight}} g</p>
                            <p> {{$user->userSubscriptions[0]->subscription->price}} €</p>
                </div>
                <div>
                    <div class="btn-ok ok-compte-container">
                     <a class="btn btn-outline-success ok-compte" href="{{ route('compte.edit', $user->id) }}">Modifier mes informations</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
