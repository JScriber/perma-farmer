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


    <table class="table table-bordered">
        <tr>
            <th>Résumé</th>
            <th>client</th>
            <th>Type de pannier</th>
            <th width="280px">Action</th>
        </tr>
        
    </table>


@endsection
