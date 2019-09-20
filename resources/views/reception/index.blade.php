@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Réceptions en attente</h2>
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
            <th>Client</th>
            <th>Résumé</th>
            <th>Type de panier</th>
            <th width="280px">Action</th>
        </tr>

        @foreach ($baskets as $basket)
            <tr>
                <td>{{ $basket->userSubscription->user->firstname ." ". $basket->userSubscription->user->firstname }}</td>
                <td>
                    <ul>
                        @foreach ($basket->basketProducts as $basketProduct)
                            <li>
                                {{ $basketProduct->quantity . " " . $basketProduct->product->name }}
                            </li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    {{ $basket->userSubscription->subscription->name }}
                </td>
                <td>
                    <form action="{{ route('receptionSend',['id'=> $basket->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Livrer</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
