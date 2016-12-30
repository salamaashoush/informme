@extends('admin.layout')
@section('title','governorates')
@section('page-heading','governorates')
@section('styles')
    <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
@stop
@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li><h4 style="padding-left: 10px">{{$governorate->name}}</h4></li>
            <li ><a href="#details" data-toggle="tab">Details</a></li>
            <li ><a href="#cities" data-toggle="tab">Cities</a></li>
            <li><a href="#articles" data-toggle="tab">Articles</a></li>
            <li><a href="#photos" data-toggle="tab">Photos</a></li>
            <li class="dropdown pull-right">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="fa fa-gear"></i> Options <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#editdetails" ><i class="fa fa-edit"></i>Edit Details</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#addcity"><i class="fa fa-plus"></i>Add New City</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#"><i class="fa fa-plus"></i>Add New Article</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="fa fa-plus"></i>Add New Photo</a></li>
                </ul>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="details">
               Details
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="cities">
                <table id="indextable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Capital</th>
                        <th>Area</th>
                        <th>Divisions</th>
                        <th>Units</th>
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
                                <td>{{$city->capital}}</td>
                                <td>{{$city->area}}</td>
                                <td>{{$city->divisions}}</td>
                                <td>{{$city->units}}</td>
                                <td>{{$city->population}}</td>
                                <td><a href="{{route('governorates.cities.edit',[$governorate->id,$city->id])}}"><span class="fa fa-edit"></span></a></td>
                                <td><a href="{{route('governorates.show',$governorate->id)}}"><span class="fa fa-book"></span></a></td>
                                <td>
                                    {!! Form::open(array('method'=>'DELETE','route' => ['governorates.cities.destroy',$governorate->id,$city->id],'files'=>'true')) !!}
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
                        <th>Capital</th>
                        <th>Area</th>
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
            <!-- /.tab-pane -->
            <div class="tab-pane" id="articles">
                <table id="indextable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Capital</th>
                        <th>Area</th>
                        <th>Divisions</th>
                        <th>Units</th>
                        <th>Population</th>
                        <th>Edit</th>
                        <th>View</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($articles))
                        @foreach($articles as $article)
                            <tr>
                                <td>{{$article->name}}</td>
                                <td>{{$article->capital}}</td>
                                <td>{{$article->area}}</td>
                                <td>{{$article->divisions}}</td>
                                <td>{{$article->units}}</td>
                                <td>{{$article->population}}</td>
                                <td><a href="{{route('articles.edit',$article->id)}}"><span class="fa fa-edit"></span></a></td>
                                <td><a href="{{route('articles',$article->id)}}"><span class="fa fa-book"></span></a></td>
                                <td>
                                    {!! Form::open(array('method'=>'DELETE','route' => ['articles.destroy',$article->id],'files'=>'true')) !!}
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
                        <th>Capital</th>
                        <th>Area</th>
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
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div>





    {{--edit details modal--}}
    <div class="modal fade" id="editdetails" tabindex="-1" role="dialog" aria-labelledby="Add New Governorate" aria-hidden="true" >
        <div class="modal-dialog" style="width:60%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Create New Governorate</h4>
                </div>
                {!! Form::model($governorate, array('method' => 'PUT','url'=>'governorates/'. $governorate->id,'files'=>'true')) !!}
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
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
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
        <!-- /.modal-dialog -->
    </div>

    {{--add city modal--}}
    <div class="modal fade" id="addcity" tabindex="-1" role="dialog" aria-labelledby="Add New City" aria-hidden="true" >
        <div class="modal-dialog" style="width:60%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add New City</h4>
                </div>
                {!! Form::open(['route' => ['governorates.cities.store',$governorate->id],'files'=>'true']) !!}
                <div class="modal-body">
                    <div class="form-inline form-group">
                        <div class="col-md-3">
                            {!! Form::label('Name') !!}
                            {!! Form::text('name',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="col-sm-3">
                            {!! Form::label('Area') !!}
                            {!! Form::text('area',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="col-sm-3">
                            @if(isset($governorates))
                                @foreach($governorates as $option)
                                    <?php $options[$option->id]=$option->name ?>
                                @endforeach
                            @else
                                {{$options=['']}}
                            @endif
                            {!! Form::label('Governorate') !!}
                            {!! Form::select('gover_id',$options,null,['placeholder' => 'Pick a Governorate','id'=>'governorates','class'=>'form-control']) !!}
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class=" form-inline form-group">
                        <div class="col-sm-3">
                            {!! Form::label('Local Divisions') !!}
                            {!! Form::input('number','divisions',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="col-sm-3">
                            {!! Form::label('Local Units') !!}
                            {!! Form::input('number','units',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="form-inline form-group">
                        <div class="col-sm-3">
                            {!! Form::label('Population') !!}
                            {!! Form::input('number','population',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="col-sm-3">
                            {!! Form::label('Density rate') !!}
                            {!! Form::input('number','p_density_rate',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="form-inline form-group">
                        <div class="col-sm-3">
                            {!! Form::label('Phone code') !!}
                            {!! Form::input('number','code',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="col-sm-3">
                            {!! Form::label('Time Zone') !!}
                            {!! Form::text('time_zone',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="col-sm-3">
                            {!! Form::label('Website') !!}
                            {!! Form::input('url','website',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="form-inline form-group">
                        <div class="col-sm-3">
                            {!! Form::label('Creation date') !!}
                            {!! Form::input('date','creation_date',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="col-sm-3">
                            {!! Form::label('National day') !!}
                            {!! Form::input('date','national_day',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('Description') !!}
                        {!! Form::textarea('description',null,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-inline form-group">
                        <div class="col-sm-3">
                            {!! Form::label('Flag Image') !!}
                            {!! Form::file('flag',['class'=>'form-control']) !!}
                        </div>
                        <div class="col-sm-3">
                            {!! Form::label('Logo Image') !!}
                            {!! Form::file('logo',['class'=>'form-control']) !!}
                        </div>
                        <div class="col-sm-3">
                            {!! Form::label('Feature Image') !!}
                            {!! Form::file('feature',['class'=>'form-control']) !!}
                        </div>
                        <div class="clearfix"></div>
                        <p class="help-block">Example block-level help text here.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
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