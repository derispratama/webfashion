@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop
@section('plugins.Chartjs',true)
@section('content')
<div class="row">
    <div class="col-12">
        <div class="row">
                    <div class="col-3">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{$tot_lunas}}</h3>
                                <p>Lunas</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{$tot_blm_lunas}}</h3>
                                <p>Belum Lunas</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-times"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{$tot_user}}</h3>
                                <p>Customer</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>Rp.{{$tot_pendapatan == null ? '0' : $tot_pendapatan}}</h3>
                                <p>Total Pemasukan</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-money-bill-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
    <div class="col-6">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Chart Jumlah Jersey Berdasarkan Liga</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        var donutData = {
            labels: [],
            datasets: [
                {
                    data: [],
                    backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                }
            ]
        }

        getChart(donutData);

        function getChart(donutData){
            $.ajax({
                url:'/dashboard/chart',
                method:'get',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success(data){
                    console.log(data)
                    data.data.map((val,idx) => {
                        donutData.labels.push(val.nama_liga);
                        donutData.datasets[0].data.push(val.totalstok);
                    });
                    //-------------
                    //- PIE CHART -
                    //-------------
                    // Get context with jQuery - using jQuery's .get() method.
                    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
                    var pieData        = donutData;
                    var pieOptions     = {
                        maintainAspectRatio : false,
                        responsive : true,
                    }
                    //Create pie or douhnut chart
                    // You can switch between pie and douhnut using the method below.
                    new Chart(pieChartCanvas, {
                        type: 'pie',
                        data: pieData,
                        options: pieOptions
                    })
                }
            });

        }


    </script>
@endsection
