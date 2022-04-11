@extends('layouts.dashboard')

@section('content')

    <script type="text/javascript">
        window.Laravel = {
            csrfToken: "{{ csrf_token() }}",
            user: {!! auth()->check()?auth()->user():"null" !!}
        }
    </script>

    <div class="uk-grid">

        <div class="uk-width-1-1">
            <div id="mute"></div>
            <div id="app">
                <router-view></router-view>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/dealer-crud.js') }}"></script>
    <link href="{{ asset('css/vuetify.min.css') }}" rel="stylesheet">
@endsection
