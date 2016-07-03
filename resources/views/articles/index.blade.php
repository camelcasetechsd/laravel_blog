@extends('layouts.app')
@section('content')

<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Post Content Column -->
        {{$articles->links()}}
        <div class="col-lg-8">
            POSTs :
            @foreach ($articles as $post)
            <div><h3><a href="/article/{{$post->id}}">{{ $post->title }}</a></h3></div>
            <div>
                by : {{$post->author->name}}
                &nbsp;&nbsp;&nbsp;&nbsp;
                @can('update_article', $post)
                <a href="{{ route('article.edit', [$post->id]) }}"><span class="glyphicon glyphicon-pencil"></span></a>
                @endcan
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
