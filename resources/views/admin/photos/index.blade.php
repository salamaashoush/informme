@extends('admin.layout')
@section('title','Photo Gallery')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
@stop
@section('content')
    <section id="portfolio" class="fullwidth_portfolio">
        <div class="container">
            <div class="row ">
                <div class="col-sm-6 col-sm-offset-3">
                    <h3 class="head-title text-center to_animate animated slideDown" data-animation="slideDown" style="opacity: 0;">Our Best Work</h3>
                    <p class="head-desc text-center to_animate animated fadeInUp" data-animation="fadeInUp" style="opacity: 0;">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                    <hr class="title-border">
                </div>
            </div>
        </div>
        <div id="portfolio_wrapper">
            <div class="text-center filters">
                <ul id="filtrable">
                    <li><a class="selected" data-filter="*" href="#">All</a></li>
                    <li><a data-filter="flags" href="#">Flags</a></li>
                    <li><a data-filter=".logos" href="#" class="">Logos</a></li>
                    <li><a data-filter=".features" href="#" class="">Features</a></li>
                    <li><a data-filter=".tourism" href="#" class="">Tourism</a></li>
                    <li><a data-filter=".history" href="#" class="">History</a></li>
                    <li><a data-filter=".others" href="#" class="">Others</a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            @if(isset($photos)&&$photos->count()>0)
                <ul class="items-row row portfolio filtrable clearfix isotope" id="portfolioContainer" style="position: relative; overflow: hidden;">
                    @foreach($photos->chunk(4) as $chunk)
                        <div class="row">
                            @foreach($chunk as $photo)
                                <div class="item isotope-item video webdesign col-sm-3" >
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
    </section>
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
            //portfolio and horizontal slider animation
            jQuery('.portfolio_links').find('a').css({opacity: 0});
            jQuery('.isotope-item, .horizontal_slider_introimg, .portfolio_item_image').hover(
                    function() {
                        jQuery( this ).find('.portfolio_links a').stop().animate({ opacity: 1}, 50, 'easeOutExpo').parent().find('.p-view').toggleClass('moveFromLeft').end().find('.p-link').toggleClass('moveFromRight');
                    }, function() {
                        jQuery( this ).find('.portfolio_links a').stop().animate({ opacity: 0}, 50, 'easeOutExpo').parent().find('.p-view').toggleClass('moveFromLeft').end().find('.p-link').toggleClass('moveFromRight');
                    }
            );
        });
    </script>

@stop