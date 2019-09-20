@extends('layouts.app')

@section('content')
<div class="container">
    <div class="logo-image"></div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" id="register_card">
                <div class="register_title">{{ __('S\'inscrire') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname') }}" required autofocus>

                                <span class="invalid-feedback regular-character" role="alert" style="display: none;">
                                    <strong>Veuillez ne pas utiliser de caractères spéciaux.</strong>
                                </span>

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

                                <span class="invalid-feedback regular-character" role="alert" style="display: none;">
                                    <strong>Veuillez ne pas utiliser de caractères spéciaux.</strong>
                                </span>

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
                                <input id="password" type="password" minlength="6" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

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
                                <span class="invalid-feedback" role="alert" style="display: none;">
                                    <strong>Les mots de passe ne correspondent pas.</strong>
                                </span>
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

                                <span class="invalid-feedback min-size" role="alert" style="display: none;">
                                    <strong>16 caractères sont attendus. Ne pas mettre d'espace.</strong>
                                </span>

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

                                <span class="invalid-feedback min-size" role="alert" style="display: none;">
                                    <strong>Saisir le code à trois chiffres.</strong>
                                </span>

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
                                <button type="submit" class="btn btn-primary" id="register_btn">
                                    {{ __('Valider mes informations') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

        /** Adds the password rule. */
        function passwordRule() {
            const password = document.getElementById('password');
            const passwordConfirm = document.getElementById('password-confirm');

            function checkPassword() {
                const passwordValue = password.value;

                const errorMessage = passwordConfirm.parentNode.querySelector('.invalid-feedback');

                if (passwordConfirm.value === passwordValue || passwordConfirm.value === '') {
                    errorMessage.style.display = 'none';
                } else {
                    errorMessage.style.display = 'block';
                }
            }

            password.addEventListener('keyup', checkPassword);
            passwordConfirm.addEventListener('keyup', checkPassword);
        }

        /** Set min date. */
        function setMinDate() {
            let today = new Date();
            let dd = today.getDate();
            let mm = today.getMonth() + 1;
            let yyyy = today.getFullYear();

            if (dd < 10) dd = '0' + dd;
            if (mm < 10) mm = '0' + mm;

            today = yyyy + '-' + mm + '-' + dd;

            document.getElementById('card_expiration_date').setAttribute('min', today);
        }

        /** Apply min size validation. */
        function minSize(input, maxLength) {
            const errorMessage = input.parentNode.querySelector('.min-size');
            const length = input.value.length;

            if (length > 0 && length < maxLength || length > maxLength) {
                errorMessage.style.display = 'block';
            } else {
                errorMessage.style.display = 'none';
            }
        }

        function useRegularCharacter() {
            const errorMessage = this.parentNode.querySelector('.regular-character');

            if (errorMessage && this.value.length > 0) {
                const regex = /^[a-zA-Z0-9ç\- ]+$/;

                if (regex.test(this.value)) {
                    errorMessage.style.display = 'none';
                } else {
                    errorMessage.style.display = 'block';
                }
            }
        }

        // Window loading.
        window.addEventListener('load', function() {
            passwordRule();
            setMinDate();

            // Attach event.
            document.getElementById('card_number').addEventListener('keyup', function() {
                minSize(this, 16);
            });

            // Attach event.
            document.getElementById('card_crypto').addEventListener('keyup', function() {
                minSize(this, 3);
            });

            document.getElementById('lastname').addEventListener('keyup', useRegularCharacter);
            document.getElementById('firstname').addEventListener('keyup', useRegularCharacter);
        });
    </script>
</div>
@endsection
