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
<form class="form-horizontal" action="{{route('update-password')}}" method="post">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="title" value="{{$email or ''}}" name="email">
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">New Password</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="" placeholder="new password" name="password">
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">Confirm Password</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="" placeholder="confirm password" name="password_confirmation">
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">Old Password</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="title" placeholder="old password" name="old_password">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Save</button>
        </div>
    </div>
</form>
@endsection