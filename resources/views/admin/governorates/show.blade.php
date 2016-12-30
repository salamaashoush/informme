@extends('admin.layout')
@section('title','governorates')
@section('page-heading',$governorate->name)
@section('styles')
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
@stop
@section('content')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$governorate->cities()->get()->count()}}</h3>
                    <p>Cities</p>
                </div>
                <div class="icon">
                    <i class="ion ion-flag"></i>
                </div>
                <a href="{{route('cities.index')}}" class="small-box-footer">View all cities<i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{$governorate->divisions()->get()->count()}}</h3>
                    <p>Divisions</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{route('divisions.index')}}" class="small-box-footer">View all <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{$governorate->units()->get()->count()}}</h3>
                    <p>Units</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{route('units.index')}}" class="small-box-footer">View all <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{$governorate->locations()->get()->count()}}</h3>
                    <p>Locations</p>
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
            <li class=""><a href="#cities" data-toggle="tab" aria-expanded="false">Cities</a></li>
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
                        <img src="{{asset($governorate->photos()->where('tag','=','logos')->first()['url'])}}" alt="" class="img-responsive">
                    </div>
                    <div class="col-sm-3">
                        <h5>Name: <span class="text-green">{{$governorate->name}}</span></h5>
                        <h5>Capital: <span class="text-green">{{$governorate->capital}}</span></h5>
                        <h5>Description: <span class="text-green">{{$governorate->description}}</span></h5>
                        <hr>
                        <h5>Number of cities: <span class="text-green">{{$governorate->citiis}}</span></h5>
                        <h5>Number of divisions: <span class="text-green">{{$governorate->divisions}}</span></h5>
                        <h5>Number of units: <span class="text-green">{{$governorate->units}}</span></h5>
                        <hr>
                    </div>
                    <div class="col-sm-3">
                        <h5>Area: <span class="text-green">{{$governorate->area}}</span></h5>
                        <h5>Population: <span class="text-green">{{$governorate->population}}</span></h5>
                        <h5>Population density: <span class="text-green">{{$governorate->p_density_rate}} person/km</span></h5>
                        <hr>
                        <h5>Phone Code: <span class="text-green">{{$governorate->code}}</span></h5>
                        <h5>Time Zone: <span class="text-green">{{$governorate->time_zone}}</span></h5>
                        <h5>Website: <a href="{{$governorate->website}}">{{$governorate->website}}</a></h5>
                    </div>
                    <div class="col-md-3">
                        <h5>Creation date: <span class="text-green">{{$governorate->creation_date}}</span></h5>
                        <h5>Nation Day:<span class="text-green"> {{$governorate->national_day}}</span></h5>
                    </div>
                </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="map">
                <!-- The timeline -->
               Map is her
            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane" id="cities">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">All Cities in {{$governorate->name}}</h3>
                    </div>
                    <div class="box-body">
                        @foreach($governorate->cities()->get()->chunk(4) as $chunk)
                            <div class="row">
                                @foreach($chunk as $city)
                                    <div class="col-sm-4 col-lg-3">
                                        <div class="box box-widget widget-user">
                                            <div class="box box-widget widget-user">
                                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                                <div class="widget-user-header bg-yellow "style=" background: url('{{asset($city->photos()->where('name','=',$city->name."_flag")->first()['path'])}}') center center;">
                                                    <!-- /.widget-user-image -->
                                                    <h3 class="widget-user-username">{{$city->name}}</h3>
                                                    <h5 class="widget-user-desc">{{$city->governorate['name']}}</h5>
                                                </div>
                                                <div class="box-footer no-padding">
                                                    <ul class="nav nav-stacked">
                                                        <li><a href="#">Units <span class="pull-right badge bg-red">{{$city->units}}</span></a></li>
                                                        <li><a href="#">Divisions <span class="pull-right badge bg-red">{{$city->divisions}}</span></a></li>
                                                        <li><a href="#">Population <span class="pull-right badge bg-blue">{{$city->population}}</span></a></li>
                                                    </ul>
                                                    <a href="{{route('cities.show',$city->id)}}" class="btn btn-info btn-block">view Details</a>
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
                @if($governorate->articles->count()>0)
                    @foreach($governorate->articles()->where('type','=','tourism_'.$governorate->name)->get() as $article)
                        <h3>{{$article->title}}</h3>
                        {!! \GrahamCampbell\Markdown\Facades\Markdown::convertToHtml($article->body) !!}
                    @endforeach
                @endif
            </div>
            <div class="tab-pane" id="photos">
                <!-- The timeline -->
                @if($governorate->photos->count()>0)
                    <ul class="items-row row portfolio filtrable clearfix isotope" id="portfolioContainer" style="position: relative; overflow: hidden;">
                        @foreach($governorate->photos->chunk(4) as $chunk)
                            <div class="row">
                                @foreach($chunk as $photo)
                                    <div class="item isotope-item video col-sm-3" >
                                        <div class="portfolio_item_image portfolio-content">
                                            <img alt="" src="{{asset($photo->url)}}">
                                            <div class="overlay text-center">
                                                <a class="folio-detail prettyPhoto " title="" data-gal="prettyPhoto[gal]" href="{{asset($photo->url)}}"><i class="fa fa-plus"></i></a>
                                                <h2>{{$photo->name}}</h2>
                                                <p>{{$photo->tag}}</p>
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
                @if($governorate->articles->count()>0)
                    @foreach($governorate->articles()->where('type','=','about_'.$governorate->name)->get() as $article)
                        <h3>{{$article->title}}</h3>
                        {!! \GrahamCampbell\Markdown\Facades\Markdown::convertToHtml($article->body) !!}
                    @endforeach
                @endif

            </div>
            <div class="tab-pane" id="history">
                @if($governorate->articles->count()>0)
                    @foreach($governorate->articles()->where('type','=','history_'.$governorate->name)->get() as $article)
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