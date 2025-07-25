<div class="card-body row">

    <div class="form-group col-sm-6 required">
        <label>Mã</label>
        @if (!empty($stocks))
        <select name="code" id="" class="form-control select2">
            <option value="">Chọn mã cổ phiếu</option>
            @foreach($stocks as $stock)
                <option
                    @if (!empty($data['code']) && $data['code'] === $stock->code) selected @endif
                    value="{{ $stock->code }}">{{ $stock->code }}</option>
            @endforeach
        </select>
        @else
        <input type="text" name="code" value="{{ $data['code'] ?? null }}"
               @if($action === 'show') disabled
               @endif class="form-control">
        @endif
    </div>

    <div class="form-group col-sm-6 required">
        <label>Loại giao dịch</label>
        <select name="type" id="" class="form-control select2"
                @if($action === 'show') disabled @endif>
            <option>Chọn loại giao dịch</option>
            @foreach(TRANSACTION_TYPE as $key => $transactionType)
                <option
                    @if (!empty($data['type']) && $data['type'] === $key) selected @endif
                    value="{{ $key }}">{{ $transactionType }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-sm-6 required">
        <label>Giá mua</label>
        <input type="text" name="transaction_price" value="{{ $data['transaction_price'] ?? null }}"
               @if($action === 'show') disabled
               @endif class="form-control">
    </div>

    <div class="form-group col-sm-6 required">
        <label>Tiền mua</label>
        <input type="text" name="transaction_money" value="{{ $data['transaction_money'] ?? null }}"
               @if($action === 'show') disabled
               @endif  class="form-control">
    </div>

    <div class="form-group col-sm-6 required">
        <label>Giá tại thời điểm mua</label>
        <input type="text" name="transaction_price_at_time" value="{{ $data['transaction_price_at_time'] ?? null }}"
               @if($action === 'show') disabled
               @endif  class="form-control">
    </div>

    <div class="form-group col-sm-6 required">
        <label>Số lượng giao dịch</label>
        <input type="text" name="transaction_quantity" value="{{ $data['transaction_quantity'] ?? null }}"
               @if($action === 'show') disabled
               @endif class="form-control">
    </div>

{{--    <div class="form-group col-sm-6 required">--}}
{{--        <label>Số dư tồn</label>--}}
{{--        <input type="text" name="remaining_balance" value="{{ $data['remaining_balance'] ?? null }}"--}}
{{--               @if($action === 'show') disabled--}}
{{--               @endif class="form-control">--}}
{{--    </div>--}}

    <div class="form-group col-sm-6 required">
        <label>Ghi chú</label>
        <input type="text" name="note" value="{{ $data['note'] ?? null }}"
               @if($action === 'show') disabled
               @endif class="form-control">
    </div>

    <div class="form-group col-sm-6 required">
        <label>Thời gian mua</label>
        <input type="date" name="transaction_time" value="{{ $data['transaction_time'] ?? null }}"
               @if($action === 'show') disabled
               @endif class="form-control">
    </div>

    <div class="hidden">
        <input type="hidden" name="id" value="{{ $data['id'] ?? null }}" class="form-control">
    </div>
    <!-- select from array -->
</div>

@section('page-js')
    <script>
        $('.select2').select2();
    </script>
@endsection
