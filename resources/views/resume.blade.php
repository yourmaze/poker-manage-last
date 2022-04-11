<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
    <link href="{{ asset('css/resume.css') }}" rel="stylesheet">

@stack('styles')

<!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    @stack('scripts')

    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
</head>
<body class="@php if(Cookie::get('show_sidebar')) echo 'sidebar-show'; @endphp">
<div id="dashboard" class="uk-grid" uk-height-viewport="expand: true">

    <div class="uk-width-expand">
        <div id="example"></div>
        <div class="dashboard-header" uk-sticky="top: 1;media: 960">

            <h1 id="page-title" class="uk-margin-remove-bottom">@isset($title) {{ $title }} @else Резюме @endisset</h1>

            <div class="uk-flex uk-flex-middle">
                <div id="print-pdf">
                    <a href="/documents/Resume.pdf" target="_blank"><i class="fad fa-print fa-lg"></i></a>
                </div>
                <div class="header-user">
                    <div class="header-language"><a href="/resume-en">EN</a> | <a href="/resume" class="active">RU</a></div>
                </div>
            </div>

        </div>
        <div class="resume">
            <div class="uk-container">
                <div class="uk-card uk-card-default uk-margin-large-top">
                    <div class="uk-card-body">
                        <div class="resume__head">
                            <div class="uk-grid uk-flex-middle">
                                <div class="uk-width-1-2@m">
                                    <div class="resume__head__name uk-margin-bottom">Алтабасов<br> Семен</div>
                                    <div class="resume__head__who uk-text-muted">Full-stack Программист</div>
                                </div>
                                <div class="uk-width-1-2@m">
                                    <div class="uk-text-right@m uk-text-center">
                                        <div class="resume__head__location uk-margin-small-bottom"><span class="uk-margin-small-right"><i class="fad fa-map-marker-alt"></i></span>КРАСНОЯРСК</div>
                                        <div class="uk-margin-small-bottom"><span class="uk-margin-small-right"><i class="fad fa-envelope"></i></span> web-dekor@yandex.ru</div>
                                        <div class="resume__head__phone"><span class="uk-margin-small-right"><i class="fad fa-phone"></i></span> +7(953) 854-11-49</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="resume__body">
                            <div class="uk-grid">
                                <div class="uk-width-1-3@m">
                                    <div class="resume__left-cell">
                                        <h2>личная информация</h2>
                                        <div class="uk-margin-medium-bottom">
                                            <div class="uk-margin-small-bottom"><span class="uk-text-muted">Дата рождения:</span> 17.09.1992 (29 лет)</div>
                                            <div class="uk-margin-small-bottom"><span class="uk-text-muted">Гражданство:</span> Российская Федерация</div>
                                            <div class="uk-margin-small-bottom"><span class="uk-text-muted">Образование:</span> Высшее</div>
                                            <div class="uk-margin-small-bottom"><span class="uk-text-muted">Семейное положение:</span> женат</div>
                                        </div>

                                        <hr>

                                        <h2>Образование</h2>
                                        <div class="uk-margin-medium-bottom">
                                            <div class="resume__education__year uk-text-muted uk-text-small uk-margin-small-bottom">2012</div>
                                            <div class="resume__education__degree uk-margin-small-bottom">БАКАЛАВРИАТ</div>
                                            <div class="resume__education__university uk-margin-small-bottom">Сибирский федеральный университет, Красноярск</div>
                                            <div class="resume__education__specialization uk-text-muted">
                                                Информатика и вычислительная техника
                                                (Программное обеспечение вычислительной техники и автоматизированных систем)
                                            </div>
                                        </div>

                                        <div class="uk-margin-medium-bottom">
                                            <div class="resume__education__year uk-text-muted uk-text-small uk-margin-small-bottom">2014</div>
                                            <div class="resume__education__degree uk-margin-small-bottom">МАГИСТРАТУРА <span class="uk-text-small uk-text-muted">с отличием</span></div>
                                            <div class="resume__education__university uk-margin-small-bottom">Сибирский федеральный университет, Красноярск</div>
                                            <div class="resume__education__specialization uk-text-muted">
                                                Информатика и вычислительная техника
                                                (Микропроцессорные системы)
                                            </div>
                                        </div>
                                        <hr>

                                        <h2>Профессиональные навыки</h2>
                                        <div class="uk-margin-medium-bottom">
                                            <h3>//BACKEND</h3>
                                            <ul class="uk-list uk-list-bullet">
                                                <li>Php 8</li>
                                                <li>опыт работы с фреймворками Laravel, Yii</li>
                                                <li>MySql</li>
                                                <li>Redis</li>
                                                <li>разработка Telegram ботов</li>
                                                <li>построение REST API</li>
                                            </ul>
                                            <h3>//CMS</h3>
                                            <ul class="uk-list uk-list-bullet">
                                                <li>WordPress</li>
                                                <li>Opencart</li>
                                                <li>Joomla</li>
                                            </ul>
                                            <h3>//FRONTEND</h3>
                                            <ul class="uk-list uk-list-bullet">
                                                <li>опыт работы с HTML5, CSS3;</li>
                                                <li>знание SASS, LESS</li>
                                                <li>опыт в Bootstrap, UiKit</li>
                                                <li>знание JS/JQuery</li>
                                                <li>опыт работы с VUE</li>
                                                <li>опыт верстки сайтов и шаблонов для CMS</li>
                                                <li>опыт создания адаптивной кроссбраузерной верстки</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-width-2-3@m line">
                                    <div class="resume__right-cell resume__experience">
                                        <h2>Опыт работы</h2>
                                        <div class="resume__experience__head">
                                            <div class="resume__experience__years">Июль 2014 - <br>Май 2017</div>
                                            <div class="resume__experience__company">
                                                <div class="resume__company__name">«WebWolf»</div>
                                                <div class="resume__company__who">Web-разработчик</div>
                                            </div>
                                        </div>
                                        <div class="resume__experience__body">
                                            <p>Обязанности:</p>
                                            <ul class="uk-list uk-list-bullet uk-margin-medium-bottom">
                                                <li>fullstack разработка сайтов на Wordpress, Opencart, Joomla;</li>
                                                <li>разработка новых веб-сервисов на Yii, Laravel;</li>
                                                <li>выполнение рекомендаций SEO специалистов;</li>
                                                <li>ведение разработки frontend и backend частей;</li>
                                            </ul>

                                            <p>За время работы:</p>
                                            <ul class="uk-list uk-list-bullet">
                                                <li>- разработал более 120 сайтов различной сложности;</li>
                                                <li>- за первый год стал руководителем отдела разработки;</li>
                                                <li>- все разработанные сайты разрабатывались с нуля, без использования шаблонов и конструкторов;</li>
                                                <li>- разрабатывал и внедрял функционал для несколких крупных проектов, например roomelectro.ru( более 100.000 посещений в день)</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="resume__right-cell resume__experience">
                                        <div class="resume__experience__head">
                                            <div class="resume__experience__years">Май 2017 - <br>настоящее время</div>
                                            <div class="resume__experience__company">
                                                <div class="resume__company__name">«Minus30»</div>
                                                <div class="resume__company__who">Development Team Lead</div>
                                            </div>
                                        </div>
                                        <div class="resume__experience__body">
                                            <p>Обязанности:</p>
                                            <ul class="uk-list uk-list-bullet uk-margin-medium-bottom">
                                                <li>- разработка сложных веб-сервисов на Laravel;</li>
                                                <li>- разработка архитектуры баз данных;</li>
                                                <li>- рефакторинг кода;</li>
                                                <li>- fullstack разработка сайтов на Wordpress, Opencart, Joomla.</li>
                                            </ul>

                                            <p>За время работы лично мной:</p>
                                            <ul class="uk-list uk-list-bullet">
                                                <li>Была разработана система управления клиентами компании</li>
                                                <li>Разработано несколько сложных REST API систем</li>
                                                <li>Написано два Android приложения на JAVA</li>
                                                <li>Разработано несколько десятков сайтов для компаний клиентов</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <hr>

                                    <h2>Портфолио</h2>

                                    <div class="resume__right-cell resume__experience">
                                        <div class="resume__experience__head">
                                            <div class="uk-margin-small-bottom">
                                                <div class="resume__company__name uk-text-bold"><span class="uk-text-large">1. </span> <span> Разработка CRM для управления клиентами студии</span></div>
                                                <div class="uk-text-muted">Php, HTML, CSS, Blade, Sass, Javascript</div>
                                            </div>
                                        </div>
                                        <div class="resume__experience__body">
                                            <p> Часть функционала:</p>
                                            <ul class="uk-list uk-list-bullet uk-margin-medium-bottom">
                                                <li>- Добавление и управление клиентами студии</li>
                                                <li>- Мониторинг работоспособности сайтов клиентов посредством проверки ответа сервера и/или проверки наличия определенного метатега</li>
                                                <li>- Добавление и мониторинг данных о рекламных бюджетах клиентов, через Яндекс.Директ Api.</li>
                                                <li>- Оповещения менеджерам в мессенджере Telegram о недоступности сайта и/или недостаточном остатке средств на рекламном бюджете.</li>
                                                <li>- Мониторинг платежей реккурентных клиентов и автоматическое отправление счетов на оплату на почту.</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="resume__right-cell resume__experience">
                                        <div class="resume__experience__head">
                                            <div class="uk-margin-small-bottom">
                                                <div class="resume__company__name uk-text-bold"><span class="uk-text-large">2. </span> <span> SAAS CRM для управления игрой в покер</span> <br> <span class="uk-text-muted">Сервис еще находится на этапе разработки</span></div>
                                                <div class="uk-text-muted uk-margin-small-bottom">Php, HTML, CSS, Blade, Sass, Javascript, Vue</div>
                                                <div><a href="http://poker-manage.com" target="_blank">poker-manage.com</a></div>
                                            </div>
                                        </div>
                                        <div class="resume__experience__body">
                                            <p> Часть функционала:</p>
                                            <ul class="uk-list uk-list-bullet uk-margin-medium-bottom">
                                                <li>RBAC</li>
                                                <li>Создание, редактирование и управление покерными турнирами.</li>
                                                <li>Возможность управления с разных устройств и вывод информации на различные устройства.</li>
                                                <li>Для обмена и обновления информации используются вебсокеты(Centrifugo и Pusher)</li>
                                                <li>Статистика проведенных игр в виде графиков выводится при помощи VUE</li>
                                                <li>Все управление турниром производится на одной странице управления добавление игроков, ребаев и аддонов. Автоматический рассчет призового фонда. Рассчет среднего стека. Вывод игроков, решивших оплатить турнир после.</li>
                                                <li>Страница управления диллерами. Добавление, удаление и пр. VUE и Vue Route</li>
                                                <li>Рассчет и управление системой рейка</li>
                                            </ul>
                                            <p>Есть демо доступ:
                                                <br>
                                                <a href="http://poker-manage.com">poker-manage.com</a>
                                            </p>
                                            <ul>
                                                <li>логин: yourmaze</li>
                                                <li>пароль: 123</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="resume__right-cell resume__experience">
                                        <div class="resume__experience__head">
                                            <div class="uk-margin-small-bottom">
                                                <div class="resume__company__name uk-text-bold"><span class="uk-text-large">3. </span> <span> Сервис для криптопроекта</span></div>
                                                <div class="uk-text-muted uk-margin-small-bottom">Php, HTML, CSS, Blade, Sass, Javascript</div>
                                                <div><a href="http://crypto.minus-30.ru" target="_blank">crypto.minus-30.ru</a></div>
                                            </div>
                                        </div>
                                        <div class="resume__experience__body">
                                            <p>Сервис разрабатывался для одного крипто проекта клиента.</p>
                                            <p>Данный проект интересен рассчетом вероятностей. Стояла цель рассчитать вероятность k количество попаданий в участие, имея n попыток. Рассчет ведется по теореме Бернулли.</p>
                                        </div>
                                    </div>

                                    <div class="resume__right-cell resume__experience">
                                        <div class="resume__experience__head">
                                            <div class="uk-margin-small-bottom">
                                                <div class="resume__company__name uk-text-bold"><span class="uk-text-large">4. </span> <span> Android приложение для проведения детских квестов "Квестуш". </span></div>
                                                <div class="uk-text-muted uk-margin-small-bottom">Java, Android Studio</div>
                                            </div>
                                        </div>
                                        <p>Функционал:</p>
                                            <ul class="uk-list uk-list-bullet uk-margin-medium-bottom">
                                            <li>Управление аудио и видео передачей</li>
                                            <li>Скачивание контента для отдельного квеста после его покупки с помошью xfetch2</li>
                                            <li>покупки внутри приложения android.billing</li>
                                            <li>и пр.</li>
                                        </ul>
                                        <p>Проект интересен тем, что не имея знания Android и JAVA разработки за два месяца мной было создано сложное рабочее приложение и размещено в PlayMarket</p>
                                    </div>

                                    <div class="resume__right-cell resume__experience">
                                        <div class="resume__experience__head">
                                            <div class="uk-margin-small-bottom">
                                                <div class="resume__company__name uk-text-bold"><span class="uk-text-large">5. </span> <span> Несколько примеров разработанных сайтов </span></div>
                                                <div class="uk-text-muted uk-margin-small-bottom">Wordpress, Opencart</div>
                                            </div>
                                        </div>
                                        <ul class="uk-list uk-list-bullet uk-margin-medium-bottom">
                                            <li><a href="https://agroprom-zai.ru/" target="_blank"> agroprom-zai.ru</a></li>
                                            <li><a href="https://sp-plus.org/" target="_blank"> sp-plus.org</a></li>
                                            <li><a href="http://arsk-metall.ru/" target="_blank"> arsk-metall.ru</a></li>
                                            <li><a href="https://buts8.com" target="_blank"> buts8.com</a></li>
                                            <li><a href="https://flagman-pk.ru/" target="_blank"> flagman-pk.ru</a></li>
                                            <li><a href="http://krug-fish.ru/" target="_blank"> krug-fish.ru</a></li>
                                            <li><a href="https://smile-clean.ru/" target="_blank"> smile-clean.ru</a></li>
                                            <li><a href="http://фармякутия.рф/" target="_blank"> фармякутия.рф</a></li>
                                            <li><a href="https://signalsat.ru/" target="_blank"> signalsat.ru</a></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            </div>
        </div>
    </div>

</body>
</html>
