<template>
    <div id="app">
        <div class="uk-grid uk-flex-center">
            <div class="uk-width-1-1">
                <div class="uk-grid-small uk-grid-match uk-child-width-1-3@l" uk-grid>
                    <div>
                        <div class="uk-card uk-card-default uk-card-button uk-padding">
                            <div class="uk-flex uk-flex-middle uk-flex-between uk-margin-medium-bottom">
                                <h4 class="uk-margin-remove">Игр проведено</h4>
                                <div uk-form-custom="target: > * > span:last-child">
                                    <select>
                                        <option value="1">Неделя</option>
                                        <option value="2">Месяц</option>
                                        <option value="3">Три месяца</option>
                                        <option value="4">Год</option>
                                    </select>
                                    <span class="select-chart">
                                        <span></span>
                                        <span uk-icon="icon: triangle-down"></span>
                                    </span>
                                </div>
                            </div>
                            <RoundChart :width="300" :height="150"> </RoundChart>
                        </div>
                    </div>

                    <div>
                        <div class="uk-card uk-card-default uk-card-button uk-padding">
                            <div class="uk-flex uk-flex-middle uk-flex-between uk-margin-medium-bottom">
                                <h4 class="uk-margin-remove">Активность диллеров</h4>
                                <div uk-form-custom="target: > * > span:last-child">
                                    <select>
                                        <option value="1">Неделя</option>
                                        <option value="2">Месяц</option>
                                        <option value="3">Три месяца</option>
                                        <option value="4">Год</option>
                                    </select>
                                    <span class="select-chart">
                                        <span></span>
                                        <span uk-icon="icon: triangle-down"></span>
                                    </span>
                                </div>
                            </div>
                            <BarChart :width="300" :height="200"> </BarChart>
                        </div>
                    </div>

                    <div>
                        <div class="uk-card uk-card-default uk-card-button uk-padding uk-margin-bottom uk-flex uk-flex-middle">
                            <div class="uk-margin-right">
                                <img src="/img/icons/poker.png" alt="">
                            </div>
                            <div>
                                <div class="chart-title">&#8381; 11,500</div>
                                <div class="chart-text">На турнирах</div>
                            </div>
                        </div>
                        <div class="uk-card uk-card-default uk-card-button uk-padding uk-flex uk-flex-middle">
                            <div class="uk-margin-right">
                                <img src="/img/icons/chips.png" alt="">
                            </div>
                            <div>
                                <div class="chart-title">&#8381; 43,200</div>
                                <div class="chart-text">На кэш играх</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import AreaChart from "./BarChart";
import RoundChart from "./RoundChart";
import BarChart from "./BarChart";

export default {
    name: "App",
    components: {
        BarChart,
        AreaChart,
        RoundChart,
    },
    data() {
        return {
            chartData: {
                Books: 24,
                Magazine: 30,
                Newspapers: 10
            }
        };
    }
};
</script>

<style>
.select-chart{
    font-weight: 400;
    color: #868686;
}
.chart-title{
    font-size: 32px;
    font-weight: 700;
    color: #222;
    line-height: 1.1;
}
.chart-text{
    font-weight: 300;
    color: #848484;
    font-size: 15px;
}
</style>
