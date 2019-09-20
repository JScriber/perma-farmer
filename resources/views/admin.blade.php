@extends('layouts.app')

@section('content')
            <div class="content">
                <div class="title m-b-md">
                    ADMIN
                </div>
                <a class="btn btn-outline-primary btn" href="{{ route('stock') }}">{{ __('Stock') }}</a>
                <a class="btn btn-outline-primary btn" href="{{ route('bags.index') }}">{{ __('Sacs') }}</a>
                <a class="btn btn-outline-primary btn" href="{{ route('order') }}">{{ __('Commande') }}</a>
                <a class="btn btn-outline-primary btn" href="{{ route('reception') }}">{{ __('Reception') }}</a>
            </div>
        </div>
@endsection


