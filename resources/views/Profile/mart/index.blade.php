<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ngọc Chinh Mart</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        body{
            background-image: url({{asset('assets/images/hinh-nen-than-tai-phat-loc.jpg')}});
            background-size: cover;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 style="text-align: center">Tạo mã thanh toán</h1>
    <div>
        <div>
            <div class="form-group">
                <label for="name">Chọn ngân hàng:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="bank"  value="tpbank">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Tp Bank
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="bank"  value="mbbank" checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Mb Bank
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="name">Giá tiền:</label>
                <input type="tel" class="form-control" id="amount" placeholder="Số tiền" style="font-size: 30px">
            </div>
            <div class="form-group">
                <label for="email">Nội dung chuyển khoản:</label>
                <input type="text" class="form-control" id="description" style="font-size: 30px" placeholder="Mua hàng {{ Carbon\Carbon::now()->format('d/m/Y H:i:s')}}">
            </div>
            <button style="float: right" type="button" class="btn btn-primary" id="create-qr">Tạo mã</button>
        </div>
    </div>

    <div class="modal fade" id="modal-confirm" tabindex="-1" role="dialog" aria-labelledby="modal-confirm" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mã thanh toán</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="email">Số tiền thanh toán:</label>
                        <br>
                        <span style="font-size: 30px" id="confirm-amount"></span><span style="font-size: 30px">đ</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mã thanh toán</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="image-container">
                        <div id="image-qr"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $('#create-qr').on('click', function () {
        var divElement = document.querySelector("#img-qr");
        var selectedRadioButton = document.querySelector('input[name="bank"]:checked');
        if (selectedRadioButton) {
            var selectedValue = selectedRadioButton.value;
        }

        if (!$('#amount').val()) {
            toastr.warning('Nếu không nhập số tiền thì người chuyển tiền sẽ tự nhập.', 'Cảnh báo!');
        } else if ($('#amount').val() && $('#amount').val() <= 1000) {
            toastr.warning('Số tiền phải lớn hơn 1.000đ.', 'Cảnh báo!');
            return;
        }
        document.getElementById('confirm-amount').innerHTML = $('#amount').val();
        $('#modal-confirm').modal('show');
        $.ajax({
            url: '{{ str_replace("http://", "https://", route('generateQrMart')) }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                amount: $('#amount').val(),
                bank: selectedValue,
                addInfo: $('#description').val(),
            },
            success: function (response) {
                try {
                    if (divElement) {
                        $('#img-qr').remove();
                    }
                    $('#image-container').append(`<img src="${response}"  id="img-qr" style="width: 100%" alt="Hình ảnh">`);
                } catch (e) {
                    toastr.error('Lỗi tạo mã không đúng.', 'Gặp lỗi!');
                }

            },
            error: function(xhr, status, error) {
                console.log('Tạo mã không thành công');
                toastr.error('Lỗi tạo mã không đúng.', 'Gặp lỗi!');
            }
        });
    });

    $('#amount').on('keyup', function () {
        var amount = $('#amount').val();
        if(amount && !amount.match(/^\d+/))
        {
            document.getElementById('amount').value = 0;
            toastr.error('Vui lòng chỉ nhâp số', 'Gặp lỗi!');
            return;
        }
        var amountF = Number(amount.replace(/,/g, ''));
        const formatter = new Intl.NumberFormat('en-US');

        var formattedAmount = formatter.format(amountF);
        $('#amount').val(formattedAmount);
    })

    function closeModal () {
        $('#modal-confirm').modal('hide');
    }
</script>

</body>
</html>
