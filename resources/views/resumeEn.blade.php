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

            <h1 id="page-title" class="uk-margin-remove-bottom">@isset($title) {{ $title }} @else Resume @endisset</h1>

            <div class="uk-flex uk-flex-middle">
                <div id="print-pdf">
                    <a href="/documents/Resume.pdf" target="_blank"><i class="fad fa-print fa-lg"></i></a>
                </div>
                <div class="header-user">
                    <div class="header-language"><a href="/resume-en" class="active">EN</a> | <a href="/resume" >RU</a></div>
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
                                    <div class="resume__head__name uk-margin-bottom">Altabasov<br> Semyon</div>
                                    <div class="resume__head__who uk-text-muted">Full-stack developer</div>
                                </div>
                                <div class="uk-width-1-2@m">
                                    <div class="uk-text-right@m uk-text-center">
                                        <div class="resume__head__location uk-margin-small-bottom"><span class="uk-margin-small-right"><i class="fad fa-map-marker-alt"></i></span>KRASNOYARSK</div>
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
                                        <h2>personal information</h2>
                                        <div class="uk-margin-medium-bottom">
                                            <div class="uk-margin-small-bottom"><span class="uk-text-muted">Date of birth:</span> 17.09.1992 (29 years)</div>
                                            <div class="uk-margin-small-bottom"><span class="uk-text-muted">Citizenship:</span> Russian Federation</div>
                                            <div class="uk-margin-small-bottom"><span class="uk-text-muted">Education:</span> Higher</div>
                                            <div class="uk-margin-small-bottom"><span class="uk-text-muted">Marital status:</span> married</div>
                                        </div>

                                        <hr>

                                        <h2>Education</h2>
                                        <div class="uk-margin-medium-bottom">
                                            <div class="resume__education__year uk-text-muted uk-text-small uk-margin-small-bottom">2012</div>
                                            <div class="resume__education__degree uk-margin-small-bottom">BACHELOR`S DEGREE</div>
                                            <div class="resume__education__university uk-margin-small-bottom">Siberian Federal University, Krasnoyarsk</div>
                                            <div class="resume__education__specialization uk-text-muted">
                                                Informatics and Computer Engineering
                                                (Computer software and automated systems)
                                            </div>
                                        </div>

                                        <div class="uk-margin-medium-bottom">
                                            <div class="resume__education__year uk-text-muted uk-text-small uk-margin-small-bottom">2014</div>
                                            <div class="resume__education__degree uk-margin-small-bottom">MASTER`S DEGREE <span class="uk-text-small uk-text-muted">with honours</span></div>
                                            <div class="resume__education__university uk-margin-small-bottom">Siberian Federal University, Krasnoyarsk</div>
                                            <div class="resume__education__specialization uk-text-muted">
                                                Informatics and Computer Engineering
                                                (Microprocessor systems )
                                            </div>
                                        </div>
                                        <hr>

                                        <h2>Hard skills</h2>
                                        <div class="uk-margin-medium-bottom">
                                            <h3>//BACKEND</h3>
                                            <ul class="uk-list uk-list-bullet">
                                                <li>Php 8</li>
                                                <li>work experience with framework Laravel, Yii</li>
                                                <li>MySql</li>
                                                <li>Redis</li>
                                                <li>Telegram`s bots development</li>
                                                <li>REST API formation</li>
                                            </ul>
                                            <h3>//CMS</h3>
                                            <ul class="uk-list uk-list-bullet">
                                                <li>WordPress</li>
                                                <li>Opencart</li>
                                                <li>Joomla</li>
                                            </ul>
                                            <h3>//FRONTEND</h3>
                                            <ul class="uk-list uk-list-bullet">
                                                <li>experience working with HTML5, CSS3;</li>
                                                <li>knowledge SASS, LESS</li>
                                                <li>experience working with Bootstrap, UiKit</li>
                                                <li>knowledge JS/JQuery</li>
                                                <li>experience working with VUE</li>
                                                <li>experience in layout of sites and templates for CMS</li>
                                                <li>experience in creating adaptive cross-browser layout</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-width-2-3@m line">
                                    <div class="resume__right-cell resume__experience">
                                        <h2>Work Experience</h2>
                                        <div class="resume__experience__head">
                                            <div class="resume__experience__years">June 2014 - <br>May 2017</div>
                                            <div class="resume__experience__company">
                                                <div class="resume__company__name">«WebWolf»</div>
                                                <div class="resume__company__who">Web-developer</div>
                                            </div>
                                        </div>
                                        <div class="resume__experience__body">
                                            <p>Responsibilities of:</p>
                                            <ul class="uk-list uk-list-bullet uk-margin-medium-bottom">
                                                <li>fullstack development of sites on Wordpress, Opencart, Joomla;</li>
                                                <li>development of new web-services on Yii, Laravel;</li>
                                                <li>implementation of SEO specialists` recommendations;</li>
                                                <li>conducting development of frontend and backend parts;</li>
                                            </ul>

                                            <p>While working:</p>
                                            <ul class="uk-list uk-list-bullet">
                                                <li>- have developed over 120 sites of various complexity;</li>
                                                <li>- have become a head of development department in the first year;</li>
                                                <li>- all the developed sites were made from scratch, without the use of templates and constructors;</li>
                                                <li>- developed and integrated functional for several large projects, for example roomelectro.ru( over 100.000 visits a day)</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="resume__right-cell resume__experience">
                                        <div class="resume__experience__head">
                                            <div class="resume__experience__years">May 2017 - <br>present time</div>
                                            <div class="resume__experience__company">
                                                <div class="resume__company__name">«Minus30»</div>
                                                <div class="resume__company__who">Development Team Lead</div>
                                            </div>
                                        </div>
                                        <div class="resume__experience__body">
                                            <p>Responsibilities of:</p>
                                            <ul class="uk-list uk-list-bullet uk-margin-medium-bottom">
                                                <li>- development complex web-services on Laravel;</li>
                                                <li>- development architecture of databases;</li>
                                                <li>- code refactoring;</li>
                                                <li>- fullstack development sites on Wordpress, Opencart, Joomla.</li>
                                            </ul>

                                            <p>I have personally:</p>
                                            <ul class="uk-list uk-list-bullet">
                                                <li>Developed a system for managing company`s clients</li>
                                                <li>Developed several complicated REST API systems</li>
                                                <li>Written two Android applications on Java</li>
                                                <li>Developed several dozen sites for company`s clients</li>
                                            </ul>
                                        </div>
                                    </div>


                                    <h2>Portfolio</h2>

                                    <div class="resume__right-cell resume__experience">
                                        <div class="resume__experience__head">
                                            <div class="uk-margin-small-bottom">
                                                <div class="resume__company__name uk-text-bold"><span class="uk-text-large">1. </span> <span>CRM Development for company`s clients managing</span></div>
                                                <div class="uk-text-muted">Php, HTML, CSS, Blade, Sass, Javascript</div>
                                            </div>
                                        </div>
                                        <div class="resume__experience__body">
                                            <p>Part of functionality:</p>
                                            <ul class="uk-list uk-list-bullet uk-margin-medium-bottom">
                                                <li>- Adding and managing company`s clients</li>
                                                <li>- Monitoring the performance of clients sites by checking the server response and / or checking for the presence of a certain meta tag</li>
                                                <li>- Adding and monitoring data on advertising budgets of clients via Yandex.Direct Api .</li>
                                                <li>- Notifications to managers in the Telegram messenger about the unavailability of the site and / or insufficient balance on the advertising budget. </li>
                                                <li>- Monitoring of payments of recurring clients and automatic sending of invoices for payment by mail. </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="resume__right-cell resume__experience">
                                        <div class="resume__experience__head">
                                            <div class="uk-margin-small-bottom">
                                                <div class="resume__company__name uk-text-bold"><span class="uk-text-large">2. </span> <span> SAAS CRM to control the game of poker </span> <br> <span class="uk-text-muted">The service is still under development </span></div>
                                                <div class="uk-text-muted uk-margin-small-bottom">Php, HTML, CSS, Blade, Sass, Javascript, Vue</div>
                                                <div><a href="http://poker-manage.com" target="_blank">poker-manage.com</a></div>
                                            </div>
                                        </div>
                                        <div class="resume__experience__body">
                                            <p> Part of functionality:</p>
                                            <ul class="uk-list uk-list-bullet uk-margin-medium-bottom">
                                                <li>RBAC</li>
                                                <li>Creating, editing, and operating poker tournaments.</li>
                                                <li>Possibility to control from various devices and output information to various devices .</li>
                                                <li>Web sockets are used to exchange and update information. (Centrifugo и Pusher)</li>
                                                <li>Statistics of the games played in the form of graphs are displayed using VUE </li>
                                                <li>All tournament management is done on one page. Managing the addition of players, rebuys and addons. Automatic prize pool calculation. Average stake calculation. Display of players who decided to pay for a tournament after.</li>
                                                <li>Dealers managing page. Adding, editing and etc build on VUE and Vue Route</li>
                                                <li>Calculation and management of the rake system </li>
                                            </ul>
                                            <p>Demo access is available:
                                                <br>
                                                <a href="http://poker-manage.com">poker-manage.com</a>
                                            </p>
                                            <ul>
                                                <li>login: yourmaze</li>
                                                <li>password: 123</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="resume__right-cell resume__experience">
                                        <div class="resume__experience__head">
                                            <div class="uk-margin-small-bottom">
                                                <div class="resume__company__name uk-text-bold"><span class="uk-text-large">3. </span> <span> Service for crypto project</span></div>
                                                <div class="uk-text-muted uk-margin-small-bottom">Php, HTML, CSS, Blade, Sass, Javascript</div>
                                                <div><a href="http://crypto.minus-30.ru" target="_blank">crypto.minus-30.ru</a></div>
                                            </div>
                                        </div>
                                        <div class="resume__experience__body">
                                            <p>Service was developed for a client`s crypto project.</p>
                                            <p>This project is interesting for calculating probabilities. The goal was to calculate the probability k number of hits in participations, having n tries. The calculation is carried out according to the Bernoulli theorem.</p>
                                        </div>
                                    </div>

                                    <div class="resume__right-cell resume__experience">
                                        <div class="resume__experience__head">
                                            <div class="uk-margin-small-bottom">
                                                <div class="resume__company__name uk-text-bold"><span class="uk-text-large">4. </span> <span> Android application for children's quests "Questush". </span></div>
                                                <div class="uk-text-muted uk-margin-small-bottom">Java, Android Studio</div>
                                            </div>
                                        </div>
                                        <p>Functionality:</p>
                                        <ul class="uk-list uk-list-bullet uk-margin-medium-bottom">
                                            <li>Audio and video transmission control</li>
                                            <li>Downloading content for a separate quest after purchasing, using the xfetch2 library</li>
                                            <li>in app purchases (android.billing)</li>
                                            <li>and etc.</li>
                                        </ul>
                                        <p>The project is interesting because without the knowledge of Android and JAVA development, in two months I created a complex working application and placed it on PlayMarket.</p>
                                    </div>

                                    <div class="resume__right-cell resume__experience">
                                        <div class="resume__experience__head">
                                            <div class="uk-margin-small-bottom">
                                                <div class="resume__company__name uk-text-bold"><span class="uk-text-large">5. </span> <span> Several examples of developed sites</span></div>
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
                                            <li><a href="https://coolskin.ru/" target="_blank"> coolskin.ru</a></li>
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
