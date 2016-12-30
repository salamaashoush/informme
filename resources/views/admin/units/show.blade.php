@extends('admin.layout')
@section('title',$unit->name)
@section('page-heading',$unit->name)
@section('styles')
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
@stop
@section('content')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$unit->name}}</h3>
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
                        <img src="{{asset($unit->photos()->where('name','=',$unit->name."_logo")->first()['path'])}}" alt="" class="img-responsive">
                    </div>
                    <div class="col-sm-3">
                        <h5>Name: <span class="text-green">{{$unit->name}}</span></h5>
                        <h5>Governorate: <span class="text-green">{{$unit->city['name']}}</span></h5>
                        <h5>City: <span class="text-green">{{$unit->city->governorate['name']}}</span></h5>
                        <h5>Division: <span class="text-green">{{$unit->division['name']}}</span></h5>
                        <hr>
                        <h5>Description:  <span class="text-green">{{$unit->description}}</span></h5>
                        <hr>
                    </div>
                    <div class="col-sm-3">
                        <h5>Area: <span class="text-green">{{$unit->area}}</span></h5>
                        <h5>Population: <span class="text-green">{{$unit->population}}</span></h5>
                        <h5>Population density: <span class="text-green">{{$unit->p_density_rate}} person/km</span></h5>
                        <hr>
                        <h5>Phone Code: <span class="text-green">{{$unit->code}}</span></h5>
                        <h5>Time Zone: <span class="text-green">{{$unit->time_zone}}</span></h5>
                        <h5>Website: <a href="{{$unit->website}}">{{$unit->website}}</a></h5>
                    </div>
                    <div class="col-md-3">
                        <h5>Creation date: <span class="text-green">{{$unit->creation_date}}</span></h5>
                        <h5>Nation Day:<span class="text-green"> {{$unit->national_day}}</span></h5>
                    </div>
                </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="map">
                <!-- The timeline -->
                Map is her
            </div>
            <!-- /.tab-pane -->

            <!-- /.tab-pane -->
            <div class="tab-pane" id="places">
                <!-- The timeline -->
                Places is here
            </div>
            <div class="tab-pane" id="tourism">
                @if($unit->articles->count()>0)
                    @foreach($unit->articles()->where('type','=','tourism_'.$unit->name)->get() as $article)
                        <h3>{{$article->title}}</h3>
                        <p class="lead">{!! $article->body !!}</p>
                    @endforeach
                @endif
            </div>
            <div class="tab-pane" id="photos">
                <!-- The timeline -->
                @if($unit->photos->count()>0)
                    <ul class="items-row row portfolio filtrable clearfix isotope" id="portfolioContainer" style="position: relative; overflow: hidden;">
                        @foreach($unit->photos->chunk(4) as $chunk)
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
                @if($unit->articles->count()>0)
                    @foreach($unit->articles()->where('type','=','about_'.$unit->name)->get() as $article)
                        <h3>{{$article->title}}</h3>
                        <p class="lead">{!! $article->body !!}</p>
                    @endforeach
                @endif

            </div>
            <div class="tab-pane" id="history">
                @if($unit->articles->count()>0)
                    @foreach($unit->articles()->where('type','=','history_'.$unit->name)->get() as $article)
                        <h3>{{$article->title}}</h3>
                        <p class="lead">{!! $article->body !!}</p>
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