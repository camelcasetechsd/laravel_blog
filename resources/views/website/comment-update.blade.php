@extends('layouts.web')
@section('content')
@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if(Session::has('message'))
{!!Session::get('message')!!}
@endif
<div class="col-lg-8">
    <div class="well">
        <h4>Leave a Comment:</h4>
        <form role="form" action="{{route('comment-update',$comment->id)}}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="post_id" value="{{$comment->post_id or ''}}">
            <div class="form-group">
                <textarea class="form-control" rows="3"  name="content">{{$comment->content or ''}}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection