@extends('layouts.web')
@section('content')
<div class="col-sm-8">
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Personal information</div>
        <!-- Table -->
        <table class="table table-hover">
            <tr>
                <td>Name</td>
                <td>{{$user->name}}</td>
            </tr>
            <tr>
                <td>email</td>
                <td>{{$user->email}}</td>
            </tr>
        </table>
    </div>
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Posts</div>
        <!-- Table -->
        <table class="table table-hover">
            @foreach($user->Posts as $post)
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


        </table>
    </div>
</div>
@endsection