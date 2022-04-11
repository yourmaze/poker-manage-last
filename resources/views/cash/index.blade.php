@extends('layouts.dashboard', ['title' => 'Кэш игры'])

@section('content')

    @include('include.alert')

    <div class="uk-grid">

        <div class="uk-width-1-1 uk-flex uk-flex-between uk-margin-bottom">
            <ul class="uk-breadcrumb">
                <li><a href="{{ route('home') }}">Главная</a></li>
                <li><span>Кэш игры</span></li>
            </ul>
        </div>

        <div class="uk-width-1-1">
            <div class="uk-margin-bottom uk-flex uk-flex-right uk-flex-wrap uk-flex-middle">
                <a href="{{ route('cash.create') }}" class="uk-button uk-button-primary ripple">Новая кэш игра</a>
            </div>
        </div>

        <div class="uk-width-1-1 uk-overflow-auto">
            <div class="uk-child-width-1-4@xl uk-child-width-1-3@l uk-grid-match" uk-grid>
                @foreach($cashGameResources as $cashGame)
                <div class="card-element">
                    <div class="uk-card uk-card-primary uk-card-body uk-card-button">
                        <div class="card-date uk-margin-medium-bottom">
                            <div class="card-date__month">{{date('M', strtotime($cashGame['created_at']))}}</div>
                            <div class="card-date__date">{{date('j', strtotime($cashGame['created_at']))}}</div>
                        </div>
                        <div class="uk-grid-match" uk-grid>
                            <div>
                                <div class="card-small-title">Игроков</div>
                                <div class="card-small-value">{{$cashGame['players_amount']}}</div>
                            </div>
                            <div>
                                <div class="card-small-title">Рейк</div>
                                <div class="card-small-value">{{number_format($cashGame['rake'])}}&#8381;</div>
                            </div>
                            <div class="uk-margin-top">
                                <div class="card-small-title">Игровая сессия</div>
                                <div class="card-small-value">@if($cashGame['gameSession']) {{$cashGame['gameSession']}} часов @else В процессе @endif</div>
                            </div>
                        </div>
                        <ul class="uk-position-top-right uk-margin-top uk-margin-right uk-iconnav uk-flex-center">
                            <li>
                                <a href="{{ route('t-board', $cashGame['id'] ) }}" target="_blank" uk-tooltip="Информация" class="uk-icon" uk-icon="desktop"></a>
                            </li>
                            <li>
                                <a href="{{ route('cash.manage', $cashGame['id'] ) }}" uk-tooltip="Управление" class="uk-icon" uk-icon="cog"></a>
                            </li>
                            <li>
                                <a class="confirm-delete-item uk-icon" data-id="{{ $cashGame['id'] }}" href="#" uk-tooltip="Удалить" uk-icon="trash"></a>
                            </li>
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    @include('include.delete', ['route' => 'cash.destroy', 'selectorDestroy' => '.card-element'])

@endsection
