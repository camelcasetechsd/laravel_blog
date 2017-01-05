@extends('layouts.web')
@section('content')
<div class="col-sm-8">
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Users</div>
  <!-- Table -->
  <table class="table table-hover">
      @foreach($users as $user)
      <tr>
          <td><a href="{{route('get-user-profile',$user->id)}}">{{$user->name}}</a></td>
      </tr>
      @endforeach
  </table>
</div>
</div>
@endsection