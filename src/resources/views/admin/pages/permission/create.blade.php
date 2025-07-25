@extends('admin.layouts.home')

@section('content')
    <div class="mt-3">
        <div class="row mb-3">
            <div class="col-12">
                <ol class="breadcrumb" aria-label="breadcrumbs">
                    <li class="breadcrumb-item"><a href="">Quyền</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{route('permission.index')}}"
                                                                       class="text-success">Quyền</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('permission.create') }}"
                                                                       class="text-success">Tạo quyền</a>
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
                                <label>Tên quyền <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="name" id="name">
                                <p class='text-danger text-xs' id="name"></p>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button onclick="createPermission(`{{ route('permission.store') }}`)" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <script>
        function createPermission(url) {
            let formData = new FormData();

            formData.append('name', $('#name').val());

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
