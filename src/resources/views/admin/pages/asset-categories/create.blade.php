@extends('admin.layouts.home')

@section('content')
    <div class="content-wrapper" style="margin-left: 0px">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tạo  tài sản</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('asset-categories.index') }}">Nhóm tài sản</a></li>
                            <li class="breadcrumb-item active">Tạo nhóm tài sản</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
            </div>
        </section>
    </div>
@endsection

@section('page-js')
@endsection
