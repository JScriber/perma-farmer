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
            <th>client</th>
            <th>Type de pannier</th>
            <th>Résumé</th>
            <th width="280px">Action</th>
        </tr>
        
        @foreach ($orders as $order)
        <tr>
            <td>{{ $order["firstname"]." ".$order["lastname"] }}</td>
            <td>{{ $order["basket"] }}</td>
            <td>
                <ul>
                @foreach ($order["products"] as $product)
                    <li>{{ $product["num"]." ".$product["label"] }}</li>
                @endforeach        
                </ul>
            </td>
            <td>
                <form action="{{ route('orderValidate',['id'=>$order['id']]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Valider</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>


@endsection
