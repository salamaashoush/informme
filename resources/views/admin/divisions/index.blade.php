@extends('admin.layout')
@section('title','governorates')
@section('page-heading','Cities')
@section('styles')
    <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">All Cities in</h3>

            <div class="inline-form">
                {!! Form::open() !!}
                @if(isset($cities)&&$cities->count()>0)
                    @foreach($cities as $option)
                        <?php $options[$option->id]=$option->name ?>
                    @endforeach
                @else
                    <?php $options[0]='there is nothing to view'?>
                @endif
                {!! Form::select('city_id',$options,null,['placeholder' => 'All Cities','id'=>'cities','class'=>'form-control']) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <div class="box-body" id="citiesdiv">
            @if(isset($cities)&&$cities->count()>0)
                @foreach($cities as $city)
                    @foreach($city->divisions()->get()->chunk(4) as $chunk)
                    <div class="row">
                        @foreach($chunk as $division)
                            <div class="col-sm-4 col-lg-3">
                                <div class="box box-widget widget-user">
                                    <div class="box box-widget widget-user">
                                        <!-- Add the bg color to the header using any of the bg-* classes -->
                                        <div class="widget-user-header bg-yellow "style=" background: url('{{asset($division->photos()->where('name','=',$division->name."_flag")->first()['path'])}}') center center;">
                                            <!-- /.widget-user-image -->
                                            <h3 class="widget-user-username">{{$division->name}}</h3>
                                            <h5 class="widget-user-desc">{{$division->city['name']}}</h5>
                                        </div>
                                        <div class="box-footer no-padding">
                                            <ul class="nav nav-stacked">
                                                <li><a href="#">Units <span class="pull-right badge bg-blue">{{$division->units}}</span></a></li>
                                                <li><a href="#">Governorate <span class="pull-right badge bg-red">{{$division->city->governorate['name']}}</span></a></li>
                                                <li><a href="#">Area <span class="pull-right badge bg-red">{{$division->area}}</span></a></li>
                                            </ul>
                                            <a href="{{route('divisions.show',$division->id)}}" class="btn btn-info btn-block">view Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endforeach
                @endforeach
            @endif
        </div>

        <div class="box-footer">
        </div>
    </div>
@stop
@section('scripts')
    <script src="{{asset('plugins/handlebar/handlebars-v4.0.5.js')}}"></script>
    <script id="template" type="text/x-handlebars-template">
        <div class="row">
            <div class="col-sm-4 col-lg-3">
                <div class="box box-widget widget-user">
                    <div class="box box-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-yellow "style=" background: url('') center center;">
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username">@{{name}}</h3>
                            <h5 class="widget-user-desc">@{{governorate}}</h5>
                        </div>
                        <div class="box-footer no-padding">
                            <ul class="nav nav-stacked">
                                <li><a href="#">Population <span class="pull-right badge bg-blue">@{{population}}</span></a></li>
                                <li><a href="#">units <span class="pull-right badge bg-red">@{{units}}</span></a></li>
                                <li><a href="#">division <span class="pull-right badge bg-red">@{{divisions}}</span></a></li>
                            </ul>
                            <a href="{{url('cities/show/')}}/@{{id}}" class="btn btn-info btn-block">view Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </script>

    <script>
       template=Handlebars.compile($('#template').html());
        $('#governorates').on('change',function(e){
            var gover_id= e.target.value;
            $.get('ajaxcities?gover_id='+gover_id,function(data){
                $('#citiesdiv').empty();
                $.each(data,function(index,city){
                         var data={
                             id:city.id,
                             name:city.name,
                             governorate:city.governorate,
                             population:city.population,
                             units:city.units,
                             divisions:city.divisions,
                         }
                         $('#citiesdiv').append(template(data));
                });
            });
        });
    </script>
@stop