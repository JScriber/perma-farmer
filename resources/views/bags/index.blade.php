@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste des sacs</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('bags.create') }}"> Créer un sac</a>
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
            <th>N°</th>
            <th>Références</th>
            <th>Nom du client</th>
            <th width="280px">Actions</th>
        </tr>
        @foreach ($bags as $bag)
        <tr>
            <td>{{ $bag->id }}</td>
            <td>{{ $bag->reference }}</td>
            @if(!isset($bag->UserSubscription->user))
            <td></td>
            @else
            <td>{{ $bag->UserSubscription->user->firstname .' '. $bag->UserSubscription->user->lastname }}</td>
            @endif

            <td>
                <form action="{{ route('bags.destroy',$bag->id) }}" method="POST">

                    <a class="btn btn-primary" href="{{ route('bags.edit',$bag->id) }}">Modifier</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
