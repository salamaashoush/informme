@extends('admin.layout')
@section('title','Articles')
@section('page-heading',$article->title)
@section('content')
    {!! \GrahamCampbell\Markdown\Facades\Markdown::convertToHtml($article->body) !!}
    <hr>
    <p class="text-gray"><i class="fa fa-comments"></i>{{$article->reviews->count()}}</p>
    @if($article->reviews()->count())
        @foreach($article->reviews as $review)
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object img-circle" alt="media image" src="{{asset($review->user->photos()->where('name','=','profile')->first())}}" style="width: 64px; height: 64px;">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$article->user['name']}}</h4>
                    {{$review->body}}
                </div>
            </div>
        @endforeach
    @endif
@stop