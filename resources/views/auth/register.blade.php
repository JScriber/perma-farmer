@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname') }}" required autofocus>

                                @if ($errors->has('lastname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('Prénom') }}</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ old('firstname') }}" required autofocus>

                                @if ($errors->has('firstname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adresse mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmer le mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="account_type" class="col-md-4 col-form-label text-md-right">{{ __('Type de compte') }}</label>

                            <div class="col-md-6">
                                <div class="radio">
                                    <input type="radio" id="simple" name="account_type" class="{{ $errors->has('account_type') ? ' is-invalid' : '' }}" value="simple" checked>
                                    <label for="simple">Compte simple</label>
                                </div>

                                <div class="radio">
                                    <input type="radio" id="pro" name="account_type" class="{{ $errors->has('account_type') ? ' is-invalid' : '' }}" value="pro">
                                    <label for="pro">Compte professionnel</label>
                                </div>

                                @if ($errors->has('account_type'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('account_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="subscription" class="col-md-4 col-form-label text-md-right">{{ __('Abonnement') }}</label>

                            <div class="col-md-6">
                                <select name="subscription" class="form-control">
                                    @foreach($subscriptions as $subscription)
                                        <option value='{{ $subscription->id }}' {{ old('subscription') == $subscription->id ? 'selected' : '' }}>
                                            {{ $subscription->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <hr/>

                        <p>Moyen de paiement</p>

                        <div class="form-group row">
                            <label for="card_owner" class="col-md-4 col-form-label text-md-right">{{ __('Propriétaire') }}</label>

                            <div class="col-md-6">
                                <input id="card_owner" type="text" class="form-control{{ $errors->has('card_owner') ? ' is-invalid' : '' }}" name="card_owner" value="{{ old('card_owner') }}" required>

                                @if ($errors->has('card_owner'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('card_owner') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="card_type" class="col-md-4 col-form-label text-md-right">{{ __('Moyen de paiement') }}</label>

                            <div class="col-md-6">
                                <select name="card_type" class="form-control">
                                    @foreach($cards as $card)
                                        <option value='{{ $card }}' {{ old('card_type') == $card ? 'selected' : '' }}>
                                            {{ $card }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="card_number" class="col-md-4 col-form-label text-md-right">{{ __('Numéro de carte') }}</label>

                            <div class="col-md-6">
                                <input id="card_number" type="text" class="form-control{{ $errors->has('card_number') ? ' is-invalid' : '' }}" name="card_number" value="{{ old('card_number') }}" required>

                                @if ($errors->has('card_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('card_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="card_crypto" class="col-md-4 col-form-label text-md-right">{{ __('Numéro secret') }}</label>

                            <div class="col-md-6">
                                <input id="card_crypto" type="text" class="form-control{{ $errors->has('card_crypto') ? ' is-invalid' : '' }}" name="card_crypto" value="{{ old('card_crypto') }}" required>

                                @if ($errors->has('card_crypto'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('card_crypto') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="card_expiration_date" class="col-md-4 col-form-label text-md-right">{{ __('Date d\'expiration') }}</label>

                            <div class="col-md-6">
                                <input id="card_expiration_date" type="date" class="form-control{{ $errors->has('card_expiration_date') ? ' is-invalid' : '' }}" name="card_expiration_date" value="{{ old('card_expiration_date') }}" required>

                                @if ($errors->has('card_expiration_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('card_expiration_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('S\'inscrire') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
