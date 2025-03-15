@extends('layouts.app')

@section('content')
    <div class="container mt-5 mb-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg border-0">
                    <div class="card-header text-white d-flex justify-content-between align-items-center"
                         style="background-color: #4a5568;">
                        <h4 class="mb-0">Dashboard - {{ $currentMonth }}</h4>
                        <i class="bi bi-speedometer2 fs-3"></i>
                    </div>
                    <div class="card-body">
                        <p class="fs-5">Welcome, <strong>{{ auth()->user()->name }}</strong>!</p>
                        <div class="row text-center mt-4">
                            <div class="col-md-6">
                                <div class="p-4 bg-white border rounded shadow-sm position-relative overflow-hidden"
                                     style="transition: transform 0.3s; cursor: pointer;">
                                    <h5 class="fw-bold text-dark">Users This Month</h5>
                                    <p class="display-6 fw-bold">{{ $usersCount }}</p>
                                    <i class="bi bi-people-fill position-absolute top-0 end-0 m-3 fs-1 text-secondary"></i>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-4 bg-white border rounded shadow-sm position-relative overflow-hidden"
                                     style="transition: transform 0.3s; cursor: pointer;">
                                    <h5 class="fw-bold text-dark">Posts This Month</h5>
                                    <p class="display-6 fw-bold">{{ $postsCount }}</p>
                                    <i class="bi bi-file-earmark-text-fill position-absolute top-0 end-0 m-3 fs-1 text-secondary"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row text-center mt-4">
                            <div class="col-md-6">
                                <div class="p-4 bg-light border rounded shadow-sm">
                                    <h5 class="fw-bold text-dark">User Growth</h5>
                                    <div id="user_chart_div" style="width: 100%; height: 250px;"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-4 bg-light border rounded shadow-sm">
                                    <h5 class="fw-bold text-dark">Post Growth</h5>
                                    <div id="post_chart_div" style="width: 100%; height: 250px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawUserChart);
        google.charts.setOnLoadCallback(drawPostChart);

        function drawUserChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Date');
            data.addColumn('number', 'Users');
            
            data.addRows([
                @foreach($dates as $index => $date)
                    ["{{ $date }}", {{ $usersData[$index] }}],
                @endforeach
            ]);

            var options = {
                colors: ['#4a5568'],
                chartArea: { width: '70%', height: '60%' },
                legend: { position: 'none' },
                hAxis: { title: 'Date', slantedText: true, slantedTextAngle: 45 },
                vAxis: { title: 'Users Count', minValue: 0 }
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('user_chart_div'));
            chart.draw(data, options);
        }

        function drawPostChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Date');
            data.addColumn('number', 'Posts');
            
            data.addRows([
                @foreach($dates as $index => $date)
                    ["{{ $date }}", {{ $postsData[$index] }}],
                @endforeach
            ]);

            var options = {
                colors: ['#4a5568'],
                chartArea: { width: '70%', height: '60%' },
                legend: { position: 'none' },
                hAxis: { title: 'Date', slantedText: true, slantedTextAngle: 45 },
                vAxis: { title: 'Posts Count', minValue: 0 }
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('post_chart_div'));
            chart.draw(data, options);
        }
    </script>
@endsection
