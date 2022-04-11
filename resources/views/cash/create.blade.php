@extends('layouts.dashboard', ['title' => 'Создание кэш игры'])


@section('content')
    <form method="POST" action="{{ route('cash.store') }}">
        @csrf

        @include('include.alert')

        <div class="uk-grid uk-flex-center">

            <div class="uk-width-1-1 uk-flex uk-flex-between uk-margin-bottom">
                <ul class="uk-breadcrumb">
                    <li><a href="{{ route('home') }}">Главная</a></li>
                    <li><a href="{{ route('cash.index') }}">Кэш игры</a></li>
                    <li><span>Создание кэш игры</span></li>
                </ul>
            </div>


            <div class="uk-width-2-3@m uk-width-1-1">
                <div class="uk-card uk-card-default uk-card-body">

                    <div class="uk-margin-bottom uk-flex uk-flex-left uk-flex-middle">
                        <button class="uk-button uk-button-primary" type="submit"><span class="uk-margin-small-right uk-icon" uk-icon="refresh"><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="refresh"><path fill="none" stroke="#000" stroke-width="1.1" d="M17.08,11.15 C17.09,11.31 17.1,11.47 17.1,11.64 C17.1,15.53 13.94,18.69 10.05,18.69 C6.16,18.68 3,15.53 3,11.63 C3,7.74 6.16,4.58 10.05,4.58 C10.9,4.58 11.71,4.73 12.46,5"></path><polyline fill="none" stroke="#000" points="9.9 2 12.79 4.89 9.79 7.9"></polyline></svg></span>Создать</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <script>
            $('.remove-level').on('click', function (){
                $(this).closest('.blind-element').hide('slow', function () {
                    const remEl = $(this).closest('.blind-element');
                    remEl.remove();
                });
            });


            $(document).ready(function () {
                const blindElement = $('.blind-element');
                $('form').submit(function(){
                    let i = 1;
                    let blindJson = '{'
                    blindElement.each(function(el) {
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
            });

    </script>

@endsection
