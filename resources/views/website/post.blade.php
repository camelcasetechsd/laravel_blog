@extends('layouts.web')
@section('content')
<div class="col-lg-8">

    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title or ''}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="{{route('get-user-profile',$post->User->id)}}">{{$post->User->name or ''}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span>{{$post->created_at or ''}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{asset('postspics/'.$post->image)}}" alt="">

    <hr>

    <!-- Post Content -->
    <p class="lead">
        {{$post->content or ''}}
    </p>

    <hr>

    <!-- Blog Comments -->

    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>
        <form role="form" action="{{route('comment-create')}}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="post_id" value="{{$post->id or ''}}">
            <div class="form-group">
                <textarea class="form-control" rows="3"  name="content"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>

    <hr>

    <!-- Posted Comments -->

    <!-- Comment -->
    @foreach($post->Comments as $comment)
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="http://placehold.it/64x64" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">
                <small>{{$comment->created_at}}</small>
            </h4>
            {{$comment->content}}
        </div>
    </div>
    @endforeach


</div>
@endsection

