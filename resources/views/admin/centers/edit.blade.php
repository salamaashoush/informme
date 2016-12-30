@extends('admin.layout')
@section('title','Centers')
@section('page-heading','Centers')
@section('styles')
    @include('admin.partail.articles.styles')
@stop
@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li><h4 style="padding-left: 10px">{{$center->name}}</h4></li>
            <li ><a href="#details" data-toggle="tab">Details</a></li>
            <li ><a href="#cities" data-toggle="tab">Services</a></li>
            <li><a href="#articles" data-toggle="tab">Articles</a></li>
            <li><a href="#photos" data-toggle="tab">Photos</a></li>
            <li class="dropdown pull-right">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="fa fa-gear"></i> Options <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#editdetails" ><i class="fa fa-edit"></i>Edit Details</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#adddivision"><i class="fa fa-plus"></i>Add New Division</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#addarticle"><i class="fa fa-plus"></i>Add New Service</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#addphoto"><i class="fa fa-plus"></i>Add New Photo</a></li>
                </ul>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="details">
                <div class="row">
                    <div class="col-sm-3">
                        <img src="{{asset($center->photos()->where('tag','=','logos')->first()['url'])}}" alt="" class="img-responsive">                    </div>
                    <div class="col-sm-3">
                        <h5>Name: <span class="text-green">{{$center->name}}</span></h5>
                        <h5>Category: <span class="text-green">{{$center->category['name']}}</span></h5>
                        <h5>Description: <span class="text-green">{{$center->desc}}</span></h5>
                        <hr>
                    </div>
                </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="cities">
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
                    @if($center->services->count()>0)
                        @foreach($center->services as $service)
                            <tr>
                                <td>{{$service->name}}</td>
                                <td>{{$service->category}}</td>
                                <td><a href="{{route('services.edit',$service->id)}}"><span class="fa fa-edit"></span></a></td>
                                <td><a href="{{route('services.show',$service->id)}}"><span class="fa fa-book"></span></a></td>
                                <td>
                                    {!! Form::open(array('method'=>'DELETE','route' => ['cities.destroy',$service->id],'files'=>'true')) !!}
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
                        <th>Category</th>
                        <th>Edit</th>
                        <th>View</th>
                        <th>Delete</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="articles">
                @include('admin.partail.articles.table',['model'=>$center])
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="photos">
                @include('admin.partail.photos.table',['model'=>$center])
            </div>
        </div>
        <!-- /.tab-content -->
    </div>





    {{--edit details modal--}}
    <div class="modal fade" id="editdetails" tabindex="-1" role="dialog" aria-labelledby="Edit Center" aria-hidden="true" >
        <div class="modal-dialog" style="width:60%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Edit {{$center->name}} Info</h4>
                </div>
                {!! Form::model($center, array('method' => 'PUT','url'=>'centers/'. $center->id,'files'=>'true')) !!}
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
    </div>
    {{--add city modal--}}
    <div class="modal fade" id="adddivision" tabindex="-1" role="dialog" aria-labelledby="Add New Division" aria-hidden="true" >
        <div class="modal-dialog" style="width:60%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add New Service</h4>
                </div>
                {!! Form::open(['route' => ['services.store'],'files'=>'true']) !!}
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
                                            <?php $options=[
                                                    'district'=>'District',
                                                    'admins_div'=>'Adminstrative Division',
                                            ];
                                            ?>
                                            {!! Form::label('Adminstrative Division Type') !!}
                                            {!! Form::select('type',$options,null,['placeholder' => 'Pick a Type','class'=>'form-control']) !!}
                                        </div>
                                        {!! Form::input('hidden','governorate','Governorate',['class'=>'form-control']) !!}
                                        {!! Form::input('hidden','governorate_id',$center->id,['class'=>'form-control']) !!}
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
                                            {!! Form::label('Is a City') !!}
                                            {!! Form::checkbox('is_city','Is City',['class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Population') !!}
                                            {!! Form::input('text','population',null,['class'=>'form-control']) !!}
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
        @include('admin.partail.articles.add',['model'=>$center])
    </div>
    {{--add photo modal--}}
    <div class="modal fade" id="addphoto" tabindex="-1" role="dialog" aria-labelledby="Add New Photo" aria-hidden="true" >
        @include('admin.partail.photos.add',['model'=>$center])
    </div>

@stop
@section('scripts')
    @include('admin.partail.articles.scripts')
@stop