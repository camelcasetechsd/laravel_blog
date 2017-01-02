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
        {!! Form::model($comment, ['route' => [$route,$comment->id]])!!}
        
        {!! FORM::hidden('post_id',null,['value' => $comment->post_id])!!}
        <div class="form-group">
            {!! Form::textarea('content',null,['class' => 'form-control','rows' => '3' ]) !!}

        </div>

        {!! Form::submit('Save',['class' => 'btn btn-primary']) !!}

    </div>
    {!! Form::close() !!}
</div>
</div>
@endsection