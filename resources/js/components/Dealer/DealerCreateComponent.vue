<template>
    <div id="app">
        <form action="#" @submit.prevent="register">
            <div class="uk-grid uk-flex-center">
                <div class="uk-width-1-1 uk-flex uk-flex-between uk-margin-bottom">
                    <ul class="uk-breadcrumb">
                        <li><a href="/">Главная</a></li>
                        <li><router-link to="/dealers">Дилеры</router-link></li>
                        <li>Добавление дилера</li>
                    </ul>
                </div>

                <div class="uk-width-1-1">
                    <div class="uk-card uk-card-default uk-card-body uk-padding-large-xl">
                        <div class="uk-grid uk-flex-center">
                            <div class="uk-width-2-3@xl uk-width-3-4@l">
                                <div class="uk-grid">
                                    <div class="uk-width-1-2@m uk-flex uk-flex-wrap uk-flex-right@l">

                                        <div class="uk-margin-medium-bottom">
                                            <label class="uk-form-label">Имя</label>
                                            <div class="uk-form-controls uk-margin-small-top">
                                                <div class="uk-inline">
                                                    <span class="uk-form-icon"><i class="fal fa-user fa-lg"></i></span>
                                                    <input v-model="form.dealer_name" class="uk-input uk-form-width-medium" type="text" name="dealer_name" placeholder="Имя">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="uk-margin-medium-bottom">
                                            <label class="uk-form-label">Пароль</label>
                                            <div class="uk-form-controls uk-margin-small-top">
                                                <div class="uk-inline">
                                                    <span class="uk-form-icon"><i class="fal fa-key fa-lg"></i></span>
                                                    <input v-model="form.password" class="uk-input uk-form-width-medium" type="text" name="password" placeholder="Пароль">
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="_token" :value="csrf">
                                        <input type="hidden" name="_method" value="POST">
                                    </div>

                                    <div class="uk-width-1-2@m">
                                        <div class="uk-margin-medium-bottom">
                                            <label class="uk-form-label">Логин</label>
                                            <div class="uk-form-controls uk-margin-small-top">
                                                <div class="uk-inline">
                                                    <span class="uk-form-icon"><i class="fal fa-sign-in fa-lg"></i></span>
                                                    <input v-model="form.name" class="uk-input uk-form-width-medium" type="text" name="name" placeholder="Логин">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="uk-width-1-1">
                                        <div class="uk-text-center">
                                            <button class="uk-button uk-button-primary uk-form-width-medium" type="submit">Добавить</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>



<script>
export default {
    data () {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            form: new Form({
                dealer_name: '',
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
            })
        }
    },

    methods: {
        register () {
            this.form.post('/dealer/register')
                .then(( response ) => {
                    console.log(response);
                    this.form.reset();
                    UIkit.notification({
                        message: '<div class="uk-text-small uk-flex"><span class="uk-margin-small-right" uk-icon="icon: check; ratio: 1.4"></span><div><span class="uk-text-bold">Успешно</span><br>'+response.data.alert_delete+'</div></div>',
                        pos: 'top-right',
                        status: 'success'
                    });
                    //const searchUrl = '/dealers';
                    //this.$router.push({path:searchUrl});
                })
        },
    }
}
</script>
