<table class="table table-bordered">
    <thead>
    <tr>
        <th>STT</th>
        <th>Mã cổ phiếu</th>
        <th>Loại</th>
        <th>Giá mua</th>
        <th>Tiền mua</th>
        <th>Giá tại thời điểm mua</th>
        <th>Số lượng giao dịch</th>
        <th>Số dư tồn</th>
        <th>Thời điểm giao dịch</th>
        <th>Ghi chú</th>
        <th>Thực hiện</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $key => $value)
        <tr class="list-row"
            style="@if(!empty($value['notification']) && $value['notification']['status'] === 1) background-color:#bdbdc180 @endif">
            <td class="cell">{{ $key + 1 }}</td>
            <td class="cell"><a
                href="{{ route($route['show'], [$route['key'] => $value['id']]) }}">{{ $value['code'] }}</a>
            </td>
            <td class="cell">{{ $value['type'] }}</td>
            <td class="cell">{{ $value['transaction_price'] }}</td>
            <td class="cell">{{ number_format($value['transaction_money']) }}</td>
            <td class="cell">{{ $value['transaction_price_at_time'] }}</td>
            <td class="cell">{{ $value['transaction_quantity'] }}</td>
            <td class="cell">{{ $value['remaining_balance'] }}</td>
            <td class="cell">{{ $value['transaction_time'] }}</td>
            <td class="cell">{{ $value['note'] }}</td>
            <td>
                <div class="btn-group btn-group-sm">
                    <a href="{{ route($route['edit'], [$route['key'] => $value->id]) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i>
                    </a>
                    <div>
                        <form action="{{ route($route['destroy'], $value->id) }}" method="POST">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
