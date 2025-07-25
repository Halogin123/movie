@extends('admin.pages.base.page-view')

@section('page-view')
    <form action="{{ route($route['store']) }}" method="POST"
          enctype=multipart/form-data>
        {{ csrf_field() }}
        {{ method_field('POST') }}
        @include('admin.pages.' . $resource . '._form', ['action' => 'create'])
        @include('admin.pages.base.footer', ['action' => 'create'])
    </form>
@endsection()
