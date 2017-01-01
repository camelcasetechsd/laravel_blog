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
<form class="form-horizontal" action="{{route('post-create')}}" method="post"  enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="title" class="col-sm-2 control-label">Title</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="title" placeholder="title" name="title">
        </div>
    </div>
    <div class="form-group">
        <label for="content" class="col-sm-2 control-label">content</label>
        <div class="col-sm-6">
            <textarea class="form-control" rows="10" cols="20" name="content"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="image" class="col-sm-2 control-label">Title</label>
        <div class="col-sm-6">
            <input type="file" class="form-control" id="image" name="image">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Save</button>
        </div>
    </div>
</form>
@endsection