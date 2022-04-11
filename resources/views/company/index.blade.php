@extends('layouts.dashboard')


@section('content')
    <section id="company-edit">
        @include('include.alert')

        <div class="uk-grid uk-flex-center">
            <div class="uk-width-1-1 uk-flex uk-flex-between uk-margin-bottom">
                <ul class="uk-breadcrumb">
                    <li><a href="{{ route('home') }}">Главная</a></li>
                    <li><span>Информация о компании</span></li>
                </ul>
            </div>
        </div>
        <form method="POST" action="{{ route('company.update', $company->id) }}">
            @method('PATCH')
            @csrf
            <div class="uk-grid uk-flex-center">
                <div class="uk-width-1-1">
                    <div class="uk-grid">
                        <div class="uk-width-1-4@l">
                            <ul class="uk-tab-left uk-margin-medium-top" uk-tab="connect: #component-tabs; animation: uk-animation-fade">
                                <li>
                                    <a href="#">
                                        <span class="icon-wrap"><i class="fal fa-user fa-2x"></i></span> Общая
                                    </a>
                                </li>
                                @role('main-administrator', 'administrator')
                                <li>
                                    <a href="#">
                                        <span class="icon-wrap"><i class="fal fa-tv fa-2x"></i></span> Турниры
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="icon-wrap"><i class="fal fa-money-bill-alt fa-2x"></i></span> Кэш игры
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="icon-wrap"><i class="fal fa-users fa-2x"></i></span> Команда
                                    </a>
                                </li>
                                @endrole
                            </ul>
                        </div>
                        <div class="uk-width-3-4@l">
                            <ul id="component-tabs" class="uk-switcher">
                                <li>
                                    <div class="uk-card uk-card-default uk-card-body uk-padding-large-xl">
                                        <h3>Информация о компании</h3>
                                        <div class="uk-flex uk-flex-right uk-flex-middle">
                                            <button class="uk-button uk-button-primary uk-form-width-medium" type="submit">Сохранить</button>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="uk-card uk-card-default uk-card-body uk-padding-large-xl">
                                        <h3>Турнирные настройки</h3>
                                        <div class="uk-margin-medium-bottom">
                                            <label class="uk-form-label" for="form-stacked-text">Процент рейка за турнир</label>
                                            <div class="uk-form-controls uk-margin-small-top">
                                                <div class="uk-inline">
                                                            <span class="uk-form-icon">
                                                                <i class="fad fa-badge-percent fa-lg"></i>
                                                            </span>
                                                    <input class="uk-input uk-form-width-medium" type="text" name="tournament_rake_percent" placeholder="Процент рейка за турнир" value="{{ old('tournament_rake_percent', null) === null ? $company->tournament_rake_percent : old('tournament_rake_percent') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-flex uk-flex-right uk-flex-middle">
                                            <button class="uk-button uk-button-primary uk-form-width-medium" type="submit">Сохранить</button>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="uk-card uk-card-default uk-card-body uk-padding-large-xl">
                                        <h3>Кэш игры</h3>
                                        <div class="uk-flex uk-flex-right uk-flex-middle">
                                            <button class="uk-button uk-button-primary uk-form-width-medium" type="submit">Сохранить</button>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="uk-card uk-card-default uk-card-body uk-padding-large-xl">
                                        <h3>Команда</h3>
                                        <div class="uk-flex uk-flex-right uk-flex-middle">
                                            <button class="uk-button uk-button-primary uk-form-width-medium" type="submit">Сохранить</button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
