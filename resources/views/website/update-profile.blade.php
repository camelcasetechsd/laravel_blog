@extends('layouts.web')
@section('content')
<form class="form-horizontal" action="{{route('post-create')}}" method="post">
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
        <textarea class="form-control" rows="10" cols="20"></textarea>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Save</button>
    </div>
  </div>
</form>
@endsection