@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Commandes en attente</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('orderSend') }}"> Livraison</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif




@endsection
