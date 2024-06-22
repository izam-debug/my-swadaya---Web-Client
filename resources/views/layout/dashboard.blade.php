@extends('template')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <select id="yearSelector" class="form-control">
                @foreach ($timestamps as $year)
                    <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                @endforeach
            </select>
            <div class="col-md-12 p-3">
                <div class="card-header">Pemakaian Air <span class="judul-tahun"> {{ date('Y') }} </span></div>
                <div class="card-body">
                    <canvas id="myChart" width="400" height="100"></canvas>
                </div>
            </div>
            <div class="col-md12 p-3">
                <div class="card-header">Tagihan <span class="judul-tahun"> {{ date('Y') }} </span></div>
                <div class="card-body">
                    <canvas id="myChart1" width="400" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function(){
        function loadChart(canvasId, url, year) {
            $.ajax({
                url: url + "?year=" + year,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    var ctx = document.getElementById(canvasId).getContext('2d');
                    var existingChart = Chart.getChart(ctx);
                    if(existingChart) {
                        existingChart.destroy();
                    }
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: 'Total',
                                data: data.totals,
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                }
            });
        }

        function loadBothCharts(year) {
            loadChart('myChart', '/dash/client/chart-tagihan', year);
            loadChart('myChart1', '/dash/client/chart-tagihan', year);
        }
        
        loadBothCharts($('#yearSelector').val());

        $('#yearSelector').change(function() {
            var selectedYear = $(this).val();
            loadBothCharts(selectedYear);
            $('.judul-tahun').text($(this).val());
        });
    });
</script>
    
@endpush