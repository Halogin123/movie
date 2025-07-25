@extends('admin.layouts.home')

@section('content')
    <div class="content-wrapper" style="margin-left: 0px">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Giao dịch</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Tài sản</a></li>
                            <li class="breadcrumb-item active">Giao dịch</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card" style="border-radius: 10px;">
                    <div class="card-body">
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-12 col-lg-3 col-md-3">
                                    <div style="margin-right: 15px" class="form-group">
                                        <label>Từ ngày:</label>
                                        <div class="input-group date" id="start_date" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" data-target="#start_date" name="start_date">
                                            <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 col-md-3">
                                    <div style="margin-right: 15px" class="form-group">
                                        <label>Đến ngày:</label>
                                        <div class="input-group date" id="end_date" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" data-target="#end_date" name="end_date">
                                            <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-inline-block" style="margin-top: 10px; margin-bottom: 10px;">
                                    <button type="submit" class="btn btn-primary float-right">Tìm kiếm</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card" style="border-radius: 10px;">
                            <div class="card-body">
                                <h2 class="d-inline-block">Danh sách giao dịch</h2>
                                <div class="float-right">
                                    <a class="btn btn-success" href="{{route('transactions.create')}}">
                                        <i class="fas fa-plus"></i>&nbsp;
                                        Thêm mới
                                    </a>
                                    <a class="btn btn-info" href="{{route('count-transactions')}}">
                                        <i class="fas fa-plus"></i>&nbsp;
                                        Tính
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-vcenter table-nowrap table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center">STT</th>
                                            <th style="text-align: center">Thời gian giao dịch</th>
                                            <th style="text-align: center">Loại giao dịch</th>
                                            <th style="text-align: center">Nội dung giao dịch</th>
                                            <th style="text-align: center">Số tiền</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($transactions as $key => $transaction)
                                                <tr>
                                                    <td style="text-align: center">{{ $key + 1 }}</td>
                                                    <td style="text-align: center">{{date('d/m/Y H:i:s', strtotime($transaction->executed_at))}}</td>
                                                    <td style="text-align: center">{{ $transaction->transaction_type->label() }}</td>
                                                    <td style="text-align: center">{{$transaction->description}}</td>
                                                    <td style="text-align: center">{{ number_format($transaction->amount) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="paginations">
                                    {{ $transactions->appends(request()->all())->links('admin.includes.pagination') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection

@section('page-js')
    <script>
        $('#end_date').datetimepicker({
            format: 'L'
        });
        $('#start_date').datetimepicker({
            format: 'L'
        });
    </script>
@endsection
