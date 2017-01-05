@extends('layouts.web')
@section('content')
    <div class="col-lg-8">
                @foreach($posts as $post)
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <a href="{{route("post-details",$post->id)}}">{{$post->title}}</a>
                            <small>{{$post->created_at or ''}}</small>
                        </h4>
                        {{str_limit($post->content.'..',100)}}
                    </div>
                </div>
                @endforeach

            {{$posts->links()}}

            </div>
@endsection
