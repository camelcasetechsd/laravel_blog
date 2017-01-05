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
            <tr>
                <th>Title</th>
                <th>Image</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            @foreach($user->Posts as $post)
            <tr>
                <td>
                    <a href="{{route("post-details",$post->id)}}">{{$post->title}}</a>
                </td>
                <td>
                    <img class="media-object thumbnail"width="100px" height="100px" src="{{asset('postspics/'.$post->image)}}" alt="">
                </td>
                <td>
                    {{$post->created_at or ''}}
                </td>
                <td>
                    <a href="{{route("post-update",$post->id)}}">Edit</a>
                </td>
            @endforeach


        </table>
    </div>
</div>
<div class="col-sm-2">
    <a href="{{route('update-password')}}" class="btn btn-success ">Change Login Credentials</a>
</div>
@endsection