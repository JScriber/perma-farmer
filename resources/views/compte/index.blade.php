@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Mon Compte') }}</div>
                <div class="card-body">
                        <h4>Prénom : {{$user->firstname}}</h4>
                        <p>Nom : {{$user->lastname}}</p>
                        <p>E-mail : {{$user->email}}</p>
                        <p>Mot de passe : </p><input type="password" value="{{$user->password}}" disabled >
                        <p>Moyen de paiement </p>
                            <p>Propriétaire : {{$user->creditCard->owner}}</p>
                            <p>Type : {{$user->creditCard->type}}</p>
                            <p>Numéro de carte : {{$user->creditCard->card_number}}</p>
                            <p>Numéro secret : {{$user->creditCard->crypto}}</p>
                            <p>Date expiration : {{$user->creditCard->expiration_date}}</p>
                            <p>Formule : {{$user->userSubscriptions[0]->subscription->name}}</p>
                            <p>{{$user->userSubscriptions[0]->subscription->max_weight}} kg</p>
                            <p>{{$user->userSubscriptions[0]->subscription->price}} €</p>
                </div>
                <div class="card-footer">
                    <div class="pull-right">
                     <a class="btn btn-success" href="{{ route('compte.edit', $user->id) }}">Modifier mes informations</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
