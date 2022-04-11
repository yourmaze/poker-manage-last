<script>
import { Bar } from "vue-chartjs";

export default {
    extends: Bar,
    data() {
        return {
            gradient: null,
            gradient2: null,
        };
    },
    mounted() {
        this.renderChart(
            {
                labels: [
                    "Павел",
                    "Андрей",
                    "Миша",
                    "Кирилл",
                ],
                datasets: [
                    {
                        label: "Рейка собрал",
                        pointBackgroundColor: "white",
                        pointBorderColor: "white",
                        backgroundColor: '#573bff',
                        data: [40, 39, 10, 40],
                        borderRadius: 15,
                    },
                    {
                        label: "Зарплаты получено",
                        pointBackgroundColor: "white",
                        pointBorderColor: "white",
                        backgroundColor: '#3fa4ff',
                        data: [60, 55, 32, 10],
                    },
                ],
            },
            {
                responsive: true,
                legend: {
                    display: false
                },
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        barPercentage: 0.5,
                        ticks: {
                            fontFamily: "'Rubik', sans-serif",
                            fontColor: '#a2a2a2',
                        },
                        gridLines: {
                            display:false
                        },
                        stacked: true // this should be set to make the bars stacked
                    }],
                    yAxes: [{
                        ticks: {
                            fontFamily: "'Rubik', sans-serif",
                            fontColor: '#a2a2a2',
                            padding: 10,
                            maxTicksLimit: 6
                        },
                        stacked: true // this also..
                    }]
                }
            }
        );
    },
};
</script>
