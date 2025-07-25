<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>Mã</th>
        <th>Giá HT <br> Giá trị TT</th>
        <th>Tổng KL</th>
        <th>lãi lỗ <br> lãi lỗ (%)</th>
        <th>Thực hiện</th>
    </tr>
    </thead>
    <tbody>
    @php $countCapitalPrice = 0; @endphp
    @foreach($data as $key => $value)
        @php
            $countCapitalPrice += $value['capital_price'];
            $down = $value['actual_value'] > $value['current_price'];
            $up = $value['actual_value'] < $value['current_price'];
            $equal = $value['actual_value'] == $value['current_price'];

            $priceReal = ($value['current_price'] * $value['remaining_balance']) * 1000;
            $profit = $priceReal - ($value['capital_price']);

            $profitPercent = ($profit / $value['capital_price']) * 100;
        @endphp
        <tr class="list-row"
            style="
                @if ($down) color: red;
                @elseif($equal) color : yellow;
                @elseif($up) color: #009d22;
                @endif
            ">
            <td class="cell">{{ $key + 1 }}</td>
            <td class="cell">
                <a
                    href="{{ route($route['show'], [$route['key'] => $value['id']]) }}"
                    style="
                        @if ($down) color: red;
                        @elseif($equal) color : yellow;
                        @elseif($up) color: #009d22;
                        @endif
                    "
                >
                    {{ $value['code'] }}
                    <br>
                    <span>Giá Thực: {{ number_format($priceReal) }}</span>
                    <br>
                    <span>Giá vốn: {{ number_format($value['capital_price']) }}</span>
                </a>
            </td>
            <td class="cell">{{ number_format($value['current_price'], 2, '.') }} <br> {{ number_format($value['actual_value'], 2, '.') }}</td>
            <td class="cell">{{ $value['remaining_balance'] }}</td>
            <td class="cell"> {{ number_format($profit, 0, '.') }} <br> {{ number_format($profitPercent, 3, '.') }} %</td>
            <td>
                <div class="btn-group">
{{--                    <button type="button" class="btn btn-default">Action</button>--}}
                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                        <a class="dropdown-item" href="{{ route($route['edit'], [$route['key'] => $value->id]) }}">
                            <i class="fas fa-edit"></i> Sửa
                        </a>
                        <a class="dropdown-item" href="{{ route('craw-info', ['code' => $value->code]) }}">
                            <i class="fas fa-cloud"></i> Đồng bộ
                        </a>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    <tr class="list-row">
        <td></td>
        <td>{{ number_format($countCapitalPrice) }}</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    </tbody>
</table>
