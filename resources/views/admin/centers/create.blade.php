@extends('admin.layout')
@section('title','Centers')
@section('page-heading','Centers')
@section('styles')
    <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
@stop
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">All Centers</h3>
            <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#Addcenter">
                Add new
            </button>
        </div>
        <div class="box-body">
            <table id="indextable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Edit</th>
                    <th>View</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($centers as $center)
                    <tr>
                        <td>{{$center->name}}</td>
                        <td>{{$center->category['name']}}</td>
                        <td><a href="{{route('centers.edit',$center->id)}}"><span class="fa fa-edit"></span></a></td>
                        <td><a href="{{route('centers.show',$center->id)}}"><span class="fa fa-book"></span></a></td>
                        <td>
                            {!! Form::open(array('method'=>'DELETE','route' => ['centers.destroy',$center->id],'files'=>'true')) !!}
                            <button type="submit" style="border: none;background-color: rgba(0,0,0,0); color:#9f191f">
                                <span class="fa fa-remove"></span>
                            </button>
                            {!! Form::close()!!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Edit</th>
                    <th>View</th>
                    <th>Delete</th>
                </tr>
                </tfoot>
            </table>
        </div>

        <div class="box-footer">
        </div>
    </div>

    <div class="modal fade" id="Addcenter" tabindex="-1" role="dialog" aria-labelledby="Add New Governorate" aria-hidden="true" >
        <div class="modal-dialog" style="width:60%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Create New Center</h4>
                </div>
                {!! Form::open(array('route' => 'centers.store','files'=>'true')) !!}
                <div class="box box-solid">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="box-group" id="accordion">
                            <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                            <div class="panel box box-primary">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#basicinfo">
                                            Basic Info
                                        </a>
                                    </h4>
                                </div>
                                <div id="basicinfo" class="panel-collapse collapse in">
                                    <div class="box-body">
                                        <div class="form-group">
                                            {!! Form::label('Name') !!}
                                            {!! Form::text('name',null,['class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            @if(isset($categories))
                                                @foreach($categories as $option)
                                                    @if($option->type=='centers')
                                                        <?php $options[$option->id]=$option->name ?>
                                                    @endif
                                                @endforeach
                                            @else
                                                {{$options[0]='there is no Cities'}}
                                            @endif
                                            {!! Form::label('Category') !!}
                                            {!! Form::select('cat_id',$options,null,['placeholder' => 'Pick a Category','class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Logo Image') !!}
                                            {!! Form::file('logo',['class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Description') !!}
                                            {!! Form::textarea('desc',null,['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <!-- /.box-body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>

@stop
@section('scripts')
    <script>
        $(function () {
            $("#indextable").DataTable();
        });
    </script>
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
@stop