@if ($errors->any())
    <script>
        $(document).ready(function () {
            UIkit.notification({
                message: '<div class="uk-text-small uk-flex"><span class="uk-margin-small-right" uk-icon="icon: close; ratio: 1.4"></span><div>@foreach ($errors->all() as $error){{ $error }}<br>@endforeach</div></div>',
                pos: 'top-right',
                timeout: '5000',
                status: 'danger'
            });
        });
    </script>
@endif

@if (session('title'))

    <script>
        $(document).ready(function () {
            UIkit.notification({
                message: '<div class="uk-text-small uk-flex"><span class="uk-margin-small-right" uk-icon="icon: check; ratio: 1.4"></span><div><span class="uk-text-bold">{{ (session('title')) }}</span><br>{{ (session('text')) }}</div></div>',
                pos: 'top-right',
                timeout: '2000',
                status: 'success'
            });
        });
    </script>
@endif
