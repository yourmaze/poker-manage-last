<template>
    <tr>
        <td>
            <div class="uk-flex uk-flex-middle">
                <div class="uk-margin-small-right">
                    <div class="uk-text-small">{{ name }}</div>
                </div>
            </div>
        </td>
        <td class="uk-text-center"><span v-if="total_rake">{{ total_rake }}</span><span v-else>-</span></td>
        <td class="uk-text-center"><span v-if="total_salary">{{ total_salary }}</span><span v-else>-</span></td>
        <td class="uk-text-center"><span v-if="total_tips">{{ total_tips }}</span><span v-else>-</span></td>
        <td class="uk-text-right">
            <ul class="uk-iconnav uk-flex-right">
                <li><a @click="del" class="uk-icon" uk-tooltip="Удалить" :[attrName]="icon"></a></li>
            </ul>
        </td>
    </tr>
</template>



<script>
export default {
    data() {
        return {
            attrName: 'uk-icon',
            icon: 'trash',
        }
    },

    methods: {
        update(val) {
            this.$emit('update', this.id);
        },
        del() {
            UIkit.modal.confirm('<h3>Вы подтверждаете удаление?</h3>',
                {
                    labels: {
                        cancel: 'Отмена',
                        ok: 'Удалить'
                    }
                }).then( async function () {
                this.attrName = 'uk-spinner';
                this.icon = 'ratio: 0.7';
                await this.$emit('delete', this.id);
            }.bind(this));
        }
    },
    props: ['id', 'total_rake', 'total_salary', 'total_tips', 'name'],
}
</script>

<style scoped>

</style>
