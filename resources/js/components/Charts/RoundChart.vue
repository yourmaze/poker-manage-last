<script>
import { Doughnut } from "vue-chartjs";

export default {
    extends: Doughnut,
    data() {
        return {
            gradient: null
        };
    },
    mounted() {
        this.renderChart(
            {
                labels: [
                    "Турниры",
                    "Кэш игры",
                ],
                datasets: [
                    {
                        label: "Data One",
                        pointBackgroundColor: "white",
                        pointBorderColor: "white",
                        backgroundColor: ['#573bff', '#3fa4ff'],
                        data: [10, 25]
                    }
                ]
            },
            {
                responsive: true,
                legend: {
                    position: "right",
                    align: "middle",
                    padding: 50,
                    labels: {
                        padding: 30,
                        usePointStyle: true,
                        boxWidth: 9,
                        fontFamily: "'Rubik', sans-serif",
                        fontColor: '#666',
                    }
                },
                maintainAspectRatio: true
            }
        );
    }
};
</script>
