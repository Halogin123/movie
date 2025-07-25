<div style="padding-top: 15px" class="text-center">
    <p>Lịch sử phiếu nhập kho</p>
</div>
<div>
    <div style="display: flex">
        <hr style="margin-right: 5px;flex-grow:1;border-color: #d6d6d7;">
        <span style="margin-top: 7px">Phiếu nhập kho</span>
        <hr style="margin-left: 5px;flex-grow:1;border-color: #d6d6d7;">
    </div>
    @if (empty($data['receipt_forward'][0]))
        <div class="text-center">
            <img width="85px" src="{{ asset('assets/images/icon/add.png') }}" alt="">
        </div>
{{--        <div class="text-center">--}}
{{--            <p>Yêu cầu mua sắm chưa được lập</p>--}}
{{--        </div>--}}
    @else
        @foreach($data['receipt_forward'] as $item)
            <div style="margin-left: -5px">
                <div class="box-order-forward active-status">
                    <div class="line-order"></div>
                    <div class="text-right-order">
                        <div class="group-icon-order">
{{--                            @if($item['status'] == config('order.status.approved'))--}}
                                <img class="icon-order-forward" src="{{ asset('assets/images/icon/delivered_parcel_active_3x.png') }}" alt="">
{{--                            @else--}}
{{--                                <i class="far fa-check-circle" style="color: #bababa; z-index: 0; background-color: white;"></i>--}}
{{--                            @endif--}}
                        </div>
                        <div class="content-info">
                            <div style="display: flex">
                                <p style="margin-right: 6px; color: deepskyblue">{{ date('H:i d-m-Y', strtotime($item['created_at'])) }}</p>

{{--                                @if($item['status'] == config('order.status.approved'))--}}
{{--                                    <p class="item-status--}}
{{--                                    {{ $item['status'] == config('order.status.approved')? 'item-status-green': '' }}--}}
{{--                                ">{{ config('order.status_label')[$item['status']] }}</p>--}}
{{--                                @elseif($item['status'] == config('order.status.pending'))--}}
{{--                                    <p class="item-status-orange">{{ config('order.status_label.2') }}</p>--}}
{{--                                @elseif($item['status'] == config('order.status.refuse'))--}}
{{--                                    <p class="item-status-red">{{ config('order.status_label.4') }}</p>--}}
{{--                                @endif--}}

                            </div>
                            @if($item['user'])
                                <p>{{ $item['user']['name'] }}</p>
                            @endif

                            @if($item['description'])
                                <p>Lý do: {!! $item['description'] !!}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
