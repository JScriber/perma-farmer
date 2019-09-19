@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Gestion des produits</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('stockAdd') }}">Ajouter</a>
            </div>
        </div>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>Nom</th>
            <th>Quantite</th>
            <th>Poids (g)</th>
            <th>Action</th>
        </tr>
        <tr>
        @foreach($stock as $product)
          <tr>
            <td>{{ $product['name'] }}</td>
            <td>{{ $product['quantity'] }}</td>
            <td>{{ $product['weight'] }}</td>
            <td>
                <a class="btn btn-primary" href="{{ route('stockEdit',['id' => $product->id]) }}">Modifier</a>
                <a class="btn btn-danger" href="{{ route('stockDelete',['id' => $product->id]) }}">Supprimer</a>
            </td>
          </tr>
        @endforeach
        </tr>
    </table>
    {!! $stock->links() !!}
@endsection
