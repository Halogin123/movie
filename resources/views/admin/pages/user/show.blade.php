@extends('admin.layouts.home')

@section('content')
<div class="content-wrapper" style="margin-left: 0px">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{ auth()->user()->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class=" img-fluid img-circle" src="{{ asset('assets/icon/icons-user.png') }}" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ auth()->user()->name }}</h3>

{{--                            <p class="text-muted text-center">Software Engineer</p>--}}

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Họ tên</b> <a class="float-right">{{ auth()->user()->name }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right">{{ auth()->user()->email }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Phone</b> <a class="float-right">{{ auth()->user()->phone ?? '' }}</a>
                                </li>
                            </ul>

                            <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Cấu hình</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="settings">
                                    <div class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Họ tên</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="name" placeholder="Name" value="{{ auth()->user()->name }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="email" placeholder="Email" value="{{ auth()->user()->email }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Số điện thoại</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="phone" placeholder="Phone" value="{{ auth()->user()->phone ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">hạn mức chi tiêu</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="spending_limit" placeholder="3.000.000" value="{{ auth()->user()->spending_limit ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button onclick="updateUser(`{{ route('user.update') }}`)" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('page-js')
    <script>
        function updateUser(url) {
            let formData = new FormData();

            formData.append('id', {!! auth()->user()->id !!});
            formData.append('name', $('#name').val());
            formData.append('email', $('#email').val());
            formData.append('phone', $('#phone').val());
            formData.append('spending_limit', $('#spending_limit').val());

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
