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
            {{$post->body}}
            <hr>
            <a href="/pdf/{{$post->id}}"><button class="btn btn-primary">Download Article</button></a>
            <!-- Blog Comments -->
            <!-- Comments Form -->
            <div class="row">
                <h4>Leave a Comment:</h4>
                {{ Form::open(array("url" => "/comment" , 'files' => true)) }}

                <meta name="csrf-token" content="{{ csrf_token() }}" />
                <!--<form action="{{ route('comment.store') }}">-->
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-0">
                        <!--<img src="{{Auth::user()->image}}">-->
                        <textarea name="comment" id="active-comment" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-0">
                        <input type="hidden" name="postId" id="postId" class="form-control" value="{{$post->id}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-0">
                        <button id="submit-comment"type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-user"></i> Submit
                        </button>
                    </div>
                </div>
                {{ Form::close() }}        
            </div>
            <hr>
            <!-- Posted Comments -->
            <span id='comments-hock'></span>
            @foreach($post->comments as $comment)
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="{{$comment->commenter->image}}" alt="">
                </a>       
                @can('update_comment',$comment)
                <a href="javascript:void(0)" id="comment-editor-{{$comment->id}}"><span class="glyphicon glyphicon-pencil pull-right"></span></a>
                @endcan
                <div class="media-body-{{$comment->id}}">
                    <h4 class="media-heading">{{$comment->commenter->name}}
                        <small>{{date('F d, Y',strtotime($comment->created_at))}}</small>
                    </h4>
                    <p id="comment-{{$comment->id}}" class="comment-string">
                    {{$comment->comment}}
                    </p>
                </div>
            </div>
            <hr>
            @endforeach
        </div>
        <!-- /.row -->
    </div>
</div>
<!-- /.container -->
@endsection