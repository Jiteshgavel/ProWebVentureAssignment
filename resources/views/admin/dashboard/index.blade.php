@extends('layout.admin')
@section('content')
    <style>
        .card-counter {
            box-shadow: 2px 2px 10px #DADADA;
            margin: 5px;
            padding: 20px 10px;
            background-color: #fff;
            height: 100px;
            border-radius: 5px;
            transition: .3s linear all;
        }

        .card-counter:hover {
            box-shadow: 4px 4px 20px #DADADA;
            transition: .3s linear all;
        }

        .card-counter.primary {
            background-color: #007bff;
            color: #FFF;
        }

        .card-counter.danger {
            background-color: #ef5350;
            color: #FFF;
        }

        .card-counter.success {
            background-color: #66bb6a;
            color: #FFF;
        }

        .card-counter.info {
            background-color: #26c6da;
            color: #FFF;
        }

        .card-counter i {
            font-size: 5em;
            opacity: 0.2;
        }

        .card-counter .count-numbers {
            position: absolute;
            right: 35px;
            top: 20px;
            font-size: 32px;
            display: block;
        }

        .card-counter .count-name {
            position: absolute;
            right: 35px;
            top: 65px;
            font-style: italic;
            text-transform: capitalize;
            opacity: 0.5;
            display: block;
            font-size: 18px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="{{ asset('asset/admin/css/select2.css') }}">
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="row align-items-center mb-2">
                        <div class="col-md-6">
                            <h2 class="h5 page-title">Welcome! {{ Auth::guard('admin')->user()->name }}</h2>
                            <p>Public Activity Count</p>
                            <form id="date-filter" method="POST">
                                @csrf
                                @php
                                    $toDate = \Carbon\Carbon::parse(Auth::guard('admin')->user()->created_at);
                                    $fromDate = \Carbon\Carbon::parse(now());
                                    $allTime = $toDate->diffInDays($fromDate);
                                @endphp
                                <div class="row my-3">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-12">
                                        <select class="custom-select" id="last_date" name="last_date">
                                            <option value="7">Last 7 Days</option>
                                            <option value="30">Last 30 Days</option>
                                            <option value="60">Last 60 Days</option>
                                            <option value="90">Last 90 Days</option>
                                            <option value="{{ $allTime }}">All Time</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                            <div class="border rounded p-4 mb-4 bg-white">
                                <canvas id="myChart-line"></canvas>
                            </div>

                            @php
                                $maxGpVal = 10;
                                if (!empty($webViews) and count($webViews)) {
                                    $maxGpVal = $maxGpVal + max($webViews);
                                }

                            @endphp
                            <script></script>
                        </div>
                         <div class="col-md-5 bg-white p-2">
                            <table class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Product Name</th>
                                        <th>Viewed by Country</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                </div>
                    </div>
                </div>
            </div>
        </div>
        </div> <!-- .col-12 -->
        </div> <!-- .row -->
        </div> <!-- .container-fluid -->
    </main> <!-- main -->
@endsection
@push('add-js')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
$(function() {

            /*------------------------------------------
             --------------------------------------------
             Pass Header Token
             --------------------------------------------
             --------------------------------------------*/
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            /*------------------------------------------
            --------------------------------------------
            Render DataTable
            --------------------------------------------
            --------------------------------------------*/
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                searching: false, paging: false, info: false,
                ajax: "{{ route('mostResentViewed') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'product',
                        name: 'product',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'country',
                        name: 'country',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
             });


        function updateChartData(lastDate) {
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            $.ajax({
                url: "{{ route('adminDashboard') }}",
                type: 'POST',
                data: {
                    last_date: lastDate,
                    _token: csrfToken
                },
                success: function(response) {
                    console.log(response.webViews, response.dateArr);
                    chartData(response.dateArr, response.webViews);
                },
                error: function(xhr) {
                    console.log(xhr);
                }
            });
        }
        // Trigger AJAX request on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateChartData(document.getElementById('last_date').value);
        });

        // Update chart data when select element changes
        document.getElementById('last_date').addEventListener('change', function() {
            var lastDate = this.value;
            updateChartData(lastDate);
        });

        function chartData(dateArr, webView) {
            let dataArray = dateArr;
            var labels = [];
            dataArray.forEach(function(data) {
                labels.push(data);
            });

            var webViewsData = [];
            webView.forEach(function(data) {
                webViewsData.push(data);
            });
            var existingChart = Chart.getChart("myChart-line");
            if (existingChart) {
                existingChart.destroy();
            }

            var config = {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Public Digital Profile Views",
                        backgroundColor: "#0144E4",
                        borderColor: "#0144E4",
                        data: webViewsData,
                    }]
                },
                options: {
                    responsive: true,
                    tension: 0.4,
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    },
                    scales: {
                        y: {
                            max: {{ $maxGpVal }},
                            min: 0,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            };

            var hiddenLabel = 'My Second Dataset';

            var myLine = new Chart($('#myChart-line'), config);
        }
    </script>
@endpush
