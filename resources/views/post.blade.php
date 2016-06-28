@extends('layouts.layout')
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
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form role="form">
                    <div class="form-group">
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>
            <!-- Posted Comments -->
            @foreach($post->comments as $comment)
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$comment->commenter->name}}
                        <small>{{date('F d, Y',strtotime($comment->created_at))}}</small>
                    </h4>
                    {{$comment->comment}}
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->
@endsection
