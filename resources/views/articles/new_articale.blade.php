
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="content">
        {{ Form::open(array("url" => "/article" , 'files' => true)) }}

        {!! Form::label('Name') !!}
        {!! Form::select('username', $users, null, array('required', 'class'=>'form-control')) !!}

        <br>
        <br>

        {!! Form::label('Article Title') !!}
        {!! Form::text('title', null, array('required', 'class'=>'form-control','placeholder'=>'Article Title'))!!}
        <br>
        <br>

        {!! Form::label('Article Summary') !!}
        {!! Form::text('summary', null, array('required', 'class'=>'form-control','placeholder'=>'Article Summary'))!!}

        <br>  
        <br>

        {!! Form::label('Article Content') !!}
        {!! Form::textarea('content', null,array('required','class'=>'form-control','placeholder'=>'Article Content'))!!}

        <br>
        <br>
        
        {!! Form::label('Article Image') !!}
        {!! Form::file('image', null) !!}

        <br>
        <br>

        {!! Form::submit('Submit', null,array('class'=>'btn btn-warning','value'=>'Submit'))!!}

        {{ Form::close() }}
        @endsection