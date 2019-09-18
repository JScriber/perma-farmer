@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste de sac</h2>
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
            <th>Reference</th>
            <th>Nom client</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($bags as $bag)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $bag->reference }}</td>
            @if(!isset($bag->userSubscription->client))
            <td></td>
            @else
            <td>{{ $bag->userSubscription->client->firstname }}</td>
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

    {!! $bags->links() !!}

@endsection
