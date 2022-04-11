@extends('layouts.dashboard', ['title' => 'Мои турниры'])

@section('content')

    @include('include.alert')

    <div class="uk-grid">

        <div class="uk-width-1-1 uk-flex uk-flex-between uk-margin-bottom">
            <ul class="uk-breadcrumb">
                <li><a href="{{ route('home') }}">Главная</a></li>
                <li><span>Турниры</span></li>
            </ul>
        </div>

        <div class="uk-width-1-1">
            <div class="uk-flex uk-flex-right uk-flex-wrap uk-flex-middle">
                <a href="{{ route('tournament.create') }}" class="uk-button uk-button-primary ripple">Новый турнир</a>
            </div>
        </div>

        <div class="uk-width-1-1 uk-overflow-auto">
            <div class="tournament-list uk-child-width-1-2@m uk-grid-match" uk-grid>
                @foreach($tournaments as $tournament)
                    <div class="card-element">
                        <div class="uk-card uk-card-primary uk-card-body uk-card-button @if($tournament->end_at) uk-opacity-medium @endif">
                            <a href="{{ route('tournament.manage', $tournament->id ) }}">
                                <div class="uk-width-4-5@l">
                                    <div class="uk-flex uk-flex-middle uk-margin-large-bottom">
                                        <div>
                                            <div class="card-date">
                                                <div></div>
                                                <div class="card-date__month">{{ \Carbon\Carbon::parse($tournament->created_at)->shortMonthName }}</div>
                                                <div class="card-date__date">{{date('j', strtotime($tournament->created_at))}}</div>
                                            </div>
                                        </div>
                                        <div>
                                            <h3 class="uk-margin-remove">{{ $tournament->name }}</h3>
                                            @if($tournament->end_at)
                                                <span class="uk-label uk-empty uk-margin-small-top">Закончен</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-grid-gap-medium" uk-grid>
                                    <div>
                                        <div class="card-small-title">Игроков</div>
                                        <div class="card-small-value">{{$tournament->total_players}}</div>
                                    </div>
                                    <div>
                                        <div class="card-small-title">Ребаев</div>
                                        <div class="card-small-value">{{ $tournament->rebuys }}</div>
                                    </div>
                                    <div>
                                        <div class="card-small-title">Аддонов</div>
                                        <div class="card-small-value">{{ $tournament->addons }}</div>
                                    </div>
                                </div>
                            </a>
                            <ul class="uk-position-top-right remove-absolute-on-mobile uk-margin-top uk-margin-right uk-iconnav uk-flex-center">
                                <li class="@if($tournament->end_at) uk-hidden @endif">
                                    <a href="{{ route('t-board', $tournament->id ) }}" target="_blank" uk-tooltip="Турнирный борд" class="uk-icon"> <i class="fal fa-tv fa-lg"></i> </a>
                                </li>
                                <li>
                                    <a href="{{ route('tournament.manage', $tournament->id ) }}" uk-tooltip="Управление турниром" class="uk-icon"><i class="fal fa-cog fa-lg"></i></a>
                                </li>
                                <li class="@if($tournament->end_at) uk-hidden @endif">
                                    <a href="{{ route('tournament.edit', $tournament->id ) }}" uk-tooltip="Редактирование турнира" class="uk-icon"><i class="fal fa-edit fa-lg"></i></a>
                                </li>
                                <li>
                                    <a class="confirm-delete-item uk-icon" data-id="{{ $tournament->id }}" href="#" uk-tooltip="Удалить турнир"><i class="fal fa-trash-alt fa-lg"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @include('include.delete', ['route' => 'tournament.destroy', 'selectorDestroy' => '.card-element'])

@endsection
