<x-main>
    <x-slot name="title">
        Dashboard
    </x-slot>
    <x-slot name="cssSlot">

    </x-slot>

    <x-slot name="bodyContent">

        <div class="row">
            <div class="col">

                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-0 text-uppercase">Evolution de téléphone cette année (2022)</h6>
                        <hr/>
                        <div class="chart-container1">
                            <canvas id="charts1"></canvas>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </x-slot>

    <x-slot name="jsSlot">
        <script src="{{asset("assets/plugins/chartjs/js/Chart.min.js")}}"></script>
        <script src="{{asset("assets/plugins/chartjs/js/chartjs-custom.js")}}"></script>
        <script>
            var ctx = document.getElementById("charts1").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['apple', 'infinix', 'samsung', 'huawei', 'xiaomi', 'Sa', 'OPPO'],
                    datasets: [{
                        label: 'marque',
                        data: [13, 8, 20, 4, 18, 29, 25],
                        barPercentage: .5,
                        backgroundColor: "#8833ff"
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: true,
                        labels: {
                            fontColor: '#585757',
                            boxWidth: 40
                        }
                    },
                    tooltips: {
                        enabled: true
                    },
                    scales: {
                        xAxes: [{
                            ticks: {
                                beginAtZero: true,
                                fontColor: '#585757'
                            },
                            gridLines: {
                                display: true,
                                color: "rgba(0, 0, 0, 0.07)"
                            },
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                fontColor: '#585757'
                            },
                            gridLines: {
                                display: true,
                                color: "rgba(0, 0, 0, 0.07)"
                            },
                        }]
                    }
                }
            });
        </script>
    </x-slot>
</x-main>
