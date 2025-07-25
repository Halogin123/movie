<table class="table table-bordered">
    <thead>
    <tr>
        <th style="width: 10px">#</th>
        <th>Name</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $key => $value)
        <tr>
            <td>{{ $key }}</td>
            <td>{{ $value->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
