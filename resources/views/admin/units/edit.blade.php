@extends('admin.layout')
@section('title','Units Manger')
@section('page-heading','Units Manger')
@section('styles')
    @include('admin.partail.articles.styles')
@stop
@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li><h4 style="padding-left: 10px">{{$unit->name}}</h4></li>
            <li ><a href="#details" data-toggle="tab">Details</a></li>
            <li><a href="#articles" data-toggle="tab">Articles</a></li>
            <li><a href="#photos" data-toggle="tab">Photos</a></li>
            <li class="dropdown pull-right">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="fa fa-gear"></i> Options <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#editdetails" ><i class="fa fa-edit"></i>Edit Details</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#addarticle"><i class="fa fa-plus"></i>Add New Article</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#addphoto"><i class="fa fa-plus"></i>Add New Photo</a></li>
                </ul>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="details">
                <div class="row">
                    <div class="col-sm-3">
                        <img src="{{asset($unit->photos()->where('name','=',$unit->name."_logo")->first()['path'])}}" alt="" class="img-responsive">
                    </div>
                    <div class="col-sm-3">
                        <h5>Name: <span class="text-green">{{$unit->name}}</span></h5>
                        <h5>Governorate: <span class="text-green">{{$unit->city['name']}}</span></h5>
                        <h5>City: <span class="text-green">{{$unit->city->governorate['name']}}</span></h5>
                        <h5>Division: <span class="text-green">{{$unit->division['name']}}</span></h5>
                        <hr>
                        <h5>Description:  <span class="text-green">{{$unit->description}}</span></h5>
                        <hr>
                    </div>
                    <div class="col-sm-3">
                        <h5>Area: <span class="text-green">{{$unit->area}}</span></h5>
                        <h5>Population: <span class="text-green">{{$unit->population}}</span></h5>
                        <h5>Population density: <span class="text-green">{{$unit->p_density_rate}} person/km</span></h5>
                        <hr>
                        <h5>Phone Code: <span class="text-green">{{$unit->code}}</span></h5>
                        <h5>Time Zone: <span class="text-green">{{$unit->time_zone}}</span></h5>
                        <h5>Website: <a href="{{$unit->website}}">{{$unit->website}}</a></h5>
                    </div>
                    <div class="col-md-3">
                        <h5>Creation date: <span class="text-green">{{$unit->creation_date}}</span></h5>
                        <h5>Nation Day:<span class="text-green"> {{$unit->national_day}}</span></h5>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="articles">
                @include('admin.partail.articles.table',['model'=>$unit])
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="photos">
                @include('admin.partail.photos.table',['model'=>$unit])
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
                    <h4 class="modal-title">Edit Division</h4>
                </div>
                {!! Form::model($unit, array('method' => 'PUT','url'=>'units/'. $unit->id,'files'=>'true')) !!}
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
                                            @if(isset($cities))
                                                @foreach($cities as $option)
                                                    <?php $options[$option->id]=$option->name ?>
                                                    {!! Form::select('city_id',$options,null,['placeholder' => 'Pick a City','id'=>'citiesopt','class'=>'form-control']) !!}
                                                @endforeach
                                            @else
                                                {{$options[0]='there is no Cities to choose from'}}
                                            @endif
                                            <br>
                                            <div class="form-group">
                                                <select class="form-control" name="div_id" id="divisionopt" placeholder="Pick a Division">
                                                    <option value="">Pick a Division</option>
                                                </select>
                                            </div>
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
                </div>

                {!! Form::close() !!}
                        <!-- /.modal-dialog -->
            </div>
        </div>
    </div>
    {{--add article modal--}}
    <div class="modal fade" id="addarticle" tabindex="-1" role="dialog" aria-labelledby="Add New Article" aria-hidden="true" >
        @include('admin.partail.articles.add',['model'=>$unit])
    </div>
    {{--add photo modal--}}
    <div class="modal fade" id="addphoto" tabindex="-1" role="dialog" aria-labelledby="Add New Photo" aria-hidden="true" >
        @include('admin.partail.photos.add',['model'=>$unit])
    </div>

@stop
@section('scripts')
    @include('admin.partail.articles.scripts',['model'=>$unit])

    <script>
       $(function () {
            $('#citiesopt').on('change',function(e){
                var city_id= e.target.value;
                $.get('../ajaxdivisions?city_id='+city_id,function(data){
                    $('#divisionsopt').empty();
                    $.each(data,function(index,division){
                        $('#divisionopt').append('<option value="'+division.id+'">'+division.name+'</option>');
                    });
                });
            });
        });
    </script>

@stop