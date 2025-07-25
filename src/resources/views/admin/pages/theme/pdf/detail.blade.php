<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: DejaVu Sans;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .title {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <h3>CÔNG TY CỔ PHẦN TẦM NHÌN QUỐC TẾ ALADDIN</h3>
            <h4>Số 69 Tố Hữu - Vạn Phúc - Hà Đông</h4>
        </div>
    </div>
    <div class="title">
        <h2>PHIẾU NHẬP KHO</h2>
        <p><b>SỐ: </b>{{ $receipt['receipt_id'] }}</p>
    </div>
    <div class="info">
        <ul>
            <li>
                <b>Nhà cung cấp: </b> {{ $receipt['supplier_name'] }}
            </li>
            <li>
                <b>Ngày tạo: </b>{{ now() }}
            </li>
        </ul>
    </div>
    <div>
        <h4>Thông tin mặt hàng</h4>
        <div>
            <table class="table"
                   style="border-radius: 5px; border-collapse: separate; border: 1px solid var(--default-border-color);">
                <thead>
                <tr class="background-header-table">
                    <th rowspan="2" class="text-color-black">#</th>
                    <th rowspan="2" class="text-color-black" style="width: 18%">Mã YCMS</th>
                    <th rowspan="2" class="text-color-black">Tên Hàng</th>
                    <th rowspan="2" class="text-color-black">Mã kho</th>
                    <th rowspan="2" class="text-color-black">Đơn vị tính</th>
                    <th colspan="2" class="text-color-black title">Số lượng</th>

                    <th rowspan="2" class="text-color-black">Giá</th>
                    <th rowspan="2" class="text-color-black">Tiền</th>
                </tr>
                <tr>
                    <th class="text-color-black">Số lượng</th>
                    <th class="text-color-black">Số lượng duyệt</th>
                </tr>
                </thead>
                <tbody>
                @foreach($receipt['receipt_details'] as $key => $value)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $value['ycms_code'] }}</td>
                        <td>{{ $value['iit_name'] }}</td>
                        <td>{{ $value['ma_kho'] }}</td>
                        <td>{{ $value['iit_uom'] }}</td>
                        <td>{{ $value['quantity_orders'] }}</td>
                        <td>{{ $value['quantity_approve'] }}</td>
                        <td>{{ number_format($value['price']) }}</td>
                        <td>{{ number_format($value['money']) }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="8" style="text-align: center">Tổng tiền</td>
                    <td>{{ number_format($receipt['total']) }}</td>
                </tfoot>
            </table>
        </div>
    </div>
</body>
</html>

