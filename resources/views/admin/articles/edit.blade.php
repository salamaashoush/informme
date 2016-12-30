@extends('admin.layout')
@section('title','Edit Article')
@section('page-heading','Edit'.$article->title.'article')
@section('styles')
    @include('admin.partail.articles.styles')
@stop
@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li><h4 style="padding-left: 10px">{{$article->title}}</h4></li>
            <li ><a href="#article" data-toggle="tab">Article</a></li>
            <li ><a href="#comments" data-toggle="tab">Comments</a></li>
            <li class="dropdown pull-right">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="fa fa-gear"></i> Options <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#editdetails" ><i class="fa fa-edit"></i>Edit Details</a></li>
                </ul>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="article">
                <div class="row" style="margin-left: 10px">
                   <h3>{{$article->title}}</h3>
                   <p class="lead">{!! $article->body !!}</p>
                    <hr>
                   <p class="text-gray">Article type: {{$article->type}}</p>
                   <p class="text-gray"><i class="fa fa-comments"></i>{{$article->reviews->count()}} Comments</p>
                </div>
            </div>
            <div class="tab-pane" id="comments">
                <div class="row" style="margin-left: 10px">
                    @if($article->reviews()->count())
                        @foreach($article->reviews as $review)
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object img-circle" alt="media image"
                                         src="{{asset($review->user->photos()->where('name','=','profile')->first())}}"
                                         style="width: 64px; height: 64px;">
                                </a>

                                <div class="media-body">
                                    <h4 class="media-heading">{{$review->user['name']}}</h4>
                                    {{$review->body}}
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <!-- /.tab-content -->
    </div>

    <div class="modal fade" id="editdetails" tabindex="-1" role="dialog" aria-labelledby="Add New Article" aria-hidden="true" >
        <div class="modal-dialog" style="width:60%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Edit Article</h4>
                </div>
                {!! Form::model($article, array('method' => 'PUT','url'=>'articles/'. $article->id,'files'=>'true')) !!}
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
                                            <?php $options=[
                                                    'country'=>'Country',
                                                    'civil'=>'Civil',
                                                    'desert'=>'Desert',
                                            ];
                                            ?>
                                            {!! Form::label('Adminstrative Division Type') !!}
                                            {!! Form::select('type',$options,null,['placeholder' => 'Pick a Type','class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Capital') !!}
                                            {!! Form::text('capital',null,['class'=>'form-control']) !!}
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
                                            {!! Form::label('Area') !!}
                                            {!! Form::text('area',null,['class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Population') !!}
                                            {!! Form::input('text','population',null,['class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Density rate') !!}
                                            {!! Form::input('text','p_density_rate',null,['class'=>'form-control']) !!}
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
                                            <img src="{{$gover}}" alt="">
                                            {!! Form::label('Change Flag Image') !!}
                                            {!! Form::file('flag',['class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Change Logo Image') !!}
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
                    {!! Form::close() !!}
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

@stop
@section('scripts')
    @include('admin.partail.articles.scripts')
@stop