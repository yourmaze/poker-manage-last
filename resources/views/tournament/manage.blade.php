@extends('layouts.dashboard', ['title' => 'Управление турниром'])


@section('content')

    @include('include.alert')


    <div class="tournament-manage-page">

        <div id="tournament-id" class="uk-hidden" data-id="{{ $tournament->id }}"></div>

        <div class="uk-grid uk-flex-center">

            <div class="uk-width-1-1 uk-flex uk-flex-between uk-margin-bottom">
                <ul class="uk-breadcrumb">
                    <li><a href="{{ route('home') }}">Главная</a></li>
                    <li><a href="{{ route('tournament.index') }}">Турниры</a></li>
                    <li><span>{{ $tournament->name }}</span></li>
                </ul>
            </div>

            <div class="uk-width-1-1">
                <div class="uk-grid-small uk-grid-match" uk-grid>
                    <div class="uk-width-1-1">
                        <div class="manage-panel uk-card uk-card-primary uk-card-button uk-card-body uk-flex uk-flex-column uk-flex-between @if($tournament->end_at) uk-opacity-medium @endif">
                            <div class="uk-grid-small" uk-grid>
                                <div class="uk-width-2-5@l">
                                    <div class="uk-flex uk-flex-middle uk-margin-large-bottom">
                                        <div>
                                            <div class="card-date">
                                                <div class="card-date__month">{{ \Carbon\Carbon::parse($tournament->created_at)->shortMonthName }}</div>
                                                <div class="card-date__date">{{date('j', strtotime($tournament->created_at))}}</div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="uk-text-muted">Турнир</div>
                                            <h3 class="uk-margin-remove">
                                                {{ $tournament->name }}
                                            </h3>
                                            @if($tournament->end_at)
                                                <span class="uk-label uk-empty uk-margin-small-top">Закончен</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="tournament-info uk-grid-medium" uk-grid>
                                        <div class="uk-width-auto">
                                            <div class="card-small-title">Игроков</div>
                                            <div id="tournament-manage-players" class="card-small-value">{{ $tournament->total_players }}</div>
                                        </div>
                                        <div class="uk-width-auto">
                                            <div class="card-small-title">Ребаев</div>
                                            <div id="tournament-manage-rebuys" class="card-small-value">{{ $tournament->rebuys }}</div>
                                        </div>
                                        <div class="uk-width-auto">
                                            <div class="card-small-title">Аддонов</div>
                                            <div id="tournament-manage-addons" class="card-small-value">{{ $tournament->addons }}</div>
                                        </div>
                                        <div class="uk-width-auto">
                                            <div class="card-small-title">Общий приз</div>
                                            <div class="card-small-value">&#8381; <span id="tournament-manage-total-prize">{{ $tournament->total_price }}</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-width-1-5@l">
                                    <div class="manage-tournament-clock uk-grid-small uk-flex-center" uk-grid>
                                        <div id="clock" data-countdown="@php if(isset($tournament->timeBank)) echo $tournament->timeBank; else echo '00:00'; @endphp"></div>

                                        <div class="manage-tournament-clock__manage uk-width-1-1">
                                            <div class="uk-text-center uk-margin-bottom">Уровень <span id="tournament-manage-level">{{ $tournament->level }}</span></div>
                                            <ul class="uk-iconnav uk-flex-center @if($tournament->end_at) uk-hidden @endif">
                                                <li>
                                                    <a id="prev-level-start" href="{{ route('t-board', $tournament->id ) }}" target="_blank" uk-tooltip="Предыдущий уровень" class="uk-icon" uk-icon="icon: chevron-double-left; ratio: 2"></a>
                                                </li>
                                                <li>
                                                    <a data-id="{{ $tournament->id }}" href="#"
                                                       @if ($tournament->status == 'stop')
                                                       uk-tooltip="Начать турнир" class="tournament-start uk-icon {{$tournament->status}}" uk-icon="play-circle"
                                                       @else
                                                       uk-tooltip="Приостановить турнир" class="tournament-start uk-icon {{$tournament->status}}" uk-icon="ban"
                                                        @endif
                                                    ></a>
                                                </li>
                                                <li>
                                                    <a id="next-level-start" target="_blank" uk-tooltip="Следущий уровень" class="uk-icon" uk-icon="icon: chevron-double-right; ratio: 2"></a>
                                                </li>
                                            </ul>
                                            <div class="uk-text-center uk-margin-small-top @if($tournament->end_at) uk-hidden @endif">
                                                <a id="reload-level-time" class="uk-text-light" style="opacity: 0.6; text-decoration: underline">начать уровень сначала</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-width-2-5@l uk-margin-remove-top uk-flex-middle uk-flex uk-flex-wrap uk-flex-center">
                                    <div class="uk-width-1-1 uk-text-center uk-margin-small-bottom">
                                        <div id="calc-prize-pool" class="uk-button uk-button-default @if($tournament->end_at) uk-hidden @endif">Рассчитать призовой фонд</div>
                                    </div>
                                    <div class="uk-width-1-1 uk-text-center">
                                        <div id="group-debtors" class="uk-button uk-button-default @if($tournament->end_at) uk-hidden @endif">Вывести всех должников</div>
                                    </div>
                                    <div class="uk-width-1-1 uk-text-center">
                                        <form id="complete-tournament" method="POST" action="{{ route('tournament.complete') }}">
                                            @csrf
                                            <input type="text" name="id" class="uk-hidden" value="{{ $tournament->id }}"></input>
                                            <div id="complete-tournament-button" class="uk-button uk-button-default @if($tournament->end_at) uk-hidden @endif">Завершить турнир</div>
                                        </form>
                                    </div>
                                </div>
                                <ul class="uk-position-top-right uk-margin-top uk-margin-right uk-iconnav uk-flex-center">
                                    <li class="@if($tournament->end_at) uk-hidden @endif">
                                        <a id="show-logs" target="_blank" uk-tooltip="Лог турнира" class="uk-icon" uk-icon="server"></a>
                                    </li>
                                    <li class="@if($tournament->end_at) uk-hidden @endif">
                                        <a href="{{ route('t-board', $tournament->id ) }}" target="_blank" uk-tooltip="Турнирный борд" class="uk-icon" uk-icon="desktop"></a>
                                    </li>
                                    <li class="@if($tournament->end_at) uk-hidden @endif">
                                        <a href="{{ route('tournament.edit', $tournament->id ) }}" target="_blank" uk-tooltip="Редактировать" class="uk-icon" uk-icon="pencil"></a>
                                    </li>
                                    <li>
                                        <a href="{{ route('tournament.information', $tournament->id ) }}" target="_blank" uk-tooltip="Информация о турнире" class="uk-icon" uk-icon="file-text"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-1">
                        <div class="uk-grid-small uk-grid-match" uk-grid>
                            <div class="uk-width-1-3@m">
                                <div class="uk-card uk-card-hover uk-card-default uk-card-button">
                                    <div class="uk-card-header">
                                        <div class="uk-flex uk-flex-middle uk-flex-between">
                                            <h3 class="uk-card-title uk-margin-remove">Игроки</h3>
                                            <a id="openBuyIn" href="#" class="uk-button uk-button-default uk-button-small square-button add-player"><span class="uk-icon"><i class="fad fa-user-plus fa-lg"></i></span></a>
                                        </div>
                                    </div>
                                    <div class="players-list-scrollable">
                                        <table id="player-table" class="uk-table uk-table-middle uk-table-without-shadow uk-background-default">
                                            @foreach($new as $player)
                                                <tr class="@if($player['evaluate']) uk-opacity-large @endif">
                                                    <td>
                                                        <div class="uk-flex uk-flex-middle">
                                                            @if($player['name'])
                                                                <div class="uk-margin-small-right">
                                                                    <div class="uk-text-small">{{$player['name']}}</div>
                                                                </div>
                                                            @endif
                                                            @if($player['debtor'])
                                                                <span class="cursor-default uk-margin-small-right fa-icon" uk-tooltip="Неоплачено"><i class="fad fa-badge-dollar fa-lg"></i></span>
                                                            @endif
                                                            @if($player['bonus_stack'])
                                                                <span class="cursor-default" uk-tooltip="С бонусным стеком"><i class="fad fa-coins fa-lg"></i></span>
                                                            @endif
                                                        </div>
                                                        <div class="uk-text-muted uk-text-small uk-text">{{$player['created_at']}}</div>
                                                    </td>
                                                    <td class="uk-text-center">{{$player['amount']}}</td>
                                                    <td class="uk-text-right">
                                                        <ul class="uk-iconnav uk-flex-center">
                                                            <li><a class="print-player-check uk-icon" data-id="{{$player['id']}}" href="#" uk-tooltip="Напечатать чек"><i class="fad fa-print fa-lg"></i></a></li>
                                                            @if($player['evaluate'])
                                                                <li><a class="evaluate-player-button uk-icon" data-id="{{$player['id']}}" href="#" uk-tooltip="Вернуть игрока"><i class="fad fa-sign-in fa-lg"></i></a></li>
                                                            @else
                                                                <li><a class="evaluate-player-button uk-icon" data-id="{{$player['id']}}" href="#" uk-tooltip="Нажать, если игрок выбыл"><i class="fad fa-sign-out fa-lg"></i></a></li>
                                                            @endif
                                                            <li><a class="confirm-delete-item uk-icon" data-id="{{$player['id']}}" href="#" uk-tooltip="Удалить игрока"><i class="fad fa-trash fa-lg"></i></a></li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="uk-width-1-3@m">
                                <div class="uk-card uk-card-hover uk-card-default uk-card-button">
                                    <div class="uk-card-header">
                                        <div class="uk-flex uk-flex-middle uk-flex-between">
                                            <h3 class="uk-card-title uk-margin-remove">Ребай</h3>
                                            <a id="openRebuy" href="#" class="uk-button uk-button-default uk-button-small square-button add-player"><span class="uk-icon"><i class="fad fa-user-plus fa-lg"></i></span></a>
                                        </div>
                                    </div>
                                    <div class="players-list-scrollable">
                                        <table id="rebuy-table" class="uk-table uk-table-middle uk-table-without-shadow uk-background-default">
                                            @foreach($rebuys as $player)
                                                <tr>
                                                    <td>
                                                        <div class="uk-flex uk-flex-middle">
                                                            @if($player['name'])
                                                                <div class="uk-margin-small-right">
                                                                    <div class="uk-text-small">{{$player['name']}}</div>
                                                                </div>
                                                            @endif
                                                            @if($player['debtor'])
                                                                    <span class="cursor-default uk-margin-small-right fa-icon" uk-tooltip="Неоплачено"><i class="fad fa-badge-dollar fa-lg"></i></span>
                                                            @endif
                                                        </div>
                                                        <div class="uk-text-muted uk-text-small uk-text">{{$player['created_at']}}</div>
                                                    </td>
                                                    <td class="uk-text-center">{{$player['amount']}}</td>
                                                    <td class="uk-text-right">
                                                        <ul class="uk-iconnav uk-flex-center">
                                                            <li><a class="confirm-delete-item uk-icon" data-id="{{$player['id']}}" href="#" uk-tooltip="Удалить ребай"><i class="fad fa-trash fa-lg"></i></a></li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="uk-width-1-3@m">
                                <div class="uk-card uk-card-hover uk-card-default uk-card-button">
                                    <div class="uk-card-header">
                                        <div class="uk-flex uk-flex-middle uk-flex-between">
                                            <h3 class="uk-card-title uk-margin-remove">Аддон</h3>
                                            <a id="openAddon" href="#" class="uk-button uk-button-default uk-button-small square-button add-player"><span class="uk-icon"><i class="fad fa-user-plus fa-lg"></i></span></a>
                                        </div>
                                    </div>
                                    <div class="players-list-scrollable">
                                        <table id="addon-table" class="uk-table uk-table-middle uk-table-without-shadow uk-background-default">
                                            @foreach($addons as $player)
                                                <tr>
                                                    <td>
                                                        <div class="uk-flex uk-flex-middle">
                                                            @if($player['name'])
                                                                <div class="uk-margin-small-right">
                                                                    <div class="uk-text-small">{{$player['name']}}</div>
                                                                </div>
                                                            @endif
                                                            @if($player['debtor'])
                                                                    <span class="cursor-default uk-margin-small-right fa-icon" uk-tooltip="Неоплачено"><i class="fad fa-badge-dollar fa-lg"></i></span>
                                                            @endif
                                                        </div>
                                                        <div class="uk-text-muted uk-text-small uk-text">{{$player['created_at']}}</div>
                                                    </td>
                                                    <td class="uk-text-center">{{$player['amount']}}</td>
                                                    <td class="uk-text-right">
                                                        <ul class="uk-iconnav uk-flex-center">
                                                            <li><a class="confirm-delete-item uk-icon" data-id="{{$player['id']}}" href="#" uk-tooltip="Удалить аддон"><i class="fad fa-trash fa-lg"></i></a></li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="uk-width-1-1">
                        <div class="uk-grid-small" uk-grid>
                            <div class="uk-width-1-3@m">
                                <div class="uk-card uk-card-hover uk-card-default uk-card-button">
                                    <div class="uk-card-header">
                                        <div class="uk-flex uk-flex-middle uk-flex-between">
                                            <h3 class="uk-card-title uk-margin-remove">Должники</h3>
                                        </div>
                                    </div>
                                    <div class="players-list-scrollable">
                                        <table id="debtor-table" class="uk-table uk-table-without-shadow uk-background-default">
                                            @foreach($debtors as $player)
                                                <tr data-player="{{ $player['name'] }}">
                                                    <td><div class="uk-text-muted uk-text-small">{{ $player['created_at'] }}</div></td>
                                                    <td class="uk-text-center">{{$player['name']}}</td>
                                                    <td class="uk-text-center">{{$player['amount']}}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div id="offcanvas-logs" uk-offcanvas="flip: true">
            <div class="uk-offcanvas-bar uk-padding-remove">
                <button class="uk-offcanvas-close" type="button" uk-close></button>

                <div class="uk-padding uk-padding-remove-bottom">
                    <h3 class="uk-margin-remove">Последние действия</h3>
                </div>

                <ul id="log-list" class="uk-list log">

                </ul>

            </div>
        </div>

        <div id="modal-add-player" uk-modal>
            <div class="uk-modal-dialog">

                <button class="uk-modal-close-default" type="button" uk-close></button>

                <div class="uk-modal-header">
                    <h2 class="uk-modal-title">-</h2>
                </div>

                <div class="uk-modal-body">
                    <form method="POST" action="{{ route('tournament.store') }}">
                        @csrf
                        <div id="double-buy-container" class="bordered-checkbox-container uk-margin-small-bottom">
                            <div class="uk-flex uk-flex-middle uk-flex-between">
                                <div class="uk-flex uk-flex-middle">
                                    <div class="uk-margin-small-right uk-visible@l">
                                        <img src="/img/icons/avatar-person.svg" style="width: 40px;" alt="">
                                    </div>
                                    <div>
                                        <h4 class="uk-margin-remove">Двойной</h4>
                                        <p class="uk-margin-remove uk-text-muted">Выбрать, если стек двойной</p>
                                    </div>
                                </div>
                                <div>
                                    <label class="uk-switch" for="add-player_double-buy">
                                        <input type="checkbox" name="add-player_double-buy" id="add-player_double-buy">
                                        <div class="uk-switch-slider uk-switch-big"></div>
                                    </label>
                                </div>
                            </div>

                        </div>

                        <div id="check-bonus-container" class="bordered-checkbox-container uk-margin-small-bottom">
                            <div class="uk-flex uk-flex-middle uk-flex-between">
                                <div class="uk-flex uk-flex-middle">
                                    <div class="uk-margin-small-right uk-visible@l">
                                        <img src="/img/icons/avatar-person.svg" style="width: 40px;" alt="">
                                    </div>
                                    <div>
                                        <h4 class="uk-margin-remove">Выбрать, если стек с бонусом</h4>
                                        <p class="uk-margin-remove uk-text-muted">Выбрать, если стек с бонусом</p>
                                    </div>
                                </div>
                                <div>
                                    <label class="uk-switch" for="add-player_bonus-stack">
                                        <input type="checkbox" name="add-player_bonus-stack" id="add-player_bonus-stack" checked>
                                        <div class="uk-switch-slider uk-switch-big"></div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="bordered-checkbox-container uk-margin-small-bottom">
                            <div class="uk-flex uk-flex-middle uk-flex-between">
                                <div class="uk-flex uk-flex-middle">
                                    <div class="uk-margin-small-right uk-visible@l">
                                        <img src="/img/icons/avatar-person.svg" style="width: 40px;" alt="">
                                    </div>
                                    <div>
                                        <h4 class="uk-margin-remove">В долг</h4>
                                        <p class="uk-margin-remove uk-text-muted">Выбрать, если взнос НЕ оплачен и будет оплачен позднее</p>
                                    </div>
                                </div>
                                <div>
                                    <label class="uk-switch" for="add-player_pay-check">
                                        <input type="checkbox" id="add-player_pay-check">
                                        <div class="uk-switch-slider uk-switch-big"></div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div id="add-player_person" class="bordered-checkbox-container uk-margin-small-bottom">
                            <div class="uk-flex uk-flex-middle uk-flex-between">
                                <div class="uk-flex uk-flex-middle">
                                    <div class="uk-margin-small-right uk-visible@l">
                                        <img src="/img/icons/avatar-person.svg" style="width: 40px;" alt="">
                                    </div>
                                    <div>
                                        <h4 class="uk-margin-remove">Имя игрока</h4>
                                    </div>
                                </div>
                                <div>
                                    <div class="uk-inline">
                                        <span class="uk-form-icon" uk-icon="icon: users"></span>
                                        <input id="add-player_person_who" class="uk-input" type="text" name="name" placeholder="Имя">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="uk-modal-footer uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">Отмена</button>
                    <button id="add-player_button" data-id="{{ $tournament->id }}" class="uk-button uk-button-primary" type="button">Добавить</button>
                </div>
            </div>
        </div>


        <div id="modal-debtors-list" uk-modal>
            <div class="uk-modal-dialog">
                <button class="uk-modal-close-default" type="button" uk-close></button>
                <div class="uk-modal-header">
                    <h2 class="uk-modal-title">Итог всех должников</h2>
                </div>

                <table class="uk-table uk-table-hover uk-table-without-shadow uk-background-default uk-margin-remove">

                </table>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/gh/centrifugal/centrifuge-js@2.8.4/dist/centrifuge.min.js"></script>

    <script>
        $(document).ready(function () {
            // firsts init
            const clock = $('#clock');
            const tournament_id = $('#tournament-id').data('id');

            let timeBank = clock.data('countdown');
            //let timeBank = '2022-01-06 21:50:59';
            clock.countdown(timeBank, function(event) {
                var $this = $(this).html(event.strftime(''
                    + '<span>%H</span> : '
                    + '<span>%M</span> : '
                    + '<span>%S</span>'));
            });

            if($('a.tournament-start').hasClass('stop')){
                clock.countdown('pause');
            }

            $('.tournament-start').on('click', function (e) {
                e.preventDefault();
                const element = $(this);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ route('tournament.playPauseTournament') }}",
                    data: {id: tournament_id},
                    success: function (data) {
                        if (!data.success) {
                            UIkit.notification({
                                message: '<div class="uk-text-small uk-flex"><span class="uk-margin-small-right" uk-icon="icon: close; ratio: 1.4"></span><div><span class="uk-text-bold">'+ data.error +'</span><br>'+ data.text +'</div></div>',
                                pos: 'top-right',
                                status: 'danger'
                            });
                        }
                    },
                    error: function () {
                        UIkit.notification({
                            message: '<div class="uk-text-small uk-flex"><span class="uk-margin-small-right" uk-icon="icon: close; ratio: 1.4"></span><div><span class="uk-text-bold">Ошибка</span><br>Возникла ошибка</div></div>',
                            pos: 'top-right',
                            status: 'danger'
                        });
                    },
                });
            });

            $('#next-level-start').on('click', function (e) {
                e.preventDefault();
                const element = $('.tournament-start');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ route('tournament.nextLevel') }}",
                    data: {id: tournament_id},
                    success: function (data) {
                        if (!data.success) {
                            UIkit.notification({
                                message: '<div class="uk-text-small uk-flex"><span class="uk-margin-small-right" uk-icon="icon: check; ratio: 1.4"></span><div><span class="uk-text-bold">'+ data.error +'</span><br>'+ data.text +'</div></div>',
                                pos: 'top-right',
                                status: 'danger'
                            });
                        }
                    }
                });
            });

            $('#reload-level-time').on('click', function (e) {
                e.preventDefault();
                const element = $('.tournament-start');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ route('tournament.refreshLevel') }}",
                    data: {id: tournament_id},
                    success: function (data) {
                        if (data.success) {
                            UIkit.notification({
                                message: '<div class="uk-text-small uk-flex"><span class="uk-margin-small-right" uk-icon="icon: check; ratio: 1.4"></span><div><span class="uk-text-bold">'+ data.success +'</span><br>'+ data.text +'</div></div>',
                                pos: 'top-right',
                                status: 'success'
                            });
                        }
                    }
                });
            });

            $('#prev-level-start').on('click', function (e) {
                e.preventDefault();
                const element = $('.tournament-start');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ route('tournament.prevLevel') }}",
                    data: {id: tournament_id},
                    success: function (data) {
                        if (!data.success) {
                            UIkit.notification({
                                message: '<div class="uk-text-small uk-flex"><span class="uk-margin-small-right" uk-icon="icon: check; ratio: 1.4"></span><div><span class="uk-text-bold">'+ data.error +'</span><br>'+ data.text +'</div></div>',
                                pos: 'top-right',
                                status: 'danger'
                            });
                        }
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            //init
            const tournament_id = $('#tournament-id').data('id');
            const whoElement = $('#add-player_person_who');
            const whoBlockElement = $('#add-player_person');
            const doubleElement = $('#add-player_double-buy');
            const bonusCheckElement = $('#add-player_bonus-stack');
            const payCheckElement = $('#add-player_pay-check');
            const modalElement = $('#modal-add-player');
            const playerTableElement = $('#player-table');
            const rebuyTableElement = $('#rebuy-table');
            const addonTableElement = $('#addon-table');
            const debtorTableElement = $('#debtor-table');
            let getDeletePlayerId = null;
            payCheckElement.prop('checked', false);
            doubleElement.prop('checked', false);
            whoElement.val('');
            let buyType = 1;


            // после каждого ajax на странице вызываем обновление информации турнира
            $( document ).ajaxComplete(function( event, xhr, settings ) {
                if ( settings.url !== '{{ route('tournamentPlayer.destroy') }}' ) {
                    $('#debtor-table tr').each(function() {
                        if($(this).data('player') === getDeletePlayerId) {
                            $(this).hide('slow', function () {
                                $(this).remove();
                            });
                        }
                    });
                    getDeletePlayerId = null;
                }
            });

            // получаем id удаляемого игрока, чтобы после его удаления проверить есть ли должник с этим id и удалим его
            $(document).on('click', '.confirm-delete-item', function (e) {
                getDeletePlayerId = $(this).data('id');
            });


            $('#openBuyIn').on('click', function (e) {
                e.preventDefault();
                UIkit.modal(modalElement).show();
                modalElement.find('.uk-modal-title').text('Добавить нового игрока');
                buyType = 1;
            });

            $('#openRebuy').on('click', function (e) {
                e.preventDefault();
                $('#check-bonus-container').addClass('uk-hidden');
                UIkit.modal(modalElement).show();
                modalElement.find('.uk-modal-title').text('Добавить новый ребай');
                buyType = 2;
            });

            $('#openAddon').on('click', function (e) {
                e.preventDefault();
                $('#check-bonus-container').addClass('uk-hidden');
                $('#double-buy-container').addClass('uk-hidden');
                UIkit.modal(modalElement).show();
                modalElement.find('.uk-modal-title').text('Добавить новый аддон');
                buyType = 3;
            });

            $('#modal-add-player').on({
                'hidden.uk.modal': function(){
                    payCheckElement.prop('checked', false);
                    doubleElement.prop('checked', false);
                    whoElement.val('');
                    $('#double-buy-container').removeClass('uk-hidden');
                    $('#check-bonus-container').removeClass('uk-hidden');
                }
            });


            $('#group-debtors').on('click', function (e) {
                e.preventDefault();
                $(this).prepend('<span class="uk-margin-small-right"></span>');
                $(this).find('span').attr('uk-spinner', "ratio: 0.7");

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ route('tournament.groupDebtors') }}",
                    data: {id: tournament_id,},
                    success: function (data) {
                        UIkit.modal('#modal-debtors-list').show();
                        $('#modal-debtors-list table').empty();
                        if (data.debtors.length != 0) {
                            $.each( data.debtors, function( name, debtor ) {
                                $('#modal-debtors-list table').prepend(
                                    '<tr><td><div class="uk-text-muted uk-text-small">'+ name +'</div></td>' +
                                    '<td class="uk-text-center">'+ debtor.sum +'</td>' +
                                    '<td class="uk-text-right">'+
                                    '</td>'+
                                    '<td class="uk-text-right">'+
                                    '<ul class="uk-iconnav uk-flex-center">'+
                                    '<li><a class="confirm-delete-debtor uk-icon" data-name="'+ name +'" href="#" uk-tooltip="Удалить" uk-icon="trash"></a></li>'+
                                    '</ul>'+
                                    '</td>'+
                                    '</tr>'
                                );
                            });
                        } else {
                            $('#modal-debtors-list table').html('<div class="uk-text-lead uk-text-center uk-margin-medium uk-margin-medium-top">Должников нет<div>')
                        }

                        $('#group-debtors').find('span').remove();
                    }
                });
            });


            $('#calc-prize-pool').on('click', function (e) {
                e.preventDefault();
                $(this).prepend('<span class="uk-margin-small-right"></span>');
                $(this).find('span').attr('uk-spinner', "ratio: 0.7");

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ route('tournament.calculatePrizePool') }}",
                    data: {id: tournament_id,},
                    success: function (data) {
                        if (data.success) {
                            UIkit.notification({
                                message: '<div class="uk-text-small uk-flex"><span class="uk-margin-small-right" uk-icon="icon: check; ratio: 1.4"></span><div><span class="uk-text-bold">'+ data.success +'</span><br>'+ data.text +'</div></div>',
                                pos: 'top-right',
                                status: 'success'
                            });
                        } else {
                            UIkit.notification({
                                message: '<div class="uk-text-small uk-flex"><span class="uk-margin-small-right" uk-icon="icon: close; ratio: 1.4"></span><div><span class="uk-text-bold">'+ data.error +'</span><br>'+ data.text +'</div></div>',
                                pos: 'top-right',
                                status: 'danger'
                            });
                        }
                        $('#calc-prize-pool').find('span').remove();
                    },
                    error: function () {
                        $('#calc-prize-pool').find('span').remove();
                        UIkit.notification({
                            message: '<div class="uk-text-small uk-flex"><span class="uk-margin-small-right" uk-icon="icon: close; ratio: 1.4"></span><div><span class="uk-text-bold">Ошибка</span><br>Возникла ошибка</div></div>',
                            pos: 'top-right',
                            status: 'danger'
                        });
                    },
                });
            });

            $('#add-player_button').on('click', function (e) {
                e.preventDefault();
                const element = $(this);
                const tournament_id = element.data('id');

                element.attr('disabled', 'true');

                let double_amount = 0;
                if(doubleElement.is(":checked")) {
                    double_amount = 1;
                }

                let pay_check = 0;
                let player_name = whoElement.val();
                if(payCheckElement.is(":checked")) {
                    pay_check = 1;
                }

                let bonus_check = 0;
                if(bonusCheckElement.is(":checked") && buyType === 1) {
                    bonus_check = 1;
                }

                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    type: 'POST',
                    url: "{{ route('tournamentPlayer.store') }}",
                    data: {tournament_id: tournament_id, double_amount: double_amount, type: buyType, debtor: pay_check, name: player_name, bonus_stack: bonus_check},
                    success: function (data) {
                        if (data) {
                            UIkit.notification({
                                message: '<div class="uk-text-small uk-flex"><span class="uk-margin-small-right" uk-icon="icon: check; ratio: 1.4"></span><div><span class="uk-text-bold">Успешно!</span><br>Игрок успешно добавлен</div></div>',
                                pos: 'top-right',
                                status: 'success'
                            });
                            let addTableElement;
                            switch (buyType) {
                                case 1:
                                    addTableElement = playerTableElement;
                                    break;
                                case 2:
                                    addTableElement = rebuyTableElement;
                                    break;
                                case 3:
                                    addTableElement = addonTableElement;
                                    break;
                            }

                            let html = '<tr>' +
                                '<td>' +
                                '<div class="uk-flex uk-flex-middle">';

                            if(data.name != null) {
                                html += '<div class="uk-margin-small-right">' +
                                    '<div class="uk-text-small">'+ data.name +'</div>' +
                                    '</div>';
                            }

                            if(data.debtor != 0) {
                                html += '<span class="cursor-default uk-margin-small-right fa-icon" uk-tooltip="Неоплачено"><i class="fad fa-badge-dollar fa-lg"></i></span>';
                            }

                            if(data.bonus_stack != 0) {
                                html += '<span class="cursor-default" uk-tooltip="С бонусным стеком"><i class="fad fa-coins fa-lg"></i></span>';
                            }

                            html += '</div><div class="uk-text-muted uk-text-small">'+ data.created_at +'</div></td>' +
                                '<td class="uk-text-center">'+ data.amount +'</td>' +
                                '<td class="uk-text-right">'+
                                '<ul class="uk-iconnav uk-flex-center">';

                            html += '<li><a class="print-player-check uk-icon" data-id="'+ data.id +'" href="#" uk-tooltip="Напечатать чек"><i class="fad fa-print fa-lg"></i></a></li>';

                            if(buyType === 1) {
                                html += '<li><a class="evaluate-player-button uk-icon" data-id="'+ data.id +'" href="#" uk-tooltip="Нажать, если игрок выбыл"><i class="fad fa-sign-out fa-lg"></i></a></li>';
                            }

                            html += '<li><a class="confirm-delete-item uk-icon" data-id="'+ data.id +'" href="#" uk-tooltip="Удалить"><i class="fad fa-trash fa-lg"></i></a></li>'+
                                '</ul>'+
                                '</td>'+
                                '</tr>';

                            addTableElement.prepend(html);

                            if(data.debtor != 0){
                                debtorTableElement.prepend(
                                    '<tr data-player="'+ data.name +'"><td><div class="uk-text-muted uk-text-small">'+ data.created_at +'</div></td>' +
                                    '<td class="uk-text-center">'+ data.name +'</td>' +
                                    '<td class="uk-text-center">'+ data.amount +'</td>' +
                                    '<td class="uk-text-right">'+
                                    '</td>'+
                                    '</tr>'
                                );
                            }
                            UIkit.modal('#modal-add-player').hide();
                        } else {
                            UIkit.notification({
                                message: '<div class="uk-text-small uk-flex"><span class="uk-margin-small-right" uk-icon="icon: close; ratio: 1.4"></span><div><span class="uk-text-bold">Ошибка</span><br>Ошибка при добавлении игрока.</div></div>',
                                pos: 'top-right',
                                status: 'danger'
                            });
                        }
                        element.removeAttr('disabled');
                    },
                    error: function (data) {
                        UIkit.notification({
                            message: '<div class="uk-text-small uk-flex"><span class="uk-margin-small-right" uk-icon="icon: close; ratio: 1.4"></span><div><span class="uk-text-bold">Ошибка</span><br>'+ data.responseJSON.errors.name[0] +'</div></div>',
                            pos: 'top-right',
                            status: 'danger'
                        });
                    },
                });
            });

            $('#show-logs').on('click', function (e) {
                e.preventDefault();
                callLogs();
                async function callLogs(){
                    await refreshTournamentLogs();
                }
            });

            function refreshTournamentLogs () {
                const logContainer = $('#log-list');
                const element = $('#show-logs');

                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    type: 'POST',
                    url: "{{ route('tournament.logs') }}",
                    data: {tournament_id: tournament_id},
                    beforeSend: function () {
                        element.removeAttr("uk-icon");
                        element.attr( "uk-spinner", "ratio: 0.7" );
                    },
                    success: function (data) {
                        logContainer.empty();
                        $.each( data.data, function( id, log ) {
                            let labelType = 'uk-label-info';
                            switch (log.initialEvent) {
                                case 'created' :
                                    labelType = 'uk-label-success';
                                    break;
                                case 'updated' :
                                    labelType = 'uk-label-info';
                                    break;
                                case 'deleted' :
                                    labelType = 'uk-label-danger';
                                    break;
                            }
                            logContainer.prepend(
                                '<li class="uk-position-relative">' +
                                    '<div class="person uk-flex uk-flex-middle uk-margin-small-bottom ">' +
                                        '<div>' +
                                            '<img src="/img/icons/avatar-person.svg" class="person__avatar uk-margin-small-right" alt="Аватар">' +
                                        '</div>' +
                                        '<div>' +
                                            '<div class="person__name">'+ log.name +'</div>' +
                                            '<div class="person__role">'+ log.user_role +'</div>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="uk-label '+ labelType +' uk-margin-right uk-margin-top log__type uk-position-top-right">'+ log.event +'</div>' +
                                    '<div class="log__action uk-margin-small-bottom">' +
                                    log.description +
                                    '</div>' +
                                    '<div class="log__time">'+ log.created_at +'</div>' +
                                '</li>'
                            );
                        });

                        UIkit.offcanvas($('#offcanvas-logs')).show();

                        element.removeAttr("uk-spinner");
                        element.removeClass('uk-spinner')
                        element.attr('uk-icon', 'server');
                    }
                });
            }
        });



        $(document).on('click', '.confirm-delete-debtor', function (e) {
            e.preventDefault();
            const tournament_id = $('#tournament-id').data('id');
            const element = $(this);
            const name = $(this).data('name');

            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                type: 'POST',
                url: "{{ route('tournamentPlayer.unDebtorByName') }}",
                data: {id: tournament_id, name: name},
                success: function (data) {

                    if(data !== '0') {
                        $('#debtor-table tr').each(function () {
                            if($(this).data('player') === name) {
                                $(this).remove();
                            }
                        })
                        element.closest('tr').hide(function () {
                            element.closest('tr').remove();
                        });
                    } else {
                        UIkit.notification({
                            message: '<div class="uk-text-small uk-flex"><span class="uk-margin-small-right" uk-icon="icon: close; ratio: 1.4"></span><div><span class="uk-text-bold">Ошибка</span><br></div></div>',
                            pos: 'top-right',
                            status: 'danger'
                        });
                    }
                },
            });
        });

        $(document).on('click', '.evaluate-player-button', function (e) {
            e.preventDefault();
            const element = $(this);
            const player_id = element.data('id');

            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                type: 'POST',
                url: "{{ route('tournamentPlayer.evaluate') }}",
                data: {id: player_id},
                beforeSend: function () {
                    element.html('');
                    element.attr( "uk-spinner", "ratio: 0.7" );
                },
                success: function (data) {
                    let icon;
                    if(data.status === 'knockOut') {
                        icon = '<i class="fad fa-sign-in fa-lg"></i>';
                        element.closest('tr').addClass('uk-opacity-large');
                    }
                    if(data.status === 'knockIn') {
                        icon = '<i class="fad fa-sign-out fa-lg"></i>';
                        element.closest('tr').removeClass('uk-opacity-large');
                    }
                    element.removeAttr("uk-spinner");
                    element.removeClass('uk-spinner')
                    element.html(icon);
                },
            });
        });

        $(document).on('click', '#complete-tournament-button', function (e) {
            e.preventDefault();
            UIkit.modal.confirm('<h3>Вы подтверждаете завершение турнира? Дальнейшие действия с турниром будут невозможны.</h3>',
                {
                    labels: {
                        cancel: 'Отмена',
                        ok: 'Завершить'
                    }
                }).then(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#complete-tournament').submit();
            }, function () {});
        });

        const url = "ws://" + window.location.host + ":8000/connection/websocket";
        const centrifuge = new Centrifuge(url);
        //centrifuge.setToken("eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE2NDY5ODgxNjB9.n8mZnT3NiJ6sBr73QU50CBAvhaYwJu7b_CFzbPfLyyE");
        centrifuge.setToken('{{ $token }}');

        centrifuge.on('connect', function(ctx) {
            console.log("connected to Centrifugo", ctx);
        });
        centrifuge.on('disconnect', function(ctx) {
            console.log("disconnected from Centrifugo", ctx);
        });
        centrifuge.subscribe("tournament.{{ $tournament->id }}", function(ctx) {
            console.log(ctx);
            if(ctx.data.event === 'App\\Events\\RefreshTournamentTimeEvent') {
                $('#tournament-manage-level').text(ctx.data.level);
                $('#clock').countdown(ctx.data.timeBank);
                if(ctx.data.status === 'play') {
                    $('.tournament-start').attr('uk-icon', "ban");
                    $('.tournament-start').attr('uk-tooltip', "Приостановить турнир");
                    $('.tournament-start').removeClass('stop');
                    $('.tournament-start').addClass('play');
                    $('#clock').countdown('resume');
                } else {
                    $('.tournament-start').attr('uk-icon', "play-circle");
                    $('.tournament-start').attr('uk-tooltip', "Продолжить турнир");
                    $('.tournament-start').removeClass('play');
                    $('.tournament-start').addClass('stop');
                    $('#clock').countdown('pause');
                }
            }
            if(ctx.data.event === 'App\\Events\\RefreshTournamentBoardEvent') {
                const manageLevelElement = $('#tournament-manage-level');
                const managePlayersElement = $('#tournament-manage-players');
                const manageRebuysElement = $('#tournament-manage-rebuys');
                const manageAddonsElement = $('#tournament-manage-addons');
                const manageTotalPrizeElement = $('#tournament-manage-total-prize');

                manageLevelElement.text(ctx.data.tournament.level);
                managePlayersElement.text(ctx.data.tournament.total_players);
                manageRebuysElement.text(ctx.data.tournament.rebuys);
                manageAddonsElement.text(ctx.data.tournament.addons);
                manageTotalPrizeElement.text(ctx.data.tournament.total_price);
            }
        });
        centrifuge.connect();

    </script>

    @include('include.delete', ['route' => 'tournamentPlayer.destroy'])


@endsection
