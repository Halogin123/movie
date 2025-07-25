@extends('admin.pages.base.page-view')

@section('page-view')
    @include('admin.pages.' . $resource . '._form', ['action' => 'show'])
    @include('admin.pages.base.footer', ['action' => 'show'])
@endsection()
