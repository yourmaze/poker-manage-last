@extends('layouts.dashboard', ['title' => 'Главная'])

@section('content')
    @include('include.alert')
    <div class="uk-grid">

        <div class="uk-width-1-1">
            @role('main-administrator', 'administrator')
            <div id="app">
            </div>
            @endrole
        </div>
    </div>
    @role('main-administrator', 'administrator')
    <script src="{{ asset('js/charts.js') }}"></script>
    @endrole
@endsection
