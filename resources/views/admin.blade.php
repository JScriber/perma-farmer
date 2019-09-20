@extends('layouts.app')

@section('content')
            <div class="content">
                <div class="logo-image admin-image"></div>
                <div class="list-link-admin">
                    <a class="btn btn-outline-success btn link-admin" href="{{ route('stock') }}">{{ __('Stock') }}</a>
                    <a class="btn btn-outline-success btn link-admin" href="{{ route('bags.index') }}">{{ __('Sacs') }}</a>
                    <a class="btn btn-outline-success btn link-admin" href="{{ route('order') }}">{{ __('Commande') }}</a>
                    <a class="btn btn-outline-success btn link-admin" href="{{ route('reception') }}">{{ __('Reception') }}</a>
                </div>
            </div>
        </div>
@endsection


