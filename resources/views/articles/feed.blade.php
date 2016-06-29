@extends('layouts.app')
@section('content')

<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Post Content Column -->
        <div class="col-lg-8">
            POSTs :
            @foreach ($articles as $post)
            <div><h3><a href="/article/{{$post->id}}">{{ $post->title }}</a></h3></div>
            <div>
                by : {{$post->author->name}}
            </div>
            <div>{{ $post->summary }}</div>
            <hr>
            @endforeach
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->
@endsection
