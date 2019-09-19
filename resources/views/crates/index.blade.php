@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste des cageots</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('crates.create') }}"> Créer un cageot</a>
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
            <th width="280px">Action</th>
        </tr>
        @foreach ($crates as $crate)
        <tr>
            <td>{{ $crate->id }}</td>
            <td>{{ $crate->reference }}</td>
            <td>
                <form action="{{ route('crates.destroy',$crate->id) }}" method="POST">

                    <a class="btn btn-primary" href="{{ route('crates.edit',$crate->id) }}">Modifier</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>


@endsection
