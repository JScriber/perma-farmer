@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Commandes en attente de validation</h2>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if (sizeof($orders) > 0)
        <table class="table table-bordered">
            <tr>
                <th>Client</th>
                <th>Résumé</th>
                <th>Type de panier</th>
                <th width="280px">Action</th>
            </tr>

            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order["firstname"]." ".$order["lastname"] }}</td>
                    <td>
                        <ul>
                            @foreach ($order["products"] as $product)
                                <li>{{ $product["num"]." ".$product["label"] }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $order["basket"] }}</td>
                    <td>
                        <form action="{{ route('orderValidate',['id'=>$order['id']]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Valider</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <p>Aucune commande en attente de validation.</p>
    @endif
@endsection
