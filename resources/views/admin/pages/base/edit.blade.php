@extends('admin.pages.base.page-view')

@section('page-view')
    <form action="{{ route($route['update'], [$route['key'] => $data->id]) }}" method="POST"
          enctype=multipart/form-data>
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        @include('admin.pages.' . $resource . '._form', ['action' => 'update'])
        @include('admin.pages.base.footer', ['action' => 'update'])
    </form>
@endsection()
