<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="background: #202020">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="/favicon.png"/>

    <title>@isset($title) {{ $title }} @else Minus30 Hold`em helper @endisset</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tournament-desktop.css') }}" rel="stylesheet">

@stack('styles')

<!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    @stack('scripts')

    <script src="{{ asset('js/app.js') }}" defer></script>

    <script>
        window.laravel_echo_port='{{env("LARAVEL_ECHO_PORT")}}';
    </script>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700;900&display=swap"
          rel="stylesheet">
</head>
<body>

<div class="uk-container-expand">

    <div id="btn-refresh" data-id="{{ $tournament->id }}" class="uk-button uk-position-top-right uk-margin-medium-right">Refresh</div>

    <div class="fullscreenButton uk-position-top-right uk-button uk-icon" uk-tooltip="Во весь экран" uk-icon="expand"></div>

    <div id="tournament-id" class="uk-hidden" data-id="{{ $tournament->id }}"></div>

    <div class="tt">
        <div class="tt__header">
            <div class="tt__main-title">{{ $tournament->name }}</div>
        </div>

        <div class="uk-grid">
            <div class="uk-width-1-4@l">

                <div class="right-info-block-margin">
                    <div class="uk-card uk-card-secondary uk-card-body right-info-block">
                        <div>
                            <h3 class="uk-card-title">Игроков</h3>
                            <div class="uk-flex uk-flex-center uk-flex-middle">
                                <div id="tournament-players-lost" class="uk-text-lead">{{ $tournament->playersLost }}</div>
                                <div class="uk-card-title uk-margin-small-right uk-margin-small-left">из</div>
                                <div id="tournament-players" class="uk-text-lead">{{ $tournament->total_players }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="right-info-block-margin">
                    <div class="uk-card uk-card-secondary uk-card-body right-info-block">
                        <div>
                            <h3 class="uk-card-title">Ребаев/Аддонов</h3>
                            <div class="uk-text-lead"><span id="tournament-rebuys">{{ $tournament->rebuys }}</span>/<span id="tournament-addons">{{ $tournament->addons }}</span></div>
                        </div>
                    </div>
                </div>

                <div class="right-info-block-margin">
                    <div class="uk-card uk-card-secondary uk-card-body right-info-block">
                        <div>
                            <h3 class="uk-card-title">Средний стек</h3>
                            <div class="uk-text-lead">
                                <div id="average-stack">{{ number_format($tournament->averageStack) }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="right-info-block-margin">
                    <div class="uk-card uk-card-secondary uk-card-body right-info-block">
                        <div>
                            <h3 class="uk-card-title">Общий приз</h3>
                            <div id="tournament-total-price" class="uk-text-lead">{{ number_format($tournament->prizePool) }}</div>
                        </div>
                    </div>
                </div>

                <div class="right-info-block-margin">
                    <div class="uk-card uk-card-secondary uk-card-body right-info-block">
                        <div>
                            <h3 class="uk-card-title">След.перерыв</h3>
                            <div class="uk-grid-small uk-child-width-auto" uk-grid uk-countdown="date:0000">
                                <div>
                                    <div class="uk-countdown-number uk-countdown-hours uk-text-lead"></div>
                                </div>
                                <div class="uk-countdown-separator">:</div>
                                <div>
                                    <div class="uk-countdown-number uk-countdown-minutes uk-text-lead"></div>
                                </div>
                                <div class="uk-countdown-separator">:</div>
                                <div>
                                    <div class="uk-countdown-number uk-countdown-seconds uk-text-lead"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-2@l">

                <div class="center-block-margin">
                    <div id="time-block" class="uk-card uk-card-secondary uk-card-body uk-flex-wrap">
                        <div>
                            <div class="uk-width-1-1">
                                <div class="uk-flex uk-flex-center uk-flex-middle">
                                    <h3 class="uk-card-title uk-margin-remove-bottom uk-margin-small-right">Уровень</h3>
                                    <div class="uk-text-lead">
                                        <div id="tournament-level">{{ $tournament->level }}</div>
                                    </div>
                                </div>
                            </div>
                            <div id="clock" class="{{$tournament->status}}" data-countdown="@php if(isset($tournament->timeBank)) echo $tournament->timeBank; else echo '00:00'; @endphp">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="center-block-margin">
                    <div id="blind-info-block" class="uk-card uk-card-secondary uk-card-body">
                        <div>
                            <div class="uk-flex uk-flex-middle uk-flex-center">
                                <h3 class="uk-card-title uk-margin-remove-bottom uk-margin-small-right">Блайнды</h3>
                                <div class="uk-text-lead"><span id="tournament-sb">{{ number_format($tournament->blinds['smallBlind']) }}</span> / <span id="tournament-bb">{{ number_format($tournament->blinds['bigBlind']) }}</span></div>
                            </div>
                            <div class="uk-flex uk-flex-middle uk-flex-center">
                                <h3 class="uk-card-title uk-margin-remove-bottom uk-margin-small-right">Анте</h3>
                                <div id="tournament-ante" class="uk-text-lead">{{ number_format($tournament->blinds['ante']) }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="center-block-margin">
                    <div id="nextlevel-blind-info" class="uk-card uk-card-secondary uk-card-body">
                        <div>
                            <div class="uk-flex uk-flex-middle uk-flex-center">
                                <h3 class="uk-card-title uk-margin-remove-bottom uk-margin-small-right">Следующий уровень</h3>
                                <div class="uk-text-lead"><span id="tournament-next-sb">{{ number_format($tournament->nextBlinds['smallBlind']) }}</span> / <span id="tournament-next-bb">{{ number_format($tournament->nextBlinds['bigBlind']) }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="uk-width-1-4@l">
                <div class="uk-card uk-card-secondary uk-card-body uk-margin-medium-bottom">
                    <div class="uk-width-expand">
                        <h3 class="uk-card-title payment-title">Выплаты</h3>
                        <div class="tournament-payouts-wrapper" data-direction='up' data-duration='10000'>
                            <table id="tournament-payouts" class="uk-table">
                                @if ($tournament->payments)
                                    @foreach($tournament->payments as $key=>$payment)
                                        <tr>
                                            <td>{{ $key }}</td>
                                            <td>{{ number_format($payment['pay']) }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
                <div class="uk-text-center">
                    <h3 class="uk-card-title payment-title uk-color-white">Информация о турнире</h3>
                    {!! QrCode::size(100)->color(255, 255, 255)->backgroundColor(255, 255, 255, 0)->generate(route('tournament.information', $tournament->id) ); !!}
                </div>
            </div>
        </div>
    </div>
</div>




<script src="https://cdn.jsdelivr.net/gh/centrifugal/centrifuge-js@2.8.4/dist/centrifuge.min.js"></script>

<script>


    $(document).ready(function () {
        const id = $('#tournament-id').data('id');
        const levelElement = $('#tournament-level');
        const playersElement = $('#tournament-players');
        const addonsElement = $('#tournament-addons');
        const rebuysElement = $('#tournament-rebuys');
        const totalPriceElement = $('#tournament-total-price');
        const clockElement = $('#clock');
        const sbElement = $('#tournament-sb');
        const bbElement = $('#tournament-bb');
        const anteElement = $('#tournament-ante');
        const nextSbElement = $('#tournament-next-sb');
        const nextBbElement = $('#tournament-next-bb');
        const payoutsElement = $('#tournament-payouts');
        const averageStack = $('#average-stack');
        const playersLost = $('#tournament-players-lost');





        // firsts init
        refreshTournamentBoard();

        // инициализируем таймер
        let timeBank = clockElement.data('countdown');
        clockElement.countdown(timeBank, function(event) {
            var $this = $(this).html(event.strftime(''
                + '<span>%H</span> : '
                + '<span>%M</span> : '
                + '<span>%S</span>'));
        }).on('finish.countdown', function(event) {
            ajaxNextBlindLevel();
            const audio = new Audio('/audio/nextlevelup.mp3');
            audio.play();
        });

        if (clockElement.hasClass('stop')) {
            clockElement.countdown('{{$tournament->timeBank}}');
            clockElement.countdown('pause');
        }


        /*marque*/
        const marqueeElement = $(".tournament-payouts-wrapper");
        if($('#tournament-payouts').height() > $('.tournament-payouts-wrapper').height()) {
            marqueeElement.marquee({
                delayBeforeStart: 0,
                startVisible: true,
                gap: 80,
            });
        }
        /*end marque*/


    function ajaxNextBlindLevel() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{ route('tournament.nextLevel') }}",
            data: {id: id},
            success: function () {
                secondFunction();
                async function secondFunction(){
                    await refreshTournamentBoard();
                }
            }
        });
    }





    $('#btn-refresh').on('click', function (e) {
        e.preventDefault();
        refreshTournamentBoard();
    });

        const url = "ws://" + window.location.host + ":8000/connection/websocket";
        const centrifuge = new Centrifuge(url);
        centrifuge.setToken('{{ $token }}');
        centrifuge.subscribe("tournament.{{ $tournament->id }}", function(ctx) {
            if(ctx.data.event === 'App\\Events\\RefreshTournamentBoardEvent') {
                levelElement.text(ctx.data.tournament.level);
                playersElement.text(ctx.data.tournament.total_players);
                addonsElement.text(ctx.data.tournament.addons);
                rebuysElement.text(ctx.data.tournament.rebuys);
                averageStack.text(ctx.data.tournament.averageStack.toLocaleString('en-US'));
                playersLost.text(ctx.data.tournament.playersLost);
                totalPriceElement.text(ctx.data.tournament.prizePool.toLocaleString('en-US'));
                sbElement.text(ctx.data.tournament.blinds.smallBlind.toLocaleString('en-US'));
                bbElement.text(ctx.data.tournament.blinds.bigBlind.toLocaleString('en-US'));
                anteElement.text(ctx.data.tournament.blinds.ante.toLocaleString('en-US'));
                nextSbElement.text(ctx.data.tournament.nextBlinds.smallBlind.toLocaleString('en-US'));
                nextBbElement.text(ctx.data.tournament.nextBlinds.bigBlind.toLocaleString('en-US'));

                marqueeElement.marquee('destroy');
                $('#tournament-payouts').empty();
                if(ctx.data.tournament.payments != null){
                    $.each( ctx.data.tournament.payments, function(place, pay){
                        $('#tournament-payouts').append('<tr><td>'+place+'</td><td>'+pay.pay.toLocaleString('en-US')+'</td></tr>');
                    });

                    if($('#tournament-payouts').height() > $('.tournament-payouts-wrapper').height()) {
                        marqueeElement.marquee({
                            delayBeforeStart: 0,
                            startVisible: true,
                            gap: 80,
                        });
                    }
                }
            }
            if(ctx.data.event === 'App\\Events\\RefreshTournamentTimeEvent') {
                levelElement.text(ctx.data.level);
                clockElement.countdown(ctx.data.timeBank);
                if(ctx.data.status === 'play') {
                    clockElement.countdown('resume');
                } else {
                    clockElement.countdown('pause');
                }
            }
        });
        centrifuge.connect();


    async function refreshTournamentBoard() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{ route('tournament.refreshTournamentBoard') }}",
            data: {id: id},
            success: function (data) {
                levelElement.text(data.level);
                playersElement.text(data.total_players);
                addonsElement.text(data.addons);
                rebuysElement.text(data.rebuys);
                averageStack.text(data.averageStack.toLocaleString('en-US'));
                playersLost.text(data.playersLost);
                totalPriceElement.text(data.prizePool.toLocaleString('en-US'));
                sbElement.text(data.blinds.smallBlind.toLocaleString('en-US'));
                bbElement.text(data.blinds.bigBlind.toLocaleString('en-US'));
                anteElement.text(data.blinds.ante.toLocaleString('en-US'));
                nextSbElement.text(data.nextBlinds.smallBlind.toLocaleString('en-US'));
                nextBbElement.text(data.nextBlinds.bigBlind.toLocaleString('en-US'));
                clockElement.countdown(data.timeBank);

                if(data.status === 'play') {
                    clockElement.countdown('resume');
                } else {
                    clockElement.countdown('pause');
                }

                marqueeElement.marquee('destroy');
                $('#tournament-payouts').empty();
                if(data.payments != null){
                    $.each( data.payments, function(place, pay){
                        $('#tournament-payouts').append('<tr><td>'+place+'</td><td>'+pay.pay.toLocaleString('en-US')+'</td></tr>');
                    });

                    if($('#tournament-payouts').height() > $('.tournament-payouts-wrapper').height()) {
                        marqueeElement.marquee({
                            delayBeforeStart: 0,
                            startVisible: true,
                            gap: 80,
                        });
                    }
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
        return;
    }

        let fullscreenHandler = document.querySelector(".fullscreenButton");

        fullscreenHandler.addEventListener("click", () => {
            document.documentElement.requestFullscreen();
            toggleFullscreen();
        });

        const toggleFullscreen = () => {
            if (document.fullscreenEnabled) {
                if (document.fullscreenElement) {
                    $('.fullscreenButton').attr('uk-icon', "expand");
                    document.exitFullscreen();
                } else {
                    $('.fullscreenButton').attr('uk-icon', "shrink");
                    document.documentElement.requestFullscreen();
                }
            } else {
                alert("Fullscreen is not supported!");
            }
        };
    });


</script>




</body>
</html>
