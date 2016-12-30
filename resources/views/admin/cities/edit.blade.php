@extends('admin.layout')
@section('title','Cities Manger')
@section('page-heading','Cities Manger')
@section('styles')
    @include('admin.partail.articles.styles')
@stop
@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li><h4 style="padding-left: 10px">{{$city->name}}</h4></li>
            <li ><a href="#details" data-toggle="tab">Details</a></li>
            <li ><a href="#divisions" data-toggle="tab">Division</a></li>
            <li><a href="#articles" data-toggle="tab">Articles</a></li>
            <li><a href="#photos" data-toggle="tab">Photos</a></li>
            <li class="dropdown pull-right">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="fa fa-gear"></i> Options <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#editdetails" ><i class="fa fa-edit"></i>Edit Details</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#adddivision"><i class="fa fa-plus"></i>Add New Division</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#addarticle"><i class="fa fa-plus"></i>Add New Article</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#addphoto"><i class="fa fa-plus"></i>Add New Photo</a></li>
                </ul>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="details">
                <div class="row">
                    <div class="col-sm-3">
                        <img src="../../{{$city->photos()->where('name','=',$city->name."_logo")->first()['path']}}" alt="" class="img-responsive">
                    </div>
                    <div class="col-sm-3">
                        <h5>Name: <span class="text-green">{{$city->name}}</span></h5>
                        <h5>Capital: <span class="text-green">{{$city->governorate}}</span></h5>
                        <h5>Description: <span class="text-green">{{$city->description}}</span></h5>
                        <hr>
                        <h5>Number of divisions: <span class="text-green">{{$city->divisions}}</span></h5>
                        <h5>Number of units: <span class="text-green">{{$city->units}}</span></h5>
                        <hr>
                    </div>
                    <div class="col-sm-3">
                        <h5>Area: <span class="text-green">{{$city->area}}</span></h5>
                        <h5>Population: <span class="text-green">{{$city->population}}</span></h5>
                        <h5>Population density: <span class="text-green">{{$city->p_density_rate}} person/km</span></h5>
                        <hr>
                        <h5>Phone Code: <span class="text-green">{{$city->code}}</span></h5>
                        <h5>Time Zone: <span class="text-green">{{$city->time_zone}}</span></h5>
                        <h5>Website: <a href="{{$city->website}}">{{$city->website}}</a></h5>
                    </div>
                    <div class="col-md-3">
                        <h5>Creation date: <span class="text-green">{{$city->creation_date}}</span></h5>
                        <h5>Nation Day:<span class="text-green"> {{$city->national_day}}</span></h5>
                    </div>
                </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="divisions">
                <table id="indextable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Governorate</th>
                        <th>City</th>
                        <th>Area</th>
                        <th>Units</th>
                        <th>Population</th>
                        <th>Edit</th>
                        <th>View</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>


                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Governorate</th>
                        <th>city</th>
                        <th>Area</th>
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
                @include('admin.partail.articles.table',['model'=>$city])
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="photos">
                @include('admin.partail.photos.table',['model'=>$city])
            </div>
        </div>
        <!-- /.tab-content -->
    </div>





    {{--edit details modal--}}
    <div class="modal fade" id="editdetails" tabindex="-1" role="dialog" aria-labelledby="Edit Details" aria-hidden="true" >
        <div class="modal-dialog" style="width:60%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Edit City</h4>
                </div>
                {!! Form::model($city, array('method' => 'PUT','url'=>'cities/'. $city->id,'files'=>'true')) !!}
                <div class="box box-solid">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="box-group" id="accordion">
                            <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                            <div class="panel box box-primary">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#cbasicinfo">
                                            Basic Info
                                        </a>
                                    </h4>
                                </div>
                                <div id="cbasicinfo" class="panel-collapse collapse in">
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
                                                {{$options=['']}}
                                            @endif
                                            {!! Form::label('Governorate') !!}
                                            {!! Form::select('gover_id',$options,null,['placeholder' => 'Pick a Governorate','id'=>'governorates','class'=>'form-control']) !!}
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
                                        <a data-toggle="collapse" data-parent="#accordion" href="#cgeographical">
                                            Geographical Info
                                        </a>
                                    </h4>
                                </div>
                                <div id="cgeographical" class="panel-collapse collapse in">
                                    <div class="box-body">
                                        <div class="form-group">
                                            {!! Form::label('Local Divisions') !!}
                                            {!! Form::input('number','divisions',null,['class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Local Units') !!}
                                            {!! Form::input('number','units',null,['class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Is Govermental Division') !!}
                                            {!! Form::checkbox('is_division','Is District',['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel box box-primary">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#cpopulation">
                                            Population Info
                                        </a>
                                    </h4>
                                </div>
                                <div id="cpopulation" class="panel-collapse collapse in">
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
                                        <a data-toggle="collapse" data-parent="#accordion" href="#ccontacts">
                                            Contacts Info
                                        </a>
                                    </h4>
                                </div>
                                <div id="ccontacts" class="panel-collapse collapse in">
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
                                        <a data-toggle="collapse" data-parent="#accordion" href="#chistorical">
                                            Historical Info
                                        </a>
                                    </h4>
                                </div>
                                <div id="chistorical" class="panel-collapse collapse in">
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
                                        <a data-toggle="collapse" data-parent="#accordion" href="#cdescription">
                                            Description Info
                                        </a>
                                    </h4>
                                </div>
                                <div id="cdescription" class="panel-collapse collapse in">
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
                                        <a data-toggle="collapse" data-parent="#accordion" href="#cimages">
                                            Images
                                        </a>
                                    </h4>
                                </div>
                                <div id="cimages" class="panel-collapse collapse in">
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

                </div>
                {!! Form::close() !!}
                        <!-- /.modal-dialog -->
            </div>
        </div>
    </div>
    {{--add city modal--}}
    <div class="modal fade" id="adddivision" tabindex="-1" role="dialog" aria-labelledby="Add New City" aria-hidden="true" >
        <div class="modal-dialog" style="width:60%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add New Division</h4>
                </div>
                {!! Form::open(['route' => ['divisions.store'],'files'=>'true']) !!}
                <div class="box box-solid">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="box-group" id="accordion">
                            <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                            <div class="panel box box-primary">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#cbasicinfo">
                                            Basic Info
                                        </a>
                                    </h4>
                                </div>
                                <div id="cbasicinfo" class="panel-collapse collapse in">
                                    <div class="box-body">
                                        <div class="form-group">
                                            {!! Form::label('Name') !!}
                                            {!! Form::text('name',null,['class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            @if(isset($cities))
                                                @foreach($cities as $option)
                                                    <?php $options[$option->id]=$option->name ?>
                                                @endforeach
                                            @else
                                                {{$options[0]='there no city there'}}
                                            @endif
                                            {!! Form::label('City') !!}
                                            {!! Form::select('city_id',$options,null,['placeholder' => 'Pick a Governorate','id'=>'governorates','class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Area') !!}
                                            {!! Form::text('area',null,['class'=>'form-control']) !!}
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
                                        <a data-toggle="collapse" data-parent="#accordion" href="#cpopulation">
                                            Population Info
                                        </a>
                                    </h4>
                                </div>
                                <div id="cpopulation" class="panel-collapse collapse in">
                                    <div class="box-body">
                                        <div class="form-group">
                                            {!! Form::label('Population') !!}
                                            {!! Form::input('number','population',null,['class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Density rate') !!}
                                            {!! Form::input('number','p_density_rate',null,['class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Is District') !!}
                                            {!! Form::checkbox('is_district','Is District',['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel box box-primary">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#ccontacts">
                                            Contacts Info
                                        </a>
                                    </h4>
                                </div>
                                <div id="ccontacts" class="panel-collapse collapse in">
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
                                        <a data-toggle="collapse" data-parent="#accordion" href="#chistorical">
                                            Historical Info
                                        </a>
                                    </h4>
                                </div>
                                <div id="chistorical" class="panel-collapse collapse in">
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
                                        <a data-toggle="collapse" data-parent="#accordion" href="#cdescription">
                                            Description Info
                                        </a>
                                    </h4>
                                </div>
                                <div id="cdescription" class="panel-collapse collapse in">
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
                                        <a data-toggle="collapse" data-parent="#accordion" href="#cimages">
                                            Images
                                        </a>
                                    </h4>
                                </div>
                                <div id="cimages" class="panel-collapse collapse in">
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

                </div>
                {!! Form::close() !!}
                        <!-- /.modal-dialog -->
            </div>
        </div>
    </div>
    {{--add article modal--}}
    <div class="modal fade" id="addarticle" tabindex="-1" role="dialog" aria-labelledby="Add New Article" aria-hidden="true" >
        @include('admin.partail.articles.add',['model'=>$city])
    </div>
    {{--add photo modal--}}
    <div class="modal fade" id="addphoto" tabindex="-1" role="dialog" aria-labelledby="Add New Photo" aria-hidden="true" >
        @include('admin.partail.photos.add',['model'=>$city])
    </div>

@stop
@section('scripts')
    @include('admin.partail.articles.scripts')
@stop