@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-2">
        <img src="/images/avatars/{{$user->avatar}}" width="150px" height="150px">
    </div>
    <div class="col-lg-6">
        <h2>{{$user->name}}'s Profile</h2>
        <form enctype="multipart/form-data" method="POST" action="">
            {{ csrf_field()}}
            <input type="file"  class="form-control" name="image">
            @if ($errors->has('image'))
            <span class="alert-danger help-block">
                <strong>{{ $errors->first('image') }}</strong>
            </span>
            @endif
            <input type="submit" class="btn btn-primary" value="upload">
        </form>
    </div>
</div>
@endsection