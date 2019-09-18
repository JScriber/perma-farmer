@extends('layouts.bag')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Description du sac</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('bags.index') }}"> Retour</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Reference:</strong>
                {{ $bag->reference }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Numéro client:</strong>
                {{ $bag->client_subscription_id }}
            </div>
        </div>
    </div>
@endsection
