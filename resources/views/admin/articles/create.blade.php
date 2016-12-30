@extends('admin.layout')
@section('title','Articles')
@section('page-heading','Articles')
@section('styles')
    @include('admin.partail.articles.styles')
@stop
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">All Aricles</h3>
            <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#addarticle">
                Add new
            </button>
        </div>
        <div class="box-body">
            <table id="indextable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Edit</th>
                    <th>View</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($articles)&&$articles->count()>0)
                    @foreach($articles as $article)
                        <tr>
                            <td>{{$article->title}}</td>
                            <td>{{$article->type}}</td>
                            <td><a href="{{route('articles.edit',$article->id)}}"><span class="fa fa-edit"></span></a></td>
                            <td><a href="{{route('articles.show',$article->id)}}"><span class="fa fa-book"></span></a></td>
                            <td>
                                {!! Form::open(array('method'=>'DELETE','route' => ['articles.destroy',$article->id])) !!}
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
                    <th>Title</th>
                    <th>Type</th>
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
    <div class="modal fade" id="addarticle" tabindex="-1" role="dialog" aria-labelledby="Add New Article" aria-hidden="true" >
        <div class="modal-dialog" style="width:100%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add New Article</h4>
                </div>
                {!! Form::open(['route' => ['articles.store'],'files'=>'true']) !!}
                <div class="box box-solid">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="box-group" id="accordion">
                            <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                            <div class="panel box box-primary">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#article">
                                            Article Editor
                                        </a>
                                    </h4>
                                </div>
                                <div id="article" class="panel-collapse collapse in">
                                    <div class="box-body">
                                        <div class="form-group">
                                            {!! Form::label('Title') !!}
                                            {!! Form::text('title',null,['class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            <?php $options=[
                                                    'post'=>'Blog Post',
                                                    'about'=>'About article',
                                                    'history'=>'History article',
                                                    'tourism'=>'Tourism article',
                                                    'feature'=>'Feture article',
                                                    'egypt_info'=>'Egypt Info article',
                                                    'help'=>'Help article'
                                            ];
                                            ?>
                                            {!! Form::label('Article Type') !!}
                                            {!! Form::select('type',$options,null,['placeholder' => 'Pick an Article Type','class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Mian Image') !!}
                                            {!! Form::file('main_image',['class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Body') !!}
                                            {!! Form::textarea('body',null,['id'=>'articlebody','class'=>'form-control']) !!}
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

@stop
@section('scripts')
        @include('admin.partail.articles.scripts')
@stop