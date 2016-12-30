@extends('admin.layout')
@section('title','All Centers')
@section('page-heading','All Centers')
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">All Centers</h3>
        </div>
        <div class="box-body">
            @foreach($centers->chunk(4) as $chunk)
                <div class="row">
                    @foreach($chunk as $center)
                        <div class="col-sm-4 col-lg-3">
                            <div class="box box-widget widget-user">
                                <div class="box box-widget widget-user">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-yellow "style=" background: url('{{asset($center->photos()->where('tag','=',"flags")->first()['url'])}}') center center;">
                                        <!-- /.widget-user-image -->
                                        <h3 class="widget-user-username">{{$center->name}}</h3>
                                        <h5 class="widget-user-desc">{{$center->category['name']}}</h5>
                                    </div>
                                    <div class="box-footer no-padding">
                                        <ul class="nav nav-stacked">
                                            <li><a href="#">Phone <span class="pull-right badge bg-blue">{{$center->contact['phone']}}</span></a></li>
                                            <li><a href="#">Local Units <span class="pull-right badge bg-red">{{$center->contact['address_1']}}</span></a></li>
                                            <li><a href="#">Local Division <span class="pull-right badge bg-red">{{$center->location['']}}</span></a></li>
                                        </ul>
                                        <a href="{{route('centers.show',$center->id)}}" class="btn btn-info btn-block">view Details</a>
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
