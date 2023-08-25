<template>
    <div>
        <canvas ref="chartCanvas"></canvas>
    </div>
</template>

<script>
import { ref, onMounted, watch } from 'vue';
import Chart from 'chart.js/auto';
import axios from 'axios';

export default {
    name: 'PriceChart',
    props: {
        symbol: String,
    },
    setup(props) {
        const chartCanvas = ref(null);
        let chartInstance = null;

        const fetchAndRenderChart = () => {
            if (props.symbol) {
                if (chartInstance) {
                    chartInstance.destroy();
                }

                axios
                    .get(`/fetch-historical-data/${props.symbol}`)
                    .then(response => {
                        const apiResponse = response.data.historical['Time Series (Daily)'];
                        const dates = Object.keys(apiResponse);
                        const prices = dates.map(date => parseFloat(apiResponse[date]['4. close']));

                        if (chartCanvas.value) {
                            const ctx = chartCanvas.value.getContext('2d');
                            chartInstance = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: dates,
                                    datasets: [
                                        {
                                            label: 'Price',
                                            data: prices,
                                            borderColor: 'rgb(130, 142, 241)',
                                            fill: false,
                                        },
                                    ],
                                },
                                options: {
                                    scales: {
                                        x: {
                                            grid: {
                                                display: false,
                                            },
                                        },
                                    },
                                    plugins: {
                                        legend: {
                                            display: false,
                                        },
                                        tooltip: {
                                            mode: 'index',
                                            intersect: true,
                                        },
                                    },
                                },
                            });
                        }
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        };

        onMounted(fetchAndRenderChart);
        watch(() => props.symbol, fetchAndRenderChart);

        return {
            chartCanvas,
        };
    },
};
</script>
