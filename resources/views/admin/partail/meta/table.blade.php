<table id="metatable" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Property</th>
        <th>Value</th>
    </tr>
    </thead>
    <tbody>
    @if($model->mata->count()>0)
        @foreach($model->meta as $meta)
            <tr>
                <td>{{$meta->key}}</td>
                <td>{{$meta->value}}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
    <tfoot>
    <tr>
        <th>Property</th>
        <th>Value</th>
    </tr>
    </tfoot>
</table>