@extends('layouts.dashboard', ['title' => 'Создание турнира'])


@section('content')

    <form method="POST" action="{{ route('tournament.store') }}">
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


            <div class="uk-width-1-1">
                <div class="uk-card uk-card-default uk-card-body uk-padding-large-xl">
                    <div class="uk-grid uk-flex-center">
                        <div class="uk-width-2-3@xl uk-width-3-4@l">
                            <div class="uk-grid">
                                <div class="uk-width-1-1 uk-margin-medium">
                                    <div class="uk-text-center">
                                        <label class="uk-form-label" for="form-stacked-text">Название турнира</label>
                                        <div class="uk-form-controls uk-margin-small-top">
                                            <div class="uk-inline">
                                                <span class="uk-form-icon">
                                                    <i class="fal fa-file-signature fa-lg"></i>
                                                </span>
                                                <input class="uk-input uk-form-width-large" type="text" name="name" placeholder="Название турнира" value="{{ old('name', null) === null ? $tournamentTemplate->name : old('name') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-width-1-2@m uk-flex uk-flex-wrap uk-flex-right@l">

                                    <div class="uk-margin-medium-bottom">
                                        <label class="uk-form-label" for="form-stacked-text">Длительность уровней</label>
                                        <div class="uk-form-controls uk-margin-small-top">
                                            <div class="uk-inline">
                                                <span class="uk-form-icon"><i class="fal fa-clock fa-lg"></i></span>
                                                <input class="uk-input uk-form-width-medium" type="text" name="blind_time" placeholder="Длительность уровней" value="{{ old('blind_time', null) === null ? $tournamentTemplate->blind_time : old('blind_time') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-margin-medium-bottom">
                                        <label class="uk-form-label" for="form-stacked-text">Цена за ребай</label>
                                        <div class="uk-form-controls uk-margin-small-top">
                                            <div class="uk-inline">
                                                <span class="uk-form-icon">
                                                    <i class="fal fa-usd-circle fa-lg"></i>
                                                </span>
                                                <input class="uk-input uk-form-width-medium" type="text" name="price" placeholder="Цена за ребай" value="{{ old('price', null) === null ? $tournamentTemplate->price : old('price') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-margin-medium-bottom">
                                        <label class="uk-form-label" for="form-stacked-text">Цена за аддон</label>
                                        <div class="uk-form-controls uk-margin-small-top">
                                            <div class="uk-inline">
                                                <span class="uk-form-icon">
                                                    <i class="fal fa-usd-circle fa-lg"></i>
                                                </span>
                                                <input class="uk-input uk-form-width-medium" type="text" name="addon_price" placeholder="Цена за аддон" value="{{ old('addon_price', null) === null ? $tournamentTemplate->addon_price : old('addon_price') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-width-1-2@m">
                                    <div class="uk-margin-medium">
                                        <label class="uk-form-label" for="form-stacked-text">Размер обычного стека</label>
                                        <div class="uk-form-controls uk-margin-small-top">
                                            <div class="uk-inline">
                                                <span class="uk-form-icon">
                                                    <i class="fal fa-coin fa-lg"></i>
                                                </span>
                                                <input class="uk-input uk-form-width-medium" type="text" name="usual_stack" placeholder="Обычный стек" value="{{ old('usual_stack', null) === null ? $tournamentTemplate->usual_stack : old('usual_stack') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-margin-medium">
                                        <label class="uk-form-label" for="form-stacked-text">Размер бонусного стека</label>
                                        <div class="uk-form-controls uk-margin-small-top">
                                            <div class="uk-inline">
                                                <span class="uk-form-icon">
                                                    <i class="fal fa-coins fa-lg"></i>
                                                </span>
                                                <input class="uk-input uk-form-width-medium" type="text" name="bonus_stack" placeholder="Бонусный стек" value="{{ old('bonus_stack', null) === null ? $tournamentTemplate->bonus_stack : old('bonus_stack') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-margin-medium">
                                        <label class="uk-form-label" for="form-stacked-text">Размер при покупке аддона</label>
                                        <div class="uk-form-controls uk-margin-small-top">
                                            <div class="uk-inline">
                                                <span class="uk-form-icon">
                                                    <i class="fad fa-coin fa-lg"></i>
                                                </span>
                                                <input class="uk-input uk-form-width-medium" type="text" name="addon_stack" placeholder="Cтек при покупке аддона" value="{{ old('addon_stack', null) === null ? $tournamentTemplate->addon_stack : old('addon_stack') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-width-1-1">
                                    <div class="uk-text-center">
                                        <button href="#toggle-animation" class="uk-margin-medium-top uk-button uk-button-default uk-margin-small-bottom" type="button" uk-toggle="target: #toggle-animation; animation: uk-animation-fade">Редактировать блайнды</button>
                                    </div>
                                    <div id="toggle-animation" class="uk-card uk-card-default uk-card-body uk-margin-small" hidden>
                                        <div class="uk-grid-small" uk-grid>
                                            <div class="uk-width-1-5@s">
                                                <ul class="uk-list uk">
                                                    @for ($i = 1; $i <= 30; $i++)
                                                        <li class="uk-flex uk-flex-middle uk-margin-remove-top he85">Уровень {{ $i }}</li>
                                                    @endfor
                                                </ul>
                                            </div>
                                            <div class="uk-width-4-5@s">
                                                <ul id="blind-list" class="uk-nav uk-nav-default" uk-sortable="handle: .uk-sortable-handle">
                                                    @foreach($tournamentTemplate->new_blinds_structure as $blindsStructure)
                                                        <li class="blind-element he85">
                                                            <div class="uk-card uk-card-default uk-card-body uk-flex uk-flex-middle">
                                                                <span class="uk-sortable-handle uk-margin-small-right uk-text-center"><i class="fal fa-arrows fa-lg"></i></span>
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
                                                                <span class="remove-level uk-text-center uk-margin-small-left" style="cursor: pointer"><i class="fal fa-trash-alt fa-lg"></i></span>
                                                            </div>
                                                        </li>
                                                    @endforeach

                                                    <li id="add-level" class="he85 uk-float-right uk-flex uk-flex-middle" style="cursor: pointer">
                                                        <div class="uk-button uk-button-primary uk-flex uk-flex-middle">
                                                            <div class="uk-margin-small-right uk-color-white"><span class="uk-icon"><i class="fal fa-plus fa-lg"></i></span></div>
                                                            <div class="uk-text-normal">Добавить уровень</div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                    </div>

                                    <input id="blind-structure-output" class="uk-hidden" type="text" name="blinds_structure" value="{{ $tournamentTemplate->blinds_structure }}">


                                    <div class="uk-margin-bottom uk-flex uk-flex-center uk-flex-middle">
                                        <button class="uk-button uk-button-primary uk-form-width-medium" type="submit">Сохранить</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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

            $('#add-level').on('click', function (){
                const html = '<li class="blind-element he85"> <div class="uk-card uk-card-default uk-card-body uk-flex uk-flex-middle"> <span class="uk-sortable-handle uk-margin-small-right uk-text-center"><i class="fal fa-arrows fa-lg"></i></span> <div class="uk-width-1-1 uk-grid-small" uk-grid> <div class="uk-width-2-5@s"> <input class="uk-input blind-element__small" type="text" placeholder="Малый блайнд" value="0"> </div> <div class="uk-width-2-5@s"> <input class="uk-input blind-element__big" type="text" placeholder="Большой блайнд" value="0"> </div> <div class="uk-width-1-5@s"> <input class="uk-input blind-element__ante" type="text" placeholder="Анте" value="0"> </div> </div> <span class="remove-level uk-text-center uk-margin-small-left" style="cursor: pointer"><i class="fal fa-trash-alt fa-lg"></i></span> </div> </li>';
                $('#add-level').before(html);
            });


            $('form').submit(function(e){
                e.preventDefault();
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

                $('form').removeAttr('onsubmit');
                $('form').submit();
            });

    </script>

@endsection
