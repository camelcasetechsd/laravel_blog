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
</div>
<div class="col-sm-2">
    <a href="{{route('update-password')}}" class="btn btn-success ">Change password</a>
</div>
@endsection