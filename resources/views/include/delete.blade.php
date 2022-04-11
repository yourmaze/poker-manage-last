<script>
    //Ajax delete client with uikit modal confirm
    $(document).ready(function () {
        @php
            if(!isset($selector)) {
                $selector = '.confirm-delete-item';
            }
        @endphp
        $(document).on('click', '{{ $selector }}', function (e) {
            e.preventDefault();
            const element = $(this);
            @php
                if(!isset($selectorDestroy)) {
                    $selectorDestroy = 'tr';
                }
            @endphp

            const destroyElement = '{{ $selectorDestroy }}';

            UIkit.modal.confirm('<h3>Вы подтверждаете удаление?</h3>',
                {
                    labels: {
                        cancel: 'Отмена',
                        ok: 'Удалить'
                    }
                }).then(function () {
                var id = element.data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ route($route) }}",
                    data: {id: id},
                    success: function (data) {
                        if (data.success || data) {
                            UIkit.notification({
                                message: '<div class="uk-text-small uk-flex"><span class="uk-margin-small-right" uk-icon="icon: check; ratio: 1.4"></span><div><span class="uk-text-bold">Успешно!</span><br>Запись успешно удалена</div></div>',
                                pos: 'top-right',
                                timeout: '2000',
                                status: 'success'
                            });

                            element.closest(destroyElement).hide(function () {
                                element.closest(destroyElement).remove();
                            });
                        } else {
                            UIkit.notification({
                                message: '<div class="uk-text-small uk-flex"><span class="uk-margin-small-right" uk-icon="icon: close; ratio: 1.4"></span><div><span class="uk-text-bold">Ошибка</span><br>Возникла ошибка при удалении</div></div>',
                                pos: 'top-right',
                                timeout: '2000',
                                status: 'danger'
                            });
                        }
                    },
                    error: function (data) {
                        const errors = data.responseJSON;
                        let errorText = 'Возникла ошибка при удалении';
                        if(errors) {
                            errorText = errors.message;
                        }

                        UIkit.notification({
                            message: '<div class="uk-text-small uk-flex"><span class="uk-margin-small-right" uk-icon="icon: close; ratio: 1.4"></span><div><span class="uk-text-bold">Ошибка</span><br>'+errorText+'</div></div>',
                            pos: 'top-right',
                            timeout: '5000',
                            status: 'danger'
                        });
                    },
                });
            }, function () {
            });
        });
    });
</script>
