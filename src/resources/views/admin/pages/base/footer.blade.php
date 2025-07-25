<div class="card-footer">
    <div class="btn-group">
        <?php
        if ($action === 'create') {
            $url = route($route['create']);
        } else if ($action === 'update') {
            $url = route($route['update'], [$route['key'] => $data['id']]);
        } else if ($action === 'show') {
            $url = route($route['edit'], [$route['key'] => $data['id']]);
        }
        ?>
        @if ($action === 'show')
            <a href="{{ $url }}" class="btn btn-warning">Sửa</a>
        @endif
        @if ($action === 'update' || $action === 'create')
            <button type="submit" class="btn btn-info">Lưu và quay
                lại
            </button>
            <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu" role="menu">
                <a class="dropdown-item" href="{{ $url }}">Lưu và
                    tiếp tục sửa</a>
                <a class="dropdown-item" href="#">Lưu và thêm mới</a>
                <a class="dropdown-item" href="#">Lưu và xem lại</a>
            </div>
    </div>
    @endif
    <div class="btn-group">
        <a href="{{ route($route['index']) }}" class="btn btn-block btn-default">Hủy bỏ</a>
    </div>
</div>
