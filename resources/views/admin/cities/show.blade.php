@extends('admin.layout')
@section('title','governorates')
@section('page-heading',$city->name)
@section('styles')
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
@stop
@section('content')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$city->divisions}}</h3>
                    <p>Division</p>
                </div>
                <div class="icon">
                    <i class="ion ion-flag"></i>
                </div>
                <a href="{{route('divisions.index')}}" class="small-box-footer">View all Division<i class="fa fa-arrow-circle-right"></i></a>
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
            <li class=""><a href="#divisions" data-toggle="tab" aria-expanded="false">Divisions</a></li>
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
                        <img src="{{asset($city->photos()->where('name','=',$city->name."_logo")->first()['path'])}}" alt="" class="img-responsive">
                    </div>
                    <div class="col-sm-3">
                        <h5>Name: <span class="text-green">{{$city->name}}</span></h5>
                        <h5>Governorate: <span class="text-green"><a href="{{route('governorates.show',$city->governorate['id'])}}">{{$city->governorate['name']}}</span></a></h5>
                        <h5>Description: <span class="text-green">{{$city->description}}</span></h5>
                        <hr>
                        <h5>Number of divisions: <span class="text-green">{{$city->divisions}}</span></h5>
                        <h5>Number of units: <span class="text-green">{{$city->units}}</span></h5>
                        <hr>
                    </div>
                    <div class="col-sm-3">
                        <h5>Area: <span class="text-green">{{$city->area}}</span></h5>
                        <h5>Population: <span class="text-green">{{$city->population}}</span></h5>
                        <h5>Population density: <span class="text-green">{{$city->p_density_rate}} person/km</span></h5>
                        <hr>
                        <h5>Phone Code: <span class="text-green">{{$city->code}}</span></h5>
                        <h5>Time Zone: <span class="text-green">{{$city->time_zone}}</span></h5>
                        <h5>Website: <a href="{{$city->website}}">{{$city->website}}</a></h5>
                    </div>
                    <div class="col-md-3">
                        <h5>Creation date: <span class="text-green">{{$city->creation_date}}</span></h5>
                        <h5>Nation Day:<span class="text-green"> {{$city->national_day}}</span></h5>
                    </div>
                </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="map">
                <!-- The timeline -->
                Map is her
            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane" id="divisions">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">All Division in {{$city->name}}</h3>
                    </div>
                    <div class="box-body">
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
                                                    <a href="{{route('cities.show',$division->id)}}" class="btn btn-info btn-block">view Details</a>
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
                @if($city->articles->count()>0)
                    @foreach($city->articles()->where('type','=','tourism_'.$city->name)->get() as $article)
                        <h3>{{$article->title}}</h3>
                        {!! \GrahamCampbell\Markdown\Facades\Markdown::convertToHtml($article->body) !!}
                    @endforeach
                @endif
            </div>
            <div class="tab-pane" id="photos">
                <!-- The timeline -->
                @if($city->photos->count()>0)
                    <ul class="items-row row portfolio filtrable clearfix isotope" id="portfolioContainer" style="position: relative; overflow: hidden;">
                        @foreach($city->photos->chunk(4) as $chunk)
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
                @if($city->articles->count()>0)
                    @foreach($city->articles()->where('type','=','about_'.$city->name)->get() as $article)
                        <h3>{{$article->title}}</h3>
                        {!! \GrahamCampbell\Markdown\Facades\Markdown::convertToHtml($article->body) !!}
                    @endforeach
                @endif

            </div>
            <div class="tab-pane" id="history">
                @if($city->articles->count()>0)
                    @foreach($city->articles()->where('type','=','history_'.$city->name)->get() as $article)
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