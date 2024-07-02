@extends('admin.layouts.template')
@section('page_title')
    Dashboard - Ecommerce
@endsection
@section('content')
    <div class="container my-5">
        Dashboard
        {{-- <x-filters :showContries='true' />
        <div class="card">
            <div class="card-body">
                <canvas id="barChart" width="800" height="400"></canvas>
            </div>
        </div> --}}
    </div>
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script> --}}
    {{-- <script>
        $(".bar_Menu").addClass('active');
        let chart;

        function getData() {
            $.ajax({
                url: '/admin/bar-chart-data',
                method: 'GET',
                dataType: 'json',
                data: {
                    'product_id': $("#product_name").val(),
                    'from': $("#from").val(),
                    'to': $("#to").val(),
                },
                success: function(data) {
                    const orders = data.orders;
                    console.log(orders, orders[1])

                    const ctx = document.getElementById('barChart').getContext('2d');

                    // if (chart) {
                    //     chart.destroy();
                    // }
                    chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Approve', 'Reject'],
                            datasets: [{
                                label: `Statistics`,
                                data: [orders[0].quantity, orders[1].quantity],
                                backgroundColor: ['rgb(255,99,132)', 'rgb(75,192,192)'],
                                borderWidth: 1,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                },
                error: function(error) {
                    console.log(error);
                }
            })
        }

        $(function() {
            getData();
        });
    </script> --}}
@endsection
