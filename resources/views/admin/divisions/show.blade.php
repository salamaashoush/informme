@extends('admin.layout')
@section('title',$division->name)
@section('page-heading',$division->name)
@section('styles')
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
@stop
@section('content')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$division->units}}</h3>
                    <p>Units</p>
                </div>
                <div class="icon">
                    <i class="ion ion-flag"></i>
                </div>
                <a href="{{route('units.index')}}" class="small-box-footer">View all Units<i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>53<sup style="font-size: 20px">%</sup></h3>

                    <p>Bounce Rate</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">View all <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>44</h3>

                    <p>User Registrations</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">View all <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>65</h3>

                    <p>Unique Visitors</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">View all <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#details" data-toggle="tab" aria-expanded="true">Details</a></li>
            <li class=""><a href="#map" data-toggle="tab" aria-expanded="false">Map</a></li>
            <li class=""><a href="#units" data-toggle="tab" aria-expanded="false">Units</a></li>
            <li class=""><a href="#places" data-toggle="tab" aria-expanded="false">Places</a></li>
            <li class=""><a href="#tourism" data-toggle="tab" aria-expanded="false">Tourism</a></li>
            <li class=""><a href="#photos" data-toggle="tab" aria-expanded="false">Photos</a></li>
            <li class=""><a href="#about" data-toggle="tab" aria-expanded="false">About</a></li>
            <li class=""><a href="#history" data-toggle="tab" aria-expanded="false">History</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="details">
                <div class="row">
                    <div class="col-sm-3">
                        <img src="{{asset($division->photos()->where('name','=',$division->name."_logo")->first()['path'])}}" alt="" class="img-responsive">
                    </div>
                    <div class="col-sm-3">
                        <h5>Name: <span class="text-green">{{$division->name}}</span></h5>
                        <h5>Governorate: <span class="text-green">{{$division->city['name']}}</span></h5>
                        <h5>City: <span class="text-green">{{$division->city->governorate['name']}}</span></h5>
                        <hr>
                        <h5>Description:  <span class="text-green">{{$division->description}}</span></h5>
                        <h5>Is district: <span class="text-green">{{$division->is_district?'Yes':'No'}}</span></h5>
                        <h5>Number of units: <span class="text-green">{{$division->units}}</span></h5>
                        <hr>
                    </div>
                    <div class="col-sm-3">
                        <h5>Area: <span class="text-green">{{$division->area}}</span></h5>
                        <h5>Population: <span class="text-green">{{$division->population}}</span></h5>
                        <h5>Population density: <span class="text-green">{{$division->p_density_rate}} person/km</span></h5>
                        <hr>
                        <h5>Phone Code: <span class="text-green">{{$division->code}}</span></h5>
                        <h5>Time Zone: <span class="text-green">{{$division->time_zone}}</span></h5>
                        <h5>Website: <a href="{{$division->website}}">{{$division->website}}</a></h5>
                    </div>
                    <div class="col-md-3">
                        <h5>Creation date: <span class="text-green">{{$division->creation_date}}</span></h5>
                        <h5>Nation Day:<span class="text-green"> {{$division->national_day}}</span></h5>
                    </div>
                </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="map">
                <!-- The timeline -->
                Map is her
            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane" id="units">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">All units in {{$division->name}}</h3>
                    </div>
                    <div class="box-body">
                        @foreach($division->units()->get()->chunk(4) as $chunk)
                            <div class="row">
                                @foreach($chunk as $unit)
                                    <div class="col-sm-4 col-lg-3">
                                        <div class="box box-widget widget-user">
                                            <div class="box box-widget widget-user">
                                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                                <div class="widget-user-header bg-yellow "style=" background: url('{{asset($city->photos()->where('name','=',$governorate->name."_flag")->first()['path'])}}') center center;">
                                                    <!-- /.widget-user-image -->
                                                    <h3 class="widget-user-username">{{$unit->name}}</h3>
                                                    <h5 class="widget-user-desc">{{$unit->division['name']}}</h5>
                                                </div>
                                                <div class="box-footer no-padding">
                                                    <ul class="nav nav-stacked">
                                                        <li><a href="#">Governorate <span class="pull-right badge bg-blue">{{$unit->city->governorate['name']}}</span></a></li>
                                                        <li><a href="#">City <span class="pull-right badge bg-red">{{$unit->city['name']}}</span></a></li>
                                                        <li><a href="#">area <span class="pull-right badge bg-red">{{$unit->area}}</span></a></li>
                                                    </ul>
                                                    <a href="{{route('units.show',$unit->id)}}" class="btn btn-info btn-block">view Details</a>
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
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="places">
                <!-- The timeline -->
                Places is here
            </div>
            <div class="tab-pane" id="tourism">
                @if($division->articles->count()>0)
                    @foreach($division->articles()->where('type','=','tourism_'.$division->name)->get() as $article)
                        <h3>{{$article->title}}</h3>
                        {!! \GrahamCampbell\Markdown\Facades\Markdown::convertToHtml($article->body) !!}
                    @endforeach
                @endif
            </div>
            <div class="tab-pane" id="photos">
                <!-- The timeline -->
                @if($division->photos->count()>0)
                    <ul class="items-row row portfolio filtrable clearfix isotope" id="portfolioContainer" style="position: relative; overflow: hidden;">
                        @foreach($division->photos->chunk(4) as $chunk)
                            <div class="row">
                                @foreach($chunk as $photo)
                                    <div class="item isotope-item video col-sm-3" >
                                        <div class="portfolio_item_image portfolio-content">
                                            <img alt="" src="{{asset($photo->path)}}">
                                            <div class="overlay text-center">
                                                <a class="folio-detail prettyPhoto " title="" data-gal="prettyPhoto[gal]" href="{{asset($photo->path)}}"><i class="fa fa-plus"></i></a>
                                                <h2>{{$photo->name}}</h2>
                                                <p>{{$photo->desc}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="tab-pane" id="about">
                @if($division->articles->count()>0)
                    @foreach($division->articles()->where('type','=','about_'.$division->name)->get() as $article)
                        <h3>{{$article->title}}</h3>
                        {!! \GrahamCampbell\Markdown\Facades\Markdown::convertToHtml($article->body) !!}
                    @endforeach
                @endif

            </div>
            <div class="tab-pane" id="history">
                @if($division->articles->count()>0)
                    @foreach($division->articles()->where('type','=','history_'.$division->name)->get() as $article)
                        <h3>{{$article->title}}</h3>
                        {!! \GrahamCampbell\Markdown\Facades\Markdown::convertToHtml($article->body) !!}
                    @endforeach
                @endif
            </div>
        </div>
        <!-- /.tab-content -->
    </div>
@stop
@section('scripts')
    <script src="{{asset('plugins/jquery.isotope.min.js')}}"></script>
    <script src="{{asset('plugins/jquery.prettyPhoto.js')}}"></script>
    <script>
        $(function () {
            //prettyPhoto
            if (jQuery().prettyPhoto) {
                jQuery("a[data-gal^='prettyPhoto']").prettyPhoto({
                    hook: 'data-gal',
                    theme: 'facebook' /* light_rounded / dark_rounded / light_square / dark_square / facebook / pp_default*/
                });
            }
        });
    </script>

@stop