@extends('layouts.home')

@section('page-css')
    <style>
        /*.box-request-left {*/
        /*    width: 99%;*/
        /*}*/
        /*.line {*/
        /*    margin-right: 70px;*/
        /*}*/
        /*.box-detail {*/
        /*    margin: 10px 15px 0px 15px;*/
        /*}*/
    </style>

@endsection

@section('content')
    <div style="margin-bottom: 5%; margin-left: 1%;" >
        <section class="content-header">
            <div class="">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Chi tiết phiếu nhập {{ $data['receipt_id'] }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('receiving.index') }}">Phiếu nhập</a></li>
                            <li class="breadcrumb-item active">{{ $data['receipt_id'] }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <div style="display: flex">
            <div class="box-request-left">
                <div class="box-detail">
                    <div>
                        <h4>Thông tin chung</h4>

                        <div style="display: flex">
                            <div style="display: grid; width: 87%">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="field">
                                            <label class="col-lg-6 custom-padding">Mã phiếu :</label>
                                            <span class="col-lg-6 custom-padding">{{ $data['receipt_id'] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="field">
                                            <label class="col-lg-6 custom-padding">Mã :</label>
                                            <span class="col-lg-6 custom-padding">{{ $data['receiving_code'] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="field">
                                            <label class="col-lg-6 custom-padding">Ngày nhận :</label>
                                            <span class="col-lg-6 custom-padding">{{ date('d-m-Y', strtotime($data['receipt_date'])) }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="field">
                                            <label class="col-lg-6 custom-padding">Mã nhà cung cấp :</label>
                                            <span class="col-lg-6 custom-padding">{{ $data['supplier_code'] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="field">
                                            <label class="col-lg-6 custom-padding">Tên nhà cung cấp :</label>
                                            <span class="col-lg-6 custom-padding">{{ $data['supplier_name'] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="field">
                                            <label class="col-lg-6 custom-padding">Tổng tiền :</label>
                                            <span class="col-lg-6 custom-padding">{{ $data['total'] }}</span>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="line"></div>
                            <div>
                                <p>Trạng thái PN</p>
                                <label class="item-status" style="width: 90px !important;"> {{ config('receipt.status')[$data['status']] }}</label>
                            </div>
                        </div>
                        <div>
                            <div class="col-12">
                                <div class="field">
                                    <label class="col-lg-6 custom-padding">Ghi chú :</label>
                                    <span class="col-lg-6 custom-padding">{{ $data['description'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <h4>Thông tin mặt hàng</h4>
                        <div>
                            <table class="table"
                                   style="border-radius: 5px; border-collapse: separate; border: 1px solid var(--default-border-color);">
                                <thead>
                                <tr class="background-header-table">
                                    <th class="text-color-black">#</th>
                                    <th class="text-color-black" style="width: 10%">Mã YCMS</th>
                                    <th class="text-color-black" >Mã hàng</th>
                                    <th class="text-color-black">Tên hàng</th>
                                    <th class="text-color-black" >Mã kho</th>
                                    <th class="text-color-black" style="width: 10%">Đơn vị tính</th>
                                    <th class="text-color-black">Số lượng</th>
                                    <th class="text-color-black">Số lượng duyệt</th>
                                    <th class="text-color-black">Giá</th>
                                    <th class="text-color-black">Tiền</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data['receipt_details'] as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value['ycms_code'] }}</td>
                                        <td>{{ $value['iit_code'] }}</td>
                                        <td>{{ $value['iit_name'] }}</td>
                                        <td>{{ $value['ma_kho'] }}</td>
                                        <td>{{ $value['iit_uom'] }}</td>
                                        <td>{{ $value['quantity_orders'] }}</td>
                                        <td>{{ $value['quantity_approve'] }}</td>
                                        <td>{{ $value['price'] }}</td>
                                        <td>{{ $value['money'] }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container box-request-right" style="display: block">
                @include('pages/receiving/historyReceiving')
            </div>
        </div>
    </div>

@endsection

@section('page-js')

@endsection
