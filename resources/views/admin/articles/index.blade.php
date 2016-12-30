@extends('admin.layout')
@section('title','Blog')
@section('page-heading','Our Blog')
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">All Posts</h3>
        </div>
        <div class="box-body">
            @if(isset($articles)&&$articles->count()>0)
                @foreach($articles as $article)
                    @if($article->type=='post')
                        <div class="media">
                            <a class="pull-left" href="{{route('articles.show',$article->id)}}">
                                <img class="media-object" alt="media image" src="{{asset($article->photos()->where('tag','=','article')->first()['url'])}}" style="width: 64px; height: 64px;">
                            </a>
                            <div class="media-body">
                                <a href="{{route('articles.show',$article->id)}}"><h4 class="media-heading">{{$article->title}}</h4></a>
                                <hr>
                                <p class="text-gray">{{$article->reviews->count()}} Comments</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>

        <div class="box-footer">
        </div>
    </div>
@stop
