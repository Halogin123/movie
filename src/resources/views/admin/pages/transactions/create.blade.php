@extends('admin.layouts.home')

@section('content')
    <div class="mt-3">
        <div class="row mb-3">
            <div class="col-12">
                <ol class="breadcrumb" aria-label="breadcrumbs">
                    <li class="breadcrumb-item"><a href="">Tài sản</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('transactions.index') }}"
                                                                       class="text-success">Giao dịch</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('transactions.create') }}"
                                                                       class="text-success">Tạo giao dịch</a>
                    </li>
                </ol>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <div class="card" style="border-radius: 10px;">
                    <div class="card-body">
                        <div class="form-group col-12 col-md-3">
                            <div class="field">
                                <label>Loại giao dịch <span class="text-red">*</span></label>
                                <select class="form-control text-filter select2 " name="transaction_type" id="transaction_type">
                                    @foreach($types as $type)
                                        <option value="{{ $type->value }}">{{ $type->label() }}</option>
                                    @endforeach
                                </select>
                                <p class='text-danger text-xs' id="mes_transaction_type"></p>
                            </div>
                        </div>

                        <div class="form-group col-12 col-md-3">
                            <div class="field">
                                <label>Số tiền <span class="text-red">*</span></label>
                                <input type="number" class="form-control" name="amount" id="amount" value="0">
                                <p class='text-danger text-xs' id="mes_amount"></p>
                            </div>
                        </div>
                        <div class="form-group col-12 col-md-3">
                            <div class="field">
                                <label>Ghi chú <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="description" id="description">
                                <p class='text-danger text-xs' id="mes_description"></p>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <script>
        function createTransaction() {
            let formData = new FormData();

            formData.append('amount', $('#transaction_type').val());
            formData.append('amount', $('#amount').val());
            formData.append('description', $('#description').val());

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $(".theloading").show();
                },
                success: function (response) {
                    $(".theloading").hide();
                    if (response.status == 200) {
                        toastr.success("Tạo mới thành công")
                        setTimeout(function() {
                            window.location.href = response.data.url_return;
                        }, 500);
                    } else {
                        var mes = response.message;
                        if (typeof response.message === 'object') {
                            Object.entries(mes).forEach(([key, msg]) => {
                                $('#mes_' + key).text(msg[0]);
                                if (key == 'orderDetail.quantity') {
                                    $('#mes_orderDetail').text(msg);
                                }
                            })
                        } else {
                            toastr.warning(mes)
                        }
                    }
                },
                error: function() {
                    $(".theloading").hide();
                    toastr.error("Tạo mới thật bại")
                }
            })
        }
    </script>
@endsection
