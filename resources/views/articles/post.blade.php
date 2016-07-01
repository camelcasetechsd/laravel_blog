@extends('layouts.app')
@section('content')

<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Post Content Column -->
        <div class="col-lg-8">
            <!-- Blog Post -->
            <!-- Title -->
            <h1>{{$post->title}}</h1>
            <!-- Author -->
            <p class="lead">
                by <a href="javascript:void(0)">{{$post->author->name}}</a>
            </p>
            <hr>
            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> Posted on {{ date('F d, Y', strtotime($post->created_at)) }} <br /></p>
            <hr>
            <!-- Preview Image -->
            <img class="img-responsive" src="{{$post->image}}" alt="">

            <hr>
            <!-- Post Content -->
            {{$post->content}}
            <hr>
            <!-- Blog Comments -->
            <!-- Comments Form -->
            <div class="row">
                <h4>Leave a Comment:</h4>
                {{ Form::open(array("url" => "/comment" , 'files' => true)) }}
                <!--<form action="{{ route('comment.store') }}">-->
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-0">
                        <img src="{{Auth::user()->image}}"><input type="text" name="comment" id="comment" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-0">
                        <input type="hidden" name="postId" id="postId" class="form-control" value="{{$post->id}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-0">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-user"></i> Submit
                        </button>
                    </div>
                </div>
                {{ Form::close() }}        
            </div>
            <hr>
            <!-- Posted Comments -->
<!--            @foreach($post->comments as $comment)
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="{{$comment->commenter->image}}" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$comment->commenter->name}}
                        <small>{{date('F d, Y',strtotime($comment->created_at))}}</small>
                    </h4>
                    {{$comment->comment}}
                </div>
            </div>
        </div>
        @endforeach-->
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->
@endsection
