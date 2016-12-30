<div class="modal-dialog" style="width:100%">
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
                                {!! Form::input('hidden','model','Governorate',['class'=>'form-control']) !!}
                                {!! Form::input('hidden','id',$governorate->id,['class'=>'form-control']) !!}
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
                <button type="submit" class="btn btn-primary">Craete</button>
            </div>

        </div>
        {!! Form::close() !!}
                <!-- /.modal-dialog -->
    </div>
</div>
