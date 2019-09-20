@extends('layouts.app')

@section('content')

<div class="container">
    <div class="logo-image"></div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-compte">
                <div class="compte-header">{{ __('Modifier son Compte') }}</div>
                <div class="card-body compte-card-edit">
                <form action="{{ route('compte.update', ['id'=> $user->id]) }}" method="POST">

                    <input type="hidden" id="id" name="id" value="{{ $user->id }}">

                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                            <h3>Identité: </h3>
                                <h5>Prénom : </h5>
                                <input type="text" name="firstname" id="firstname" value="{{$user->firstname}}" class="form-control" placeholder="prénom" required>

                                <h5>Nom : </h5>
                                <input type="text" name="lastname" id="lastname" value="{{$user->lastname}}" class="form-control" placeholder="nom" required>

                                <br />
                                <br />

                            <h3>Compte: </h3>
                                <h5>Email : </h5>
                                <input type="email" name="email" id="email" value="{{$user->email}}" class="form-control" placeholder="email" required>

                                <h5>Mot de passe : </h5>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe">

                                <h5>confirmer mot de passe : </h5>
                                <input type="password" name="password_confirm" id="password_confirm" class="form-control" placeholder="Mot de passe">

                            <br />
                            <br />
                            <h3>Moyen de paiement: </h3>
                                <h5>Propiétaire : </h5>
                                <input type="text" name="card_owner" id="card_owner" value="{{$user->creditCard->owner}}" class="form-control" placeholder="Propiétaire" required>

                                <h5>Type de carte : </h5>

                                <select name="card_type" class="form-control">
                                    @foreach($cards as $card)
                                        <option value='{{ $card }}' {{ $user->creditCard->type == $card ? 'selected' : '' }}>
                                            {{ $card }}
                                        </option>
                                    @endforeach
                                </select>


                                <h5>Numéro de carte : </h5>
                                <input type="text" name="card_number" id="card_number" value="{{$user->creditCard->card_number}}" class="form-control" placeholder="Numéro de carte" required>

                                <h5>Numéro secret : </h5>
                                <input type="text" name="card_crypto" id="card_crypto" value="{{$user->creditCard->crypto}}" class="form-control" placeholder="Numéro secret" required>

                                <h5>Date expiration : </h5>
                                <input type="date" name="card_expiration" id="card_expiration" value="{{$user->creditCard->expiration_date}}" class="form-control" placeholder="Date expiration" required>

                                <br />
                                <br />

                                <!-- à valider -->
                            <h3>Formule :</h3>
                                <select name="subscription" id="subscription" class="form-control">
                                    @foreach($subscriptions as $subscription)
                                        <option value='{{ $subscription->id }}' {{ $user->userSubscriptions[0]->subscription->id == $subscription->id ? 'selected' : '' }}>
                                            {{ $subscription->name }}
                                        </option>
                                    @endforeach
                                </select>


                                <br />
                                <br />
                            </div>
                        </div>
                    </div>

                    <div>

                        @csrf
                        @method('PUT')
                        <div class="pull-right btn-ok btn-compte-valid">
                            <button type="submit" class="btn btn-outline-success">Valider mes informations</button>
                        </div>
                </form>

                <form action="{{ route('compte.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-report btn-compte-delete">Supprimer mon compte</button>
                </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
