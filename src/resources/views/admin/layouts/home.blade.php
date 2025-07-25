@include('admin.includes.head')

<div class="wrapper">

    <!-- Navbar -->
    @include('admin.includes.nav')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('admin.includes.main-sidebar')
    <!-- /.Main Sidebar Container -->

    <div class="content-wrapper">
        @yield('content')
    </div>
</div>



@include('admin.includes.script')
@include('admin.includes.footer')

<script>
    $(function() {
        @if(session('toastr'))
            {!! session('toastr') !!}
        @endif
    });
</script>
