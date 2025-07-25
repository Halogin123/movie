@extends('admin.pages.base.page-view')

@section('page-view')
    <div class="card-header">
        <div >
            <h3 class="card-title">Danh sách 10 trong tổng số {{ $data->total() }} bản ghi</h3>

            <div class="row float-right">
                <div class="col-md-8 d-flex align-items-center">
                    <form method="GET" class="w-100">
                        <div class="input-group input-group-sm" style="max-width: 300px;">
                            <input type="text" name="search" class="form-control" value="{{ $search ?? '' }}" placeholder="Tìm kiếm...">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary d-flex align-items-center">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-4 text-right d-flex align-items-center justify-content-end">
                    <a href="{{ route($route['create']) }}" class="btn btn-info btn-sm d-flex align-items-center"><i class="fas fa-plus"></i> Tạo mới</a>
                </div>
            </div>

        </div>
    </div>

    <div class="card-body" style="overflow: auto">
        @include('admin.pages.' . $resource . '.index')
    </div>

    <div class="paginations">
        {{ $data->appends(request()->all())->links('admin.includes.pagination') }}
    </div>
@endsection()
