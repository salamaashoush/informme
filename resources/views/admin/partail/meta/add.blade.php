<div class="panel box box-primary">
    <div class="box-header with-border">
        <h4 class="box-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#geographical">
                Add More Info
            </a>
        </h4>
        <a class="btn btn-primary pull-right" id="addnew">
            Add new
        </a>
    </div>
    <div id="geographical" class="panel-collapse collapse in">
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="metatable">
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
                </table>
            </div>
        </div>
    </div>
</div>

