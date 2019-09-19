@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Ajouter un produit</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('stock') }}"> Retour</a>
        </div>
    </div>
</div>

<form action="{{ route('validStockAdd')}}" method="get">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="nom"><strong>Nom</strong></label>
                <input type="text" name="nom" id="nom" class="form-control" required>
                <br/>
                <label for="quantite"><strong>Quantité</strong></label>
                <input type="number" name="quantite" id="quantite" class="form-control" min="0"  required>
                <br />
                <label for="poids"><strong>Poids à l'unité</strong></label>
                <input type="number" name="poids" id="poids" class="form-control"  min="0" required>
                <br />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary" value="Ajouter">Valider</button>
            </div>
        </div>
    </div>
</form>
@endsection
