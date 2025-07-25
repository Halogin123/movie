@extends('admin.layouts.home')

@section('content')
    <div class="mt-3">
        <div class="row mb-3">
            <div class="col-12">
                <ol class="breadcrumb" aria-label="breadcrumbs">
                    <li class="breadcrumb-item"><a href="">Nhóm quyền</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{route('group-permission.index')}}"
                                                                       class="text-success">Nhóm quyền</a>
                    </li>
                </ol>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <div class="card" style="border-radius: 10px;">
                    <div class="card-body">
                        <h2 class="d-inline-block">Danh sách nhóm quyền</h2>
                        <div class="float-right">
                            <a class="btn btn-success" href="{{route('group-permission.create')}}">
                                <i class="fas fa-plus"></i>&nbsp;
                                Thêm mới
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter table-nowrap table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th style="text-align: center">STT</th>
                                    <th style="text-align: center">Mã</th>
                                    <th style="text-align: center">#</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $key => $role)
                                    <tr>
                                        <td style="text-align: center">{{ $key + 1 }}</td>
                                        <td style="text-align: center">{{ $role->name }}</td>
                                        <td style="text-align: center"></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
{{--                    <div class="card-body">--}}
{{--                        <div class="paginations">--}}
{{--                            {{ $roles->appends(request()->all())->links('admin.includes.pagination') }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
