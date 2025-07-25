@extends('layouts.home')

@section('content')
    <div class="content-wrapper" style="margin-left: 0px">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Phiếu nhập</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Phiếu nhập</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-3 form-group">
                                    <label for="">Mã phiếu nhập</label>
                                    <input type="text" class="form-control text-filter"
                                           value="{{ $filters ? $filters['receipt_id'] : old('receipt_id') }}"
                                           name="receipt_id" tabindex="0"
                                           autocomplete="off" spellcheck="false">
                                </div>
                                <div class="col-3 form-group">
                                    <label for="">Trạng thái</label>
                                    <select class="form-control text-filter center-align select2" name="status" >
                                        <option value="">--Tất cả--</option>
                                        @foreach(config('receipt.status') as $key => $item)
                                            <option value="{{ $key }}"  @if($key == $filters['status']) selected @endif  > {{ $item }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <button type="submit" style="border-radius: 5px; margin-top: 32px;"
                                            class="btn btn-primary search btn-icon btn-icon-x-wide" data-action="search"
                                            tabindex="0" title="Tìm kiếm">
{{--                                        <span class="fa fa-search"></span>--}}
                                        Tìm kiếm
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body" style="overflow: auto">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã phiếu nhập</th>
                                <th>Mã đơn</th>
{{--                                <th>Code</th>--}}
                                <th>Mã nhà cung cấp</th>
                                <th>Tên nhà cung cấp</th>
                                <th>Ngày</th>
                                <th>Trạng thái</th>
                                <th>Trạng thái 1office</th>
                                <th>Ghi chú</th>
{{--                                <th class="center-align">Tùy chọn</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $value)
                                <tr class="list-row" style="@if(!empty($value['notification']) && $value['notification']['status'] === 1) background-color:#bdbdc180 @endif">
                                    <td class="cell">{{ $key + 1 }}</td>
                                    <td class="cell"><a href="{{ route('receiving.show', ['receiving' => $value['receipt_id']]) }}">{{ $value['receipt_id'] }}</a></td>
                                    <td class="cell">{{ $value['receiving_id'] }}</td>
                                    <td class="cell">{{ $value['supplier_code'] }}</td>
                                    <td class="cell">{{ $value['supplier_name'] }}</td>
                                    <td class="cell">{{ $value['receipt_date'] }}</td>
                                    <td class="cell">{{ config('receipt.status')[$value['status']] }}</td>
                                    <td class="cell">{{ config('receipt.status_1office')[$value['status_office']] }}</td>
                                    <td class="cell">{{ $value['description'] }}</td>
                                    {{--                                    <td class="cell center-align">--}}
                                    {{--                                        <a href="{{route('process-group.edit', ['process_group' => $value['process_group_id']])}}" tabindex="0" id="create"--}}
                                    {{--                                           class="btn btn-default btn-xs-wide action radius-left radius-right">--}}
                                    {{--                                            <i class="fas fa-edit"></i>--}}
                                    {{--                                            Sửa--}}
                                    {{--                                        </a>--}}
                                    {{--                                        <a tabindex="0" id="create" data-toggle="modal" data-target="#refuse" data-url="{{route('process-group.destroy', ['process_group' => $value['process_group_id']])}}"--}}
                                    {{--                                           onclick="deleteProcessGroup(this)"--}}
                                    {{--                                           class="btn btn-danger btn-xs-wide action radius-left radius-right">--}}
                                    {{--                                            <i class="fas fa-trash-alt"></i>--}}
                                    {{--                                            Xóa--}}
                                    {{--                                        </a>--}}
                                    {{--                                    </td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="paginations">
                        {{ $data->appends(request()->all())->links('includes.pagination') }}
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@section('page-js')
    <script>
        $('.select2').select2();
    </script>
@endsection
