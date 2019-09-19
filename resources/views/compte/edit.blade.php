@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('compte.index') }}">Retour</a>
            </div>
                <div class="card-header">{{ __('Modifier son Compte') }}</div>
                <div class="card-body">
                <form action="{{ route('compte.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <h4>Prénom : </h4>
                                <input type="text" name="firstname" value="{{$user->firstname}}" class="form-control" placeholder="prénom">

                                <h4>Nom : </h4>
                                <input type="text" name="lastname" value="{{$user->lastname}}" class="form-control" placeholder="nom">

                                <h4>Email : </h4>
                                <input type="text" name="email" value="{{$user->email}}" class="form-control" placeholder="email">

                                <h4>Mot de passe : </h4>
                                <input type="text" name="password" value="{{$user->password}}" class="form-control" placeholder="Mot de passe">

                                <p>Moyen de paiement : </p>
                                <h4>Propiétaire : </h4>
                                <input type="text" name="owner" value="{{$user->creditCard->owner}}" class="form-control" placeholder="Propiétaire">

                                <h4>Type : </h4>
                                <input type="text" name="type" value="{{$user->creditCard->type}}" class="form-control" placeholder="Type">

                                <h4>Numéro de carte : </h4>
                                <input type="text" name="card_number" value="{{$user->creditCard->card_number}}" class="form-control" placeholder="Numéro de carte">

                                <h4>Numéro secret : </h4>
                                <input type="text" name="crypto" value="{{$user->creditCard->crypto}}" class="form-control" placeholder="Numéro secret">

                                <h4>Date expiration : </h4>
                                <input type="text" name="expiration_date" value="{{$user->creditCard->expiration_date}}" class="form-control" placeholder="Date expiration">

                                <h4>Formule : </h4>
                                    <select name="subscription" class="form-control">
                                    @foreach($subscriptions as $subscription)
                                        <option value='{{ $subscription->id }}' {{ old('subscription') == $subscription->id ? 'selected' : '' }}>
                                            {{ $subscription->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card-footer">
                <form action="{{ route('compte.update',$user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="pull-right">
                        <button type="submit" class="btn btn-success">Valider mes informations</button>
                    </div>
                </form>
                <form action="{{ route('compte.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer mon compte</button>
                </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
