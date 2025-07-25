<div class="card-body row">
    <div class="form-group col-sm-6 required">
        <label>Mã</label>
        <input type="text" name="code" value="{{ $data['code'] ?? null }}" @if($action === 'show') disabled
               @endif class="form-control">
    </div>

    <div class="form-group col-sm-6 required">
        <label>Loại</label>
        <select name="type" id="" class="form-control select2"
                @if($action === 'show') disabled @endif>
            <option>Chọn loại</option>
            @foreach(STOCK_TYPE as $key => $transactionType)
                <option
                    @if (!empty($data['type']) && $data['type'] === $key) selected @endif
                value="{{ $key }}">{{ $transactionType }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-sm-6 required">
        <label>Giá hiện tại</label>
        <input type="text" name="current_price" value="{{ $data['current_price'] ?? null }}"
               @if($action === 'show') disabled @endif class="form-control">
    </div>

    <div class="form-group col-sm-6 required">
        <label>Tổng tài sản</label>
        <input type="text" name="total_money_company" value="{{ $data['total_money_company'] ?? null }}"
               @if($action === 'show') disabled @endif  class="form-control">
    </div>

    <div class="form-group col-sm-6 required">
        <label>Khối lượng niêm yết</label>
        <input type="text" name="listed_volume" value="{{ $data['listed_volume'] ?? null }}"
               @if($action === 'show') disabled @endif class="form-control">
    </div>

    <div class="form-group col-sm-6 required">
        <label> Vốn lưu động</label>
        <input type="text" name="working_capital" value="{{ $data['working_capital'] ?? null }}"
               @if($action === 'show') disabled @endif class="form-control">
    </div>

    <div class="hidden">
        <input type="hidden" name="id" value="{{ $data['id'] ?? null }}" class="form-control">
    </div>
    <!-- select from array -->
</div>
