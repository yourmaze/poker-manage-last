@extends('layouts.dashboard', ['title' => 'Редактирование турнира'])


@section('content')
    <form method="POST" action="{{ route('tournament.update', $tournament->id) }}">
        @method('PATCH')
        @csrf

        @include('include.alert')

        <div class="uk-grid uk-flex-center">

            <div class="uk-width-1-1 uk-flex uk-flex-between uk-margin-bottom">
                <ul class="uk-breadcrumb">
                    <li><a href="{{ route('home') }}">Главная</a></li>
                    <li><a href="{{ route('tournament.index') }}">Турниры</a></li>
                    <li><span>Создание турнира</span></li>
                </ul>
            </div>


            <div class="uk-width-2-3@m uk-width-1-1">
                <div class="uk-card uk-card-default uk-card-body">

                    <div class="uk-margin">
                        <div class="uk-inline">
                            <span class="uk-form-icon" uk-icon="icon: users"></span>
                            <input class="uk-input" type="text" name="name" placeholder="Название турнира" value="{{ old('name', null) === null ? $tournament->name : old('name') }}">
                        </div>
                    </div>

                    <input class="uk-hidden" type="text" name="user_id" value="1">

                    @if ($tournament->new_payments)
                    <button href="#toggle-prize-pool" class="uk-button uk-button-default uk-margin-small-bottom" type="button" uk-toggle="target: #toggle-prize-pool; animation: uk-animation-fade">Призы</button>
                    <div id="toggle-prize-pool" class="uk-card uk-card-default uk-card-body uk-margin-small" hidden>
                        <div class="uk-grid-small" uk-grid>
                            <div class="uk-width-1-5@s">
                                <ul class="uk-list uk">
                                    @foreach($tournament->new_payments as $i => $new_payment)
                                        <li class="uk-flex uk-flex-middle uk-margin-remove-top he50">Место {{ $i }} </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="uk-width-4-5@s">
                                <ul class="uk-nav uk-nav-default">
                                    @foreach($tournament->new_payments as $new_payment)
                                        <li class="prize-element he50">
                                            <div class="uk-flex uk-flex-middle">
                                                <input class="uk-input prize-element__pay" type="text" placeholder="Выплата за место" value="{{$new_payment['pay']}}">
                                                <span class="remove-level uk-text-center uk-margin-small-left" uk-icon="icon: trash" style="cursor: pointer"></span>
                                            </div>
                                        </li>
                                    @endforeach
                                        <li class="add-prize-element he85 uk-flex uk-flex-middle" style="cursor: pointer">
                                            <div class="uk-button uk-button-primary uk-flex uk-flex-middle">
                                                <div class="uk-margin-small-right uk-color-white"><span class="uk-icon" uk-icon="plus"></span></div>
                                                <div class="uk-text-normal">Добавить призовое место</div>
                                            </div>
                                        </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <input id="prize-structure-output" class="uk-hidden" type="text" name="payments" value="{{ $tournament->new_payment }}">
                    @endif

                    <button href="#toggle-blinds" class="uk-button uk-button-default uk-margin-small-bottom" type="button" uk-toggle="target: #toggle-blinds; animation: uk-animation-fade">Блайнды</button>
                    <div id="toggle-blinds" class="uk-card uk-card-default uk-card-body uk-margin-small" hidden>
                        <div class="uk-grid-small" uk-grid>
                            <div class="uk-width-1-5@s">
                                <ul class="uk-list uk">
                                    @php $i = 1; @endphp
                                    @foreach($tournament->new_blinds_structure as $blindsStructure)
                                        <li class="uk-flex uk-flex-middle uk-margin-remove-top he85">Уровень {{ $i++ }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="uk-width-4-5@s">
                                <ul id="blind-list" class="uk-nav uk-nav-default" uk-sortable="handle: .uk-sortable-handle">
                                    @foreach($tournament->new_blinds_structure as $blindsStructure)
                                        <li class="blind-element he85">
                                            <div class="uk-card uk-card-default uk-card-body uk-flex uk-flex-middle">
                                                <span class="uk-sortable-handle uk-margin-small-right uk-text-center" uk-icon="icon: table"></span>
                                                <div class="uk-width-1-1 uk-grid-small" uk-grid>
                                                    <div class="uk-width-2-5@s">
                                                        <input class="uk-input blind-element__small" type="text" placeholder="Малый блайнд" value="{{$blindsStructure['smallBlind']}}">
                                                    </div>
                                                    <div class="uk-width-2-5@s">
                                                        <input class="uk-input blind-element__big" type="text" placeholder="Большой блайнд" value="{{$blindsStructure['bigBlind']}}">
                                                    </div>
                                                    <div class="uk-width-1-5@s">
                                                        <input class="uk-input blind-element__ante" type="text" placeholder="Анте" value="{{$blindsStructure['ante']}}">
                                                    </div>
                                                </div>
                                                <span class="remove-level uk-text-center uk-margin-small-left" uk-icon="icon: trash" style="cursor: pointer"></span>
                                            </div>
                                        </li>
                                    @endforeach

                                    <li class="add-blind-element he85 uk-flex uk-flex-middle" style="cursor: pointer">
                                        <div class="uk-button uk-button-primary uk-flex uk-flex-middle">
                                            <div class="uk-margin-small-right uk-color-white"><span class="uk-icon" uk-icon="plus"></span></div>
                                            <div class="uk-text-normal">Добавить уровень</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>

                    <input id="blind-structure-output" class="uk-hidden" type="text" name="blinds_structure" value="{{ $tournament->blinds_structure }}">


                    <div class="uk-margin-bottom uk-flex uk-flex-left uk-flex-middle">
                        <button class="uk-button uk-button-primary" type="submit"><span class="uk-margin-small-right uk-icon" uk-icon="refresh"><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="refresh"><path fill="none" stroke="#000" stroke-width="1.1" d="M17.08,11.15 C17.09,11.31 17.1,11.47 17.1,11.64 C17.1,15.53 13.94,18.69 10.05,18.69 C6.16,18.68 3,15.53 3,11.63 C3,7.74 6.16,4.58 10.05,4.58 C10.9,4.58 11.71,4.73 12.46,5"></path><polyline fill="none" stroke="#000" points="9.9 2 12.79 4.89 9.79 7.9"></polyline></svg></span>Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <script>

        $('body').on('click', '.remove-level', function (){
            $(this).closest('li').hide('slow', function () {
                const remEl = $(this).closest('li');
                remEl.remove();
            });
        });

        $('.add-blind-element').on('click', function (){
            const html = '<li class="blind-element he85"> <div class="uk-card uk-card-default uk-card-body uk-flex uk-flex-middle"> <span class="uk-sortable-handle uk-margin-small-right uk-text-center" uk-icon="icon: table"></span> <div class="uk-width-1-1 uk-grid-small" uk-grid> <div class="uk-width-2-5@s"> <input class="uk-input blind-element__small" type="text" placeholder="Малый блайнд" value="0"> </div> <div class="uk-width-2-5@s"> <input class="uk-input blind-element__big" type="text" placeholder="Большой блайнд" value="0"> </div> <div class="uk-width-1-5@s"> <input class="uk-input blind-element__ante" type="text" placeholder="Анте" value="0"> </div> </div> <span class="remove-level uk-text-center uk-margin-small-left" uk-icon="icon: trash" style="cursor: pointer"></span> </div> </li>';
            $(this).before(html);
        });

        $('.add-prize-element').on('click', function (){
            const html = '<li class="prize-element he50"> <div class="uk-flex uk-flex-middle"> <input class="uk-input prize-element__pay" type="text" placeholder="Выплата за место" value="0"> <span class="remove-level uk-text-center uk-margin-small-left" uk-icon="icon: trash" style="cursor: pointer"></span> </div> </li>';
            $(this).before(html);
        });

        $('form').submit(function(e){
            e.preventDefault();
            getBlindJson();
            getPrizePoolJson();
            $('form').submit();
        });

        function getPrizePoolJson() {
            let i = 1;
            let prizeJson = '{'
            $('.prize-element').each(function() {
                if(i !== 1) {
                    prizeJson += ',';
                }
                const prize = $(this).find('.prize-element__pay').val();
                let elementJson = '"'+i+'": {"pay":'+prize+'}';
                prizeJson += elementJson;
                i++;
            });
            prizeJson += '}';
            console.log(prizeJson);
            $('#prize-structure-output').val(prizeJson);
        }

        function getBlindJson() {
            let i = 1;
            let blindJson = '{'
            $('.blind-element').each(function(el) {
                if(i !== 1) {
                    blindJson += ',';
                }
                const small = $(this).find('.blind-element__small').val();
                const big = $(this).find('.blind-element__big').val();
                const ante = $(this).find('.blind-element__ante').val();
                let elementJson = '"'+i+'": {"smallBlind":'+small+', "bigBlind":'+big+', "ante":'+ante+'}';
                blindJson += elementJson;
                i++;
            });
            blindJson += '}';
            $('#blind-structure-output').val(blindJson);
        }

    </script>

@endsection
