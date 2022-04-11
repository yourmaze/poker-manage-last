@extends('layouts.dashboard', ['title' => 'Управление кэш игрой'])


@section('content')

        @include('include.alert')






        <div id="tournament-id" class="uk-hidden" data-id="{{ $cashGame['id'] }}"></div>

        <div class="uk-grid uk-flex-center">

            <div class="uk-width-1-1 uk-flex uk-flex-between uk-margin-bottom">
                <ul class="uk-breadcrumb">
                    <li><a href="{{ route('home') }}">Главная</a></li>
                    <li><a href="{{ route('cash.index') }}">Кэш игры</a></li>
                    <li><span>{{ $cashGame['id'] }}</span></li>
                </ul>
            </div>


            <div class="uk-width-1-1">
                <div class="uk-grid-small uk-grid-match" uk-grid>
                    <div class="uk-width-1-1">
                        <div class="manage-panel uk-card uk-card-primary uk-card-button uk-card-body uk-flex uk-flex-column uk-flex-between">
                            <div class="uk-grid-small" uk-grid>
                                <div class="uk-width-2-5@xl uk-width-3-5@l">
                                    <div class="uk-flex uk-flex-middle uk-margin-large-bottom">
                                        <div>
                                            <div class="card-date">
                                                <div class="card-date__month">{{date('M', strtotime($cashGame['created_at']))}}</div>
                                                <div class="card-date__date">{{date('j', strtotime($cashGame['created_at']))}}</div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="uk-text-muted">Кэш игра</div>
                                        </div>
                                    </div>

                                    <div class="tournament-info uk-grid-large" uk-grid>
                                        <div class="uk-width-auto">
                                            <div class="card-small-title">Игроков</div>
                                            <div id="tournament-manage-players" class="card-small-value">{{ $cashGame['players_amount'] }}</div>
                                        </div>
                                        <div class="uk-width-auto">
                                            <div class="card-small-title">Рейк</div>
                                            <div id="tournament-manage-rebuys" class="card-small-value">&#8381; {{ $rake }}</div>
                                        </div>
                                        <div class="uk-width-auto">
                                            <div class="card-small-title">Чаевых</div>
                                            <div id="tournament-manage-addons" class="card-small-value">&#8381; {{ $tips }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-width-1-5@xl uk-width-2-5@l">

                                </div>
                                <div class="uk-width-2-5@xl uk-width-1-1@l uk-margin-remove-top uk-flex-middle uk-flex uk-flex-center">
                                    <div id="calc-prize-pool" class="uk-button uk-button-default">Завершить игровую сессию</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="uk-width-1-3@m">
                        <div class="uk-card uk-card-hover uk-card-default uk-card-button">
                            <div class="uk-card-header">
                                <div class="uk-flex uk-flex-middle uk-flex-between">
                                    <h3 class="uk-card-title uk-margin-remove">Игроки</h3>
                                    <a href="#" uk-toggle="target: #modal-add-buy-in" class="uk-button uk-button-default uk-button-small square-button add-player"><span class="uk-icon" uk-icon="plus"></span></a>
                                </div>
                            </div>
                            <div class="players-list-scrollable">
                                <table id="player-table" class="uk-table uk-table-without-shadow uk-background-default">
                                    @foreach($buyInsResource as $buyIn)
                                        <tr>
                                            <td>
                                                <div class="uk-flex uk-flex-middle">
                                                    <div class="uk-margin-small-right">
                                                        <div class="uk-text-small">{{$buyIn['name']}}</div>
                                                    </div>
                                                    @if($buyIn['debtor'])
                                                        <span class="uk-text-danger" uk-tooltip="Неоплачено">&#36;</span>
                                                    @endif
                                                </div>
                                                <div class="uk-text-muted uk-text-small uk-text">{{$buyIn['created_at']}}</div>
                                            </td>
                                            <td class="uk-text-center">{{$buyIn['amount']}}</td>
                                            <td class="uk-text-right">
                                                <ul class="uk-iconnav uk-flex-center">
                                                    <li><a class="confirm-delete-buy-in uk-icon" data-id="{{$buyIn['id']}}" href="#" uk-tooltip="Удалить игрока" uk-icon="trash"></a></li>
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
                                    <h3 class="uk-card-title uk-margin-remove">Смены дилеров</h3>
                                    <a href="#" uk-toggle="target: #modal-add-rake" class="uk-button uk-button-default uk-button-small square-button add-player"><span class="uk-icon" uk-icon="plus"></span></a>
                                </div>
                            </div>
                            <div class="players-list-scrollable">
                                <table id="cash-rake-table" class="uk-table uk-table-without-shadow uk-background-default">
                                    <tr>
                                        <th></th>
                                        <th class="uk-text-center uk-text-muted">Рейк</th>
                                        <th class="uk-text-center uk-text-muted">Чаевые</th>
                                        <th></th>
                                    </tr>
                                    @foreach($cashRakeResource as $buyIn)
                                        <tr>
                                            <td>
                                                <div class="uk-text-small">{{$buyIn['name']}}</div>
                                                <div class="uk-text-muted uk-text-small">{{$buyIn['created_at']}}</div>
                                            </td>
                                            <td class="uk-text-center">{{$buyIn['rake']}}</td>
                                            <td class="uk-text-center">{{$buyIn['tips']}}</td>
                                            <td class="uk-text-right">
                                                <ul class="uk-iconnav uk-flex-center">
                                                    <li><a class="confirm-delete-item uk-icon" data-id="{{$buyIn['id']}}" href="#" uk-tooltip="Удалить игрока" uk-icon="trash"></a></li>
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
        </div>


        <div id="modal-add-rake" uk-modal>
            <div class="uk-modal-dialog">

                <button class="uk-modal-close-default" type="button" uk-close></button>

                <div class="uk-modal-header">
                    <h2 class="uk-modal-title">Вывод дилера</h2>
                </div>

                <div class="uk-modal-body">
                    <form>
                        @csrf
                        <div class="uk-margin">
                            <div class="uk-inline">
                                <a class="uk-form-icon" href="" uk-icon="icon: user"></a>
                                <select class="uk-select uk-form-width-medium" name="dealer_id" placeholder="Количество рейка">
                                    <option value="">Выберете дилера</option>
                                    @foreach($dealers as $dealer)
                                        <option value="{{ $dealer->id }}">{{ $dealer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <div class="uk-inline">
                                <a class="uk-form-icon" href="" uk-icon="icon: bolt"></a>
                                <input class="uk-input uk-form-width-medium" name="rake" placeholder="Количество рейка">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <div class="uk-inline">
                                <a class="uk-form-icon" href="" uk-icon="icon: tag"></a>
                                <input class="uk-input uk-form-width-medium" name="tips" placeholder="Количество чаевых">
                            </div>
                        </div>
                        <input type="text" class="uk-invisible" name="game_id" value="{{ $cashGame['id'] }}">
                        <div class="uk-modal-footer uk-text-right">
                            <button class="uk-button uk-button-default uk-modal-close" type="button">Отмена</button>
                            <button class="uk-button uk-button-primary" type="submit">Добавить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="modal-add-buy-in" uk-modal>
            <div class="uk-modal-dialog">

                <button class="uk-modal-close-default" type="button" uk-close></button>

                <div class="uk-modal-header">
                    <h2 class="uk-modal-title">Добавить бай-ин</h2>
                </div>

                <div class="uk-modal-body">
                    <form>
                        @csrf
                        <div class="uk-margin">
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: users"></span>
                                <input id="add-player_person_who" class="uk-input uk-form-width-medium" type="text" name="name" placeholder="Имя">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <div class="uk-inline">
                                <a class="uk-form-icon" href="" uk-icon="icon: bolt"></a>
                                <input class="uk-input uk-form-width-medium" name="amount" placeholder="Сколько вход">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <h4 class="uk-margin-remove-top">Выбрать, если взнос НЕ оплачен и будет оплачен позднее</h4>
                            <label class="uk-switch" for="add-player_pay-check">
                                <input type="checkbox" id="add-player_pay-check" value="1" name="debtor">
                                <div class="uk-switch-slider uk-switch-big"></div>
                            </label>
                        </div>
                        <input type="text" class="uk-invisible" name="game_id" value="{{ $cashGame['id'] }}">
                        <div class="uk-modal-footer uk-text-right">
                            <button class="uk-button uk-button-default uk-modal-close" type="button">Отмена</button>
                            <button class="uk-button uk-button-primary" type="submit">Добавить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <script>
            $(document).ready(function () {
                const cashRakeTableElement = $('#cash-rake-table');

                $('#modal-add-rake button[type="submit"]').on('click', function (e) {
                    e.preventDefault();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('cashRake.store') }}",
                        data: $('#modal-add-rake form').serialize(),
                        success: function (data) {
                            if (data) {
                                UIkit.notification({
                                    message: '<div class="uk-text-small uk-flex"><span class="uk-margin-small-right" uk-icon="icon: check; ratio: 1.4"></span><div><span class="uk-text-bold">Запись успешно добавлена</span><br></div></div>',
                                    pos: 'top-right',
                                    status: 'success'
                                });

                                cashRakeTableElement.find('tr:first-child').after(
                                    '<tr><td><div class="uk-text-small">'+data.cash_rake.name+'</div><div class="uk-text-muted uk-text-small">'+ data.cash_rake.created_at +'</div></td>' +
                                    '<td class="uk-text-center">'+ data.cash_rake.rake +'</td>' +
                                    '<td class="uk-text-center">'+ data.cash_rake.tips +'</td>' +
                                    '<td class="uk-text-right">'+
                                    '<ul class="uk-iconnav uk-flex-center">'+
                                    '<li><a class="confirm-delete-item uk-icon" data-id="'+ data.cash_rake.id +'" href="#" uk-tooltip="Удалить турнир" uk-icon="trash"></a></li>'+
                                    '</ul>'+
                                    '</td>'+
                                    '</tr>'
                                );

                                UIkit.modal('#modal-add-rake').hide();
                            } else {
                                UIkit.notification({
                                    message: '<div class="uk-text-small uk-flex"><span class="uk-margin-small-right" uk-icon="icon: close; ratio: 1.4"></span><div><span class="uk-text-bold">Ошибка</span><br></div></div>',
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


                const playerTableElement = $('#player-table');

                $('#modal-add-buy-in button[type="submit"]').on('click', function (e) {
                    e.preventDefault();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('cashBuyIn.store') }}",
                        data: $('#modal-add-buy-in form').serialize(),
                        success: function (data) {
                            if (data) {
                                UIkit.notification({
                                    message: '<div class="uk-text-small uk-flex"><span class="uk-margin-small-right" uk-icon="icon: check; ratio: 1.4"></span><div><span class="uk-text-bold">Запись успешно добавлена</span><br></div></div>',
                                    pos: 'top-right',
                                    status: 'success'
                                });

                                let html = '<tr>' +
                                    '<td>' +
                                    '<div class="uk-flex uk-flex-middle">';

                                if(data.buyIns.name != null) {
                                    html += '<div class="uk-margin-small-right">' +
                                        '<div class="uk-text-small">'+ data.buyIns.name +'</div>' +
                                        '</div>';
                                }

                                if(data.buyIns.debtor == 1) {
                                    html += '<span class="uk-text-danger" uk-tooltip="Неоплачено">&#36;</span>';
                                }

                                html += '</div><div class="uk-text-muted uk-text-small">'+ data.buyIns.created_at +'</div></td>' +
                                    '<td class="uk-text-center">'+ data.buyIns.amount +'</td>' +
                                    '<td class="uk-text-right">'+
                                    '<ul class="uk-iconnav uk-flex-center">'+
                                    '<li><a class="confirm-delete-buy-in uk-icon" data-id="'+ data.buyIns.id +'" href="#" uk-tooltip="Удалить турнир" uk-icon="trash"></a></li>'+
                                    '</ul>'+
                                    '</td>'+
                                    '</tr>';

                                playerTableElement.prepend(html);



                                UIkit.modal('#modal-add-buy-in').hide();
                            } else {
                                UIkit.notification({
                                    message: '<div class="uk-text-small uk-flex"><span class="uk-margin-small-right" uk-icon="icon: close; ratio: 1.4"></span><div><span class="uk-text-bold">Ошибка</span><br></div></div>',
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
            });
        </script>

        @include('include.delete', ['route' => 'cashRake.destroy'])

        @include('include.delete', ['route' => 'cashBuyIn.destroy', 'selector' => '.confirm-delete-buy-in'])

@endsection
