@extends('admin.layout')
@section('title','photos')
@section('page-heading','photos')
@section('styles')
    <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
@stop
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">All Photos</h3>
            <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#Addphoto">
                Add new
            </button>
        </div>
        <div class="box-body">
            <table id="indextable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Tag</th>
                    <th>Path</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($photos)&&$photos->count()>0)
                    @foreach($photos as $photo)
                        <tr>
                            <td>{{$photo->name}}</td>
                            <td>{{$photo->tag}}</td>
                            <td>{{link_to_asset($photo->url,$photo->name)}}</td>
                            <td>
                                {!! Form::open(array('method'=>'DELETE','route' => ['photos.destroy',$photo->id],'files'=>'true')) !!}
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
                    <th>Tag</th>
                    <th>Path</th>
                    <th>Delete</th>
                </tr>
                </tfoot>
            </table>
        </div>

        <div class="box-footer">
        </div>
    </div>
    <div class="modal fade" id="Addphoto" tabindex="-1" role="dialog" aria-labelledby="Add New Photo" aria-hidden="true" >
        <div class="modal-dialog" style="width:60%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add New Photo</h4>
                </div>
                {!! Form::open(['route' => ['photos.store'],'files'=>'true']) !!}
                <div class="box box-solid">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="box-group" id="accordion">
                            <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
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
                                            <?php $options=[
                                                    'post'=>'Blog photo',
                                                    'about'=>'About photo',
                                                    'history'=>'History photo',
                                                    'tourism'=>'Tourism photo',
                                                    'features'=>'Feture photo',
                                                    'logos'=>'Logo photo',
                                                    'flags'=>'Flag photo',
                                                    'egypt_info'=>'Egypt Info photo',
                                                    'help'=>'Help photo'
                                            ];
                                            ?>
                                            {!! Form::label('Image Type') !!}
                                            {!! Form::select('type',$options,null,['placeholder' => 'Pick an Image type','class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Add Images') !!}
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
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>

                </div>
                {!! Form::close() !!}
                        <!-- /.modal-dialog -->
            </div>
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