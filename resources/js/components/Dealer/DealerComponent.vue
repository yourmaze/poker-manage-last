<template>
    <div id="app">
        <div class="uk-width-1-1 uk-flex uk-flex-between uk-margin-bottom">
            <ul class="uk-breadcrumb">
                <li><a href="/">Главная</a></li>
                <li>Дилеры</li>
            </ul>
        </div>

        <div class="uk-width-1-1">
            <div class="uk-margin-bottom uk-flex uk-flex-right uk-flex-wrap uk-flex-middle">
                <router-link to="/dealers/create" class="uk-button uk-button-primary ripple">Добавить дилера</router-link>
            </div>
        </div>

        <v-skeleton-loader
            v-if="firstLoad"
            type="table-thead, table-tbody"
            :types="{ 'table-tbody': 'table-row-divider@6', 'table-row': 'table-cell@4', 'table-thead': 'heading@4' }"
        ></v-skeleton-loader>
        <table class="uk-table uk-table-hover uk-table-middle uk-table-without-shadow uk-background-default" v-show="!firstLoad">
            <tr>
                <th>Имя</th>
                <th class="uk-text-center">Заработок</th>
                <th class="uk-text-center">Рейка</th>
                <th class="uk-text-center">Чаевых</th>
                <th class="uk-text-right">Операции</th>
            </tr>
            <dealer-item-component
                v-for="dealer in dealers"
                v-bind="dealer"
                :key="dealer.id"
                @update="update"
                @delete="del"
            ></dealer-item-component>
        </table>
    </div>
</template>



<script>

function Dealer({ id, total_rake, total_salary, total_tips, name}) {
    this.id = id;
    this.total_rake = total_rake;
    this.total_salary = total_salary;
    this.total_tips = total_tips;
    this.name = name;
}
import DealerItemComponent from './DealerItemComponent';
export default {
    mounted() {
    },
    data() {
        return {
            firstLoad: true,
            dealers: []
        }
    },
    methods: {
        async read() {
            const data = await window.axios.get('/api/dealers').then( response => {
                if (this.firstLoad) this.firstLoad = false;
                console.log(response.data)
                const dealers = response.data.dealer;
                dealers.forEach(dealer => this.dealers.push(new Dealer(dealer)));
            });
        },
        async update(id) {
            // To do
        },
        async del(id) {
            await window
                .axios
                .delete(`/api/dealers/${id}`)
                .then( response => {
                    if(response.data === 1) {
                        UIkit.notification({
                            message: '<div class="uk-text-small uk-flex"><span class="uk-margin-small-right" uk-icon="icon: check; ratio: 1.4"></span><div><span class="uk-text-bold">Успешно</span><br>Запись удалена</div></div>',
                            pos: 'top-right',
                            status: 'success'
                        });
                        let index = this.dealers.findIndex(dealer => dealer.id === id);
                        this.dealers.splice(index, 1);
                    } else {
                        UIkit.notification({
                            message: '<div class="uk-text-small uk-flex"><span class="uk-margin-small-right" uk-icon="icon: close; ratio: 1.4"></span><div><span class="uk-text-bold">Ошибка</span><br>Ошибка при удалении</div></div>',
                            pos: 'top-right',
                            status: 'danger'
                        });
                    }
                });
        },
        async create(id) {
            // To do
        }
    },
    created() {
        this.read();
    },
    components: {
        DealerItemComponent
    }
}
</script>
