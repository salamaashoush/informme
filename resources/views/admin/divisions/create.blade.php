@extends('admin.layout')
@section('title','Division Manger')
@section('page-heading','Divisions Manger')
@section('styles')
    <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">All Divisions</h3>
            <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#adddivision">
                Add new
            </button>
        </div>
        <div class="box-body">
            <table id="indextable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Governorate</th>
                    <th>Type</th>
                    <th>Area</th>
                    <th>Population</th>
                    <th>Edit</th>
                    <th>View</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($divisions))
                    @foreach($divisions as $division)
                        <tr>
                            <td>{{$division->name}}</td>
                            <td>{{$division->governorate['name']}}</td>
                            <td>{{$division->type}}</td>
                            <td>{{$division->area}}</td>
                            <td>{{$division->population}}</td>
                            <td><a href="{{route('divisions.edit',$division->id)}}"><span class="fa fa-edit"></span></a></td>
                            <td><a href="{{route('divisions.show',$division->id)}}"><span class="fa fa-book"></span></a></td>
                            <td>
                                {!! Form::open(array('method'=>'DELETE','route' => ['divisions.destroy',$division->id],'files'=>'true')) !!}
                                <button type="submit" style="border: none;background-color: rgba(0,0,0,0); color:#9f191f">
                                    <span class="fa fa-remove"></span>
                                </button>
                                {!! Form::close()!!}
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
                <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Governorate</th>
                    <th>Type</th>
                    <th>Area</th>
                    <th>Population</th>
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
    <div class="modal fade" id="adddivision" tabindex="-1" role="dialog" aria-labelledby="Add New Division" aria-hidden="true" >
        <div class="modal-dialog" style="width:60%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Create New Division</h4>
                </div>
                {!! Form::open(array('route' => 'divisions.store','files'=>'true')) !!}
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
                                            @if(isset($governorates))
                                                @foreach($governorates as $option)
                                                    <?php $options[$option->id]=$option->name ?>
                                                @endforeach
                                            @else
                                                {{$options[0]='there is no Cities'}}
                                            @endif
                                            {!! Form::label('Governorate') !!}
                                            {!! Form::select('gover_id',$options,null,['placeholder' => 'Pick a Governorate','id'=>'cities','class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            <?php $options=[
                                                    'district'=>'District',
                                                    'division'=>'Governorate division'
                                            ];
                                            ?>
                                            {!! Form::label('Division Type') !!}
                                            {!! Form::select('type',$options,null,['placeholder' => 'Pick a Division Type','class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Area') !!}
                                            {!! Form::text('area',null,['class'=>'form-control']) !!}
                                        </div>
                                         <div class="form-group">
                                            {!! Form::label('Population') !!}
                                            {!! Form::input('number','population',null,['class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Description') !!}
                                            {!! Form::textarea('description',null,['class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Flag Image') !!}
                                            {!! Form::file('flag',['class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Logo Image') !!}
                                            {!! Form::file('logo',['class'=>'form-control']) !!}
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
                        <button type="submit" class="btn btn-primary">Craete</button>
                    </div>
                </div>
                {!! Form::close() !!}
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