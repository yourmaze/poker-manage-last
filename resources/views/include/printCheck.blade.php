<style>
    @page { margin: 0; padding: 0;}
    #payment-paper h2{
        font-family: DejaVu Sans;
        font-size: 120px;
        text-align: center;
    }
    #payment-paper body {
        font-family: DejaVu Sans;
    }
    #payment-paper table{
        font-size: 150px;
        font-weight: 400;
        margin-bottom: 140px;
    }
    #payment-paper table td{
        padding: 50px 0;
        border-bottom: 1px dashed;
        line-height: 1;
    }
    #payment-paper table tr > td:last-child{
        padding-left: 190px;
    }
    #payment-paper .date{
        font-size: 110px;
        text-align: center;
    }
    #payment-paper {
        color: #000 !important;
        background-color: #fff;
    }
    #payment-paper #playerType {
        color: #000;
        font-size: 150px;
    }
    .print_img{
        width: 100%;
        height: 1500px;
    }
</style>

<div id="print-button">START</div>
<div id="payment-paper" class="uk-width-1-1 uk-hidden">

    <img src="{{asset('img/logo-13.png')}}" alt="">

    <div class="logo uk-text-center" style="margin-bottom: 200px;">
        <h3 id="playerType">Ребай</h3>
        <p id="date" class="date">2020-02-25</p>
    </div>
    <table id="payment-paper__table" style="width: 100%">
        <tr>
            <td>Имя</td>
            <td id="name">Ахмед</td>
        </tr>
        <tr>
            <td>Стоимость</td>
            <td id="cost">400</td>
        </tr>
    </table>

    <div style="text-align: center">
        <img src="data:image/png;base64,{{--{{ base64_encode($qrcode) }}--}}">
    </div>
</div>

<div id="print-box"></div>


<script>
    $(document).on('click', '.print-player-check', function(e) {
        e.preventDefault();
        const element = $(this);
        const player_id = element.data('id');
        $('#payment-paper').removeClass('uk-hidden');
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: "{{ route('tournamentPlayer.getPayCheck') }}",
            data: {id: player_id},
            beforeSend: function () {
                element.find('i').addClass('uk-hidden');
                element.attr( "uk-spinner", "ratio: 0.7" );
            },
            success: function (data) {
                console.log(data);
                $('#payment-paper__table').html('');
                $('#playerType').html(data.player.type_name);
                $('#date').html(data.player.created_at);
                $('#payment-paper__table').append('<tr><td>Имя</td><td>'+data.player.name+'</td><tr>');
                $('#payment-paper__table').append('<tr><td>Стоимость</td><td>'+data.player.amount+'</td><tr>');
                if(data.player.bonus_stack === 1) {
                    $('#payment-paper__table').append('<tr><td>Бонус</td><td>да</td><tr>');
                }
                if(data.player.double_amount === 1) {
                    $('#payment-paper__table').append('<tr><td>Бай-ин</td><td>двойной</td><tr>');
                } else {
                    $('#payment-paper__table').append('<tr><td>Бай-ин</td><td>одинарный</td><tr>');
                }


                drawImage();
                element.find('i').removeClass('uk-hidden');
                element.removeAttr("uk-spinner");
                element.removeClass('uk-spinner')
            },
        });
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
                $('#print-box').html('');
            })
            .catch(function (error) {
                console.error('oops, something went wrong!', error);
            });
    }
</script>
