@extends('admin.layout')
@section('title','governorates')
@section('page-heading','Cities')
@section('styles')
    <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">All Cities</h3>
            <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#Addcity">
                Add new
            </button>
        </div>
        <div class="box-body">
            <table id="indextable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Governorate</th>
                    <th>Area</th>
                    <th>Is Division</th>
                    <th>Population</th>
                    <th>Edit</th>
                    <th>View</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($cities))
                    @foreach($cities as $city)
                        <tr>
                            <td>{{$city->name}}</td>
                            <td>{{$city->governorate}}</td>
                            <td>{{$city->area}}</td>
                            <td>{{$city->is_division?"yes":"no"}}</td>
                            <td>{{$city->population}}</td>
                            <td><a href="{{route('cities.edit',$city->id)}}"><span class="fa fa-edit"></span></a></td>
                            <td><a href="{{route('cities.show',$city->id)}}"><span class="fa fa-book"></span></a></td>
                            <td>
                                {!! Form::open(array('method'=>'DELETE','route' => ['cities.destroy',$city->id],'files'=>'true')) !!}
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
                    <th>Area</th>
                    <th>Is Division</th>
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
    <div class="modal fade" id="Addcity" tabindex="-1" role="dialog" aria-labelledby="Add New Governorate" aria-hidden="true" >
        <div class="modal-dialog" style="width:60%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Create New City</h4>
                </div>
                {!! Form::open(array('route' => 'cities.store','files'=>'true')) !!}
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
                                                {{$options[0]='there is no governorates'}}
                                            @endif
                                            {!! Form::label('Governorate') !!}
                                            {!! Form::select('gover_id',$options,null,['placeholder' => 'Pick a Governorate','id'=>'governorates','class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                             <select class="form-control" name="div_id" id="divisionopt" placeholder="Pick a Division">
                                                  <option value="">Pick a Division</option>
                                             </select>
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Area') !!}
                                            {!! Form::text('area',null,['class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Is Govermental Division') !!}
                                            {!! Form::checkbox('is_division','Is District',['class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Population') !!}
                                            {!! Form::input('number','population',null,['class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Density rate') !!}
                                            {!! Form::input('number','p_density_rate',null,['class'=>'form-control']) !!}
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
             $('#governorates').on('change',function(e){
                var gover_id= e.target.value;
                $.get('../ajaxdivisions?gover_id='+gover_id,function(data){
                    $('#divisionsopt').empty();
                    $.each(data,function(index,division){
                        $('#divisionopt').append('<option value="'+division.id+'">'+division.name+'</option>');
                    });
                });
            });
        });
    </script>
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
@stop