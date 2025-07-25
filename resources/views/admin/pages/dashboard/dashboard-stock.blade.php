@extends('admin.layouts.home')

@section('content')
    <div class="content-wrapper" style="margin-left: 0px">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Báo cáo tài chính</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard-stock') }}">Home</a></li>
                            <li class="breadcrumb-item active">Báo cáo tài chính</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>
                                    <p> {{ number_format($data['total']) }}</p>
                                </h3>
                                <p>Tổng tài sản</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="javascript:void(0)" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>
                                    <p> {{ number_format($data['total-stock']) }}</p>
                                </h3>
                                <p>Cổ phiếu</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="javascript:void(0)" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>
                                    <p> {{ number_format($data['total-fund-certificate']) }}</p>
                                </h3>
                                <p>Chứng chỉ quỹ</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="javascript:void(0)" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>
                                    <p>{{ number_format($data['profit-and-loss']) }}</p>
                                </h3>
                                <p>Lãi/Lỗ</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="javascript:void(0)" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card-danger col-6">
                        <div class="card-header">
                            <h3 class="card-title">Tỷ lệ giữ</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <div class="card-danger col-6">
                        <div class="card-header">
                            <h3 class="card-title">Nắm giữ</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="pieChart1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('page-js')
    <script>
        function generateGradientColor(step, maxSteps) {
            // Tính tỷ lệ phần trăm của bước hiện tại
            const value = Math.floor((step / maxSteps) * 255); // Tính giá trị màu xanh

            // Nếu giá trị lớn thì màu xanh đậm, nếu nhỏ thì màu xanh nhạt
            const blue = 255 - value; // Giá trị xanh dương giảm dần khi số lượng tăng
            const green = value; // Màu xanh lá tăng dần khi số lượng tăng
            const red = 0; // Cố định đỏ ở mức 0

            return `rgb(${red}, ${green}, ${blue})`; // Tạo màu với giá trị RGB
        }


        var donutData = {
            labels: [
                'Cổ phiếu',
                'Chứng chỉ quỹ mở',
            ],
            datasets: [
                {
                    data: [{!! ($data['total-stock']) !!},{!! ($data['total-fund-certificate']) !!}],
                    backgroundColor : ['#00a65a', '#f56954'],
                }
            ]
        }
        let stock = {!! $stocks !!};
        console.log(stock)
        let labels = [];
        let prices = [];
        let backgroundColor = [];
        stock.forEach(function(currentValue, index, array) {
            labels[index] = currentValue.code;
            prices[index] = currentValue.capital_price;
            backgroundColor[index] = generateGradientColor(index, stock.length)
        });

        var donutData1 = {
            labels: labels,
            datasets: [
                {
                    data: prices,
                    backgroundColor : backgroundColor,
                }
            ]
        }

        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        var pieData        = donutData;
        var pieOptions     = {
            maintainAspectRatio : false,
            responsive : true,
        }
        new Chart(pieChartCanvas, {
            type: 'pie',
            data: pieData,
            options: pieOptions
        })

        var pieChartCanvas = $('#pieChart1').get(0).getContext('2d')
        var pieData        = donutData1;
        var pieOptions     = {
            maintainAspectRatio : false,
            responsive : true,
        }
        new Chart(pieChartCanvas, {
            type: 'pie',
            data: pieData,
            options: pieOptions
        })
    </script>
@endsection
