@extends('admin.layout')
@section('title','governorates')
@section('page-heading','governorates')
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">All Governorates</h3>
        </div>
        <div class="box-body">
            @foreach($governorates->chunk(4) as $chunk)
                <div class="row">
                    @foreach($chunk as $governorate)
                        <div class="col-sm-4 col-lg-3">
                            <div class="box box-widget widget-user">
                                <div class="box box-widget widget-user">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-yellow "style=" background: url('{{asset($governorate->photos()->where('tag','=',"flags")->first()['url'])}}') center center;">
                                        <!-- /.widget-user-image -->
                                        <h3 class="widget-user-username">{{$governorate->name}}</h3>
                                        <h5 class="widget-user-desc">{{$governorate->capital}}</h5>
                                    </div>
                                    <div class="box-footer no-padding">
                                        <ul class="nav nav-stacked">
                                            <li><a href="#">Cities <span class="pull-right badge bg-blue">{{$governorate->cities}}</span></a></li>
                                            <li><a href="#">Local Units <span class="pull-right badge bg-red">{{$governorate->units}}</span></a></li>
                                            <li><a href="#">Local Division <span class="pull-right badge bg-red">{{$governorate->divisions}}</span></a></li>
                                        </ul>
                                        <a href="{{route('governorates.show',$governorate->id)}}" class="btn btn-info btn-block">view Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        <div class="box-footer">
        </div>
    </div>
@stop
