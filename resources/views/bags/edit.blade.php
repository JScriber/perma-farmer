@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modifier mon sac</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('bags.index') }}"> Retour</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Attention</strong> Il y a un problème avec vos champs.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bags.update',$bag->id) }}" method="POST">
        @csrf
        @method('PUT')

         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Reference:</strong>
                    <input type="text" name="reference" value="{{ $bag->reference }}" class="form-control" placeholder="reference">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <select class="form-control" name="client_subscription_id" placeholder="numéro client">
                    <option value="-1" {{$bag->userSubscription == null ? 'selected' : '' }}>aucun</option>

                    @foreach ($subscriptions as $subscription)
                        <option value="{{$subscription->id}}" <?php

                            if ($bag->userSubscription != null) {
                                if ($bag->userSubscription->id == $subscription->id) {
                                    echo 'selected';
                                }
                            }
                        ?>>
                        {{ $subscription->user->firstname . " " . $subscription->user->lastname }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Valider</button>
            </div>
        </div>
    </form>
</div>
@endsection
