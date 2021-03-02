<script>
    import { defineComponent } from 'vue'
    import { Line } from 'vue3-chart-v2'

    export default defineComponent({
        extends: Line,

        props: {
            labels: {
                type: Array,
                default() { return []; }
            },

            values: {
                type: Array,
                default() { return []; }
            },
        },

        mounted () {
            let options = {
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                        yAxes: [{
                        display: true,
                        ticks: {
                            suggestedMax: 10,
                            beginAtZero: true,
                        }
                    }]
                },
            }

            // Overwriting base render method with actual data.
            this.renderChart({
                labels: this.labels,
                datasets: [
                    {
                        label: 'Todos Completed Per Day',
                        backgroundColor: '#f87979',
                        data: this.values,
                    }
                ]
            }, options);
        }
    })
</script>
