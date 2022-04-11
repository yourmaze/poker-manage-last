<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="/favicon.png"/>

    <title>PDF</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

@stack('styles')

<!-- Scripts -->

    <style>
        @page { margin: 0; padding: 0;}
        h2{
            font-family: DejaVu Sans;
            font-size: 120px;
            text-align: center;
        }
        body {
            font-family: DejaVu Sans;
        }
        table{
            font-size: 150px;
            font-weight: 400;
            margin-bottom: 140px;
        }
        table td{
            border-bottom: 1px dashed;
        }
        table tr > td:last-child{
            padding-left: 10px;
        }
        .date{
            font-size: 110px;
            text-align: center;
            margin-bottom: 80px;
        }
        #payment-paper {
            color: #000 !important;
            background-color: #fff;
        }
        .print_img{
            width: 100%;
            height: 1800px;
        }
    </style>

</head>
<body>

<div id="print-button">START</div>
<div id="print-button-2">PRINT</div>
<a id="asdasd" href="">asdasd</a>

<div id="frame"></div>


<div id="payment-paper" class="uk-width-1-1 uk-hidden">

    <img src="{{asset('img/logo-13.png')}}" alt="">

    <div class="logo uk-flex uk-flex-center">
        <p class="date">{{ $date }}</p>
    </div>
    <table style="width: 100%">
        <tr>
            <td>Бай-ин</td>
            <td>Одинарный</td>
        </tr>
        <tr>
            <td>Бонус</td>
            <td>Да</td>
        </tr>
        <tr>
            <td>Стоимость</td>
            <td>400</td>
        </tr>
    </table>
</div>

<div id="print-box"></div>

<!--    <div style="text-align: center">
        <img src="data:image/png;base64,{{ base64_encode($qrcode) }}">
    </div>-->

    <script src="{{ asset('js/app.js') }}" defer></script>
<script>

    $('#print-button').on('click', function() {
        $('#payment-paper').removeClass('uk-hidden');
        drawImage();
    });

    function drawImage() {
        const node = document.getElementById('payment-paper');
        domtoimage.toPng(node)
            .then(function (dataUrl) {
                const img = new Image();
                img.src = dataUrl;
                $('#print-box').html(img);
                $('#print-box img').addClass('print_img');
                printJS('print-box', 'html');
                $('#payment-paper').addClass('uk-hidden');
            })
            .catch(function (error) {
                console.error('oops, something went wrong!', error);
            });
    }

</script>

</body>
</html>
