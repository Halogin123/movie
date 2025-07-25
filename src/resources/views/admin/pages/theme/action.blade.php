@extends('layouts.home')

@section('content')
    <div class="">
        <div class="container"
             style="display: flex; padding-top: 15px;background-color: white;">
            <div style="line-height: 25px;" class="d-none d-md-block">
                <b>Phiếu nhập kho </b>
                <b style="margin-left: 10px; background-color: #00bfff66; color: #3a5ab2">
                    <span style="padding: 10px"> {{ config('receipt.status')[$data['status']] }}</span>
                </b>
                <div>
                    <label>Mã phiếu: </label> <b>{{ $data['receiving_id'] }}</b>
                    <label>Ngày nhận: </label> <b>{{ $data['receipt_date'] }}</b>
{{--                    <label>Ngày tạo: </label> <b> {{ date('d-m-Y', strtotime($data['suggested_at'])) }}</b>--}}
                </div>
            </div>
            <div class="d-block d-md-none" style="padding-bottom: 20px;">
                <span>Phiếu nhập kho: </span><b>{{ $data['receiving_id'] }}</b>
                <b style="margin-left: 10px; background-color: #00bfff66; color: #3a5ab2">
                    <span style="padding: 10px"> {{ config('receipt.status')[$data['status']] }}</span>
                </b>
            </div>
            <div style="margin-left: auto; margin-right: 10px;">
                @if (($getUserApprove?(int)$getUserApprove[0]['user_id']:0) === Auth::user()->employee_id)
{{--                                        <a href=""--}}
{{--                                           class="btn button_csrs btn-primary">--}}
{{--                                            Duyệt--}}
{{--                                        </a>--}}
                    <button class="btn button_csrs btn-primary" form="approve-form">Duyệt</button>
                    <button class="btn button_csrs btn-danger" data-toggle="modal" data-target="#refuse">Từ chối
                    </button>
                @endif

                @if (($getUserApprove?$getUserApprove[0]['user_id']:0) === Auth::user()->employee_id)
                    <a href="{{ route('reject-purchase-order', ['order_id' => $data['receiving_id']]) }}"
                       class="btn button_csrs btn-primary">
                        Hoàn duyệt
                    </a>
                @endif
            </div>
        </div>
        <div style="padding-top: 10px; display: flex;width: 95%;margin: 0px auto">
            <div class="container"
                 style="padding-top: 15px;background-color: white;width: 70%;box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);border-radius: 5px;padding-bottom: 36px;margin-bottom: 20px">
                <b>Duyệt nhập kho</b>
                <hr>
                <p><b style="margin-right: 20px">Mã phiếu nhập kho: </b> <span>{{ $data['receiving_id'] }}</span>
                </p>
                <p><b style="margin-right: 20px">Ngày nhập phiếu nhập: </b> <span>{{ $data['receipt_date'] }}</span></p>
                <p><b style="margin-right: 54px">Nhà cung cấp: </b> <span>{{ $data['supplier_name'] }}</span>
                </p>
{{--                <p><b style="margin-right: 58px">File đính kèm: </b> <span><a target="_blank"--}}
{{--                                                                              href="{{ route('contact-purchase-order', ['order_id' => $data['order_id']]) }}">Yêu cầu mua sắm.pdf</a></span>--}}
{{--                </p>--}}
                <hr>
                @if (($getUserApprove?(int)$getUserApprove[0]['user_id']:0) === Auth::user()->employee_id)
                    <div>
                        <form id="approve-form" action="{{ route('approve-receipt') }}" method="POST">
                            @csrf
                            <input type="text" name="receipt_id" value="{{ $data['receipt_id'] }}" hidden>
                            @php $i = 0; @endphp
                            @foreach($receiptProcessByStep as $key => $item)
                                <label for="">{{ $item['name_column'] }}</label>
                                @if ($item['type'] === 'input')
                                    <input type="text" name="order_process[{{ $key }}][clean_name_column]" value="{{$item['clean_name_column']}}" hidden>
                                    <input type="text" name="order_process[{{ $key }}][value]" value="{{$item['value']?:null}}" class="form-control">
                                @endif
                                @if($item['type'] === 'textarea')
                                    <input type="text" name="order_process[{{ $key }}][clean_name_column]" value="{{$item['clean_name_column']}}" hidden>
                                    <textarea name="order_process[{{ $key }}][value]"  class="form-control">{{$item['value']}}</textarea>
                                @endif
                                @if($item['type'] === 'text')
                                    <input type="text" name="order_process[{{ $key }}][clean_name_column]" value="{{$item['clean_name_column']}}" hidden>
                                    <input name="order_process[{{ $key }}][value]" value="{{$item['value']}}" class="form-control" hidden >
                                    <p>{{$item['value']}}</p>
                                @endif
                                @if($item['type'] === 'checkbox')
                                    <input type="text" name="order_process[{{ $key }}][clean_name_column]" value="{{$item['clean_name_column']}}" hidden>
                                    <input type="checkbox" name="order_process[{{ $key }}][value]" @if($item['value']) checked @endif class="form-control">
                                @endif
                                @if($item['type'] === 'number')
                                    <input type="text" name="order_process[{{ $key }}][clean_name_column]" value="{{$item['clean_name_column']}}" hidden>
                                    <input type="number" name="order_process[{{ $key }}][value]" @if($item['value']) checked @endif class="form-control">
                                @endif
                                @if($item['type'] === 'date')
                                    @php $i++ @endphp
                                    <input type="text" name="order_process[{{ $key }}][clean_name_column]" value="{{$item['clean_name_column']}}" hidden>
                                    <div class="input-group date-form" id="date-form-{{ $i }}" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" name="order_process[{{ $key }}][value]" data-target="#date-form-{{ $i }}">
                                        <input type="text" value="{{ $item['value'] }}" id="date-value-{{ $i }}" hidden>
                                        <div class="input-group-append" data-target="#date-form-{{ $i }}" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </form>
                    </div>
                @endif
            </div>
            <div style="width: 25%">
                <div class="d-none d-md-block">
                    <h4><b>Bước thực hiện</b></h4>
                </div>
                <div class="d-block d-md-none text-center">
                    <b>Buớc thực hiện</b>
                </div>
                <div>
                    @foreach($data['receipt_forward'] as $item)
                        <div style="margin-left: -15px">
                            <div class="box-order-forward active-status">
                                <div class="line-order"></div>
                                <div class="text-right-order" style="margin-bottom: 10px;">
                                    <div class="group-icon-order">
                                        <img class="icon-order-forward"
                                             src="{{ asset('assets/images/icon/delivered_parcel_active_3x.png') }}"
                                             alt="">
                                    </div>
                                    <div class="content-info"
                                         style="background-color: white; border-radius: 5px; width: 180px;">
                                        <b class="">{{ config('order.status_label')[$item['status']] }}</b>
                                        <p>{{ empty($item['user']) ? $item['description'] : $item['user']['name'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="refuse" tabindex="-1" role="dialog" aria-labelledby="refuse" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('refuse-receiving') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Gửi duyệt yêu cầu mua sắm</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label>Lý do từ chối duyệt</label>
                        <input type="hidden" value="{{ $data['receiving_id'] }}" name="receiving_id">
                        <input type="text" value="" name="description" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Từ chối</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <script>
        dateTimePicker();
        function dateTimePicker() {
            var countDateForm = document.querySelectorAll('.date-form').length;
            for (var i = 1; i <= countDateForm; i++) {
                $(`#date-form-${i}`).datetimepicker({
                    format: 'L',
                    defaultDate: $(`#date-value-${i}`).val() ? $(`#date-value-${i}`).val() : new Date()
                });
            }
        }

    </script>
@endsection
