@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modifier un produit</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('stock') }}"> Retour</a>
            </div>
        </div>
    </div>
    <form action="{{ route('validStockEdit')}}" method="get" class="form-example">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">

                    <label for="nom"><strong>Nom</strong></label>
                    <input type="text" value="{{ $product->name }}" name="nom" class="form-control" id="nom" required>
                    <br/>
                    <label for="quantite"><strong>Quantité</strong></label>
                    <input type="number" value="{{ $product->quantity }}" name="quantite" id="quantite" class="form-control" min="0" required>
                    <br/>
                    <label for="poids"><strong>Poids à l'unité</strong></label>
                    <input type="number" value="{{ $product->weight }}" name="poids" id="poids" class="form-control" min="0" required>

                    <input type="hidden" value="{{ $product->id }}" name="id" id="id" required>
                    <br/>

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary" value="Modifier">Valider</button>
            </div>
        </div>
    </form>
</div>
@endsection
