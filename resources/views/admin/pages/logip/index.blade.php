<table class="table table-bordered">
    <thead>
    <tr>
        <th>STT</th>
        <th>IP</th>
        <th>Thời gian</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $key => $value)
        <tr class="list-row"
            style="@if(!empty($value['notification']) && $value['notification']['status'] === 1) background-color:#bdbdc180 @endif">
            <td class="cell">{{ $key + 1 }}</td>
            <td class="cell">{{ $value['ip'] }}</td>
            <td class="cell">{{ $value['created_at'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
