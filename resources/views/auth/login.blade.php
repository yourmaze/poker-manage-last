@extends('layouts.app', ['title' => 'Вход в панель управления'])

@section('content')

    <div class="uk-grid">
        <div class="uk-width-1-3@m uk-width-1-1">
            <div class="uk-padding-large">
                <div class="login-form">
                    <div class="login-form__title">
                        <img src="/favicon.png" alt="" style="width: 44px;">
                        -30 Hold`em helper
                    </div>
                    <h1>Добро пожаловать</h1>
                    <div class="login-form__text">Для использования программы нужно выполнить вход. Регистрация в данном сервисе взможна только администратором системы.</div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="uk-margin">
                            <div class="uk-inline uk-width-1-1">
                                <span class="uk-form-icon uk-position-z-index" uk-icon="icon: user"></span>
                                <input id="email" type="text" class="uk-input{{ $errors->has('name') ? ' uk-form-danger' : '' }}" name="name" value="{{ old('name') }}" required>
                            </div>
                        </div>

                        <div class="uk-margin">
                            <div class="uk-inline uk-width-1-1">
                                <span class="uk-form-icon uk-position-z-index" uk-icon="icon: lock"></span>
                                <input id="password" type="password" class="uk-input{{ $errors->has('password') ? ' uk-form-danger' : '' }}" name="password" required>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <input class="uk-checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="uk-form-label">Запомнить меня</label>
                        </div>

                        <div class="uk-margin">
                            <button type="submit" class="uk-button uk-button-primary uk-width-1-3">Войти</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="uk-width-2-3@m uk-visible@m">
            <div class="login-info uk-text-center">
                <img src="/img/poker-logo.png" alt="">
            </div>
        </div>
    </div>

@endsection
