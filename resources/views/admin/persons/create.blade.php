@extends('admin.layout')
@section('title','governorates')
@section('page-heading','governorates')
@section('styles')
    <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">All Governorates</h3>
            <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#Addgovernorate">
                Add new
            </button>
        </div>
        <div class="box-body">
            <table id="indextable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Capital</th>
                    <th>Area</th>
                    <th>Cities</th>
                    <th>Divisions</th>
                    <th>Units</th>
                    <th>Population</th>
                    <th>Edit</th>
                    <th>View</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($governorates as $governorate)
                    <tr>
                        <td>{{$governorate->name}}</td>
                        <td>{{$governorate->capital}}</td>
                        <td>{{$governorate->area}}</td>
                        <td>{{$governorate->cities}}</td>
                        <td>{{$governorate->divisions}}</td>
                        <td>{{$governorate->units}}</td>
                        <td>{{$governorate->population}}</td>
                        <td><a href="{{route('governorates.edit',$governorate->id)}}"><span class="fa fa-edit"></span></a></td>
                        <td><a href="{{route('governorates.show',$governorate->id)}}"><span class="fa fa-book"></span></a></td>
                        <td>
                            {!! Form::open(array('method'=>'DELETE','route' => ['governorates.destroy',$governorate->id],'files'=>'true')) !!}
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
                    <th>Capital</th>
                    <th>Area</th>
                    <th>Cities</th>
                    <th>Divisions</th>
                    <th>Units</th>
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
    <div class="modal fade" id="Addgovernorate" tabindex="-1" role="dialog" aria-labelledby="Add New Governorate" aria-hidden="true" >
        <div class="modal-dialog" style="width:60%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Create New Governorate</h4>
                </div>
                {!! Form::open(array('route' => 'governorates.store','files'=>'true')) !!}
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
                                            {!! Form::label('Capital') !!}
                                            {!! Form::text('capital',null,['class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Area') !!}
                                            {!! Form::text('area',null,['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel box box-primary">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#geographical">
                                            Geographical Info
                                        </a>
                                    </h4>
                                </div>
                                <div id="geographical" class="panel-collapse collapse in">
                                    <div class="box-body">
                                        <div class="form-group">
                                            {!! Form::label('Cities') !!}
                                            {!! Form::input('number','cities',null,['class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Local Divisions') !!}
                                            {!! Form::input('number','divisions',null,['class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Local Units') !!}
                                            {!! Form::input('number','units',null,['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel box box-primary">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#population">
                                            Population Info
                                        </a>
                                    </h4>
                                </div>
                                <div id="population" class="panel-collapse collapse in">
                                    <div class="box-body">
                                        <div class="form-group">
                                            {!! Form::label('Population') !!}
                                            {!! Form::input('number','population',null,['class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Density rate') !!}
                                            {!! Form::input('number','p_density_rate',null,['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel box box-primary">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#contacts">
                                            Contacts Info
                                        </a>
                                    </h4>
                                </div>
                                <div id="contacts" class="panel-collapse collapse in">
                                    <div class="box-body">
                                        <div class="form-group">
                                            {!! Form::label('Phone code') !!}
                                            {!! Form::input('number','code',null,['class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Time Zone') !!}
                                            {!! Form::text('time_zone',null,['class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Website') !!}
                                            {!! Form::input('url','website',null,['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel box box-primary">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#historical">
                                            Historical Info
                                        </a>
                                    </h4>
                                </div>
                                <div id="historical" class="panel-collapse collapse in">
                                    <div class="box-body">
                                        <div class="form-group">
                                            {!! Form::label('Creation date') !!}
                                            {!! Form::input('text','creation_date',null,['class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('National day') !!}
                                            {!! Form::input('text','national_day',null,['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel box box-primary">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#description">
                                            Description Info
                                        </a>
                                    </h4>
                                </div>
                                <div id="description" class="panel-collapse collapse in">
                                    <div class="box-body">
                                        <div class="form-group">
                                            {!! Form::label('Description') !!}
                                            {!! Form::textarea('description',null,['class'=>'form-control']) !!}
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="panel box box-primary">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#images">
                                            Images
                                        </a>
                                    </h4>
                                </div>
                                <div id="images" class="panel-collapse collapse in">
                                    <div class="box-body">
                                        <div class="form-group">
                                            {!! Form::label('Flag Image') !!}
                                            {!! Form::file('flag',['class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Logo Image') !!}
                                            {!! Form::file('logo',['class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Feature Images') !!}
                                            {!! Form::file('images[]',['multiple'=>'true','class'=>'form-control']) !!}
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
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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