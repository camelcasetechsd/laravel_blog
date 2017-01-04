@extends('layouts.web')
@section('content')

{!! Form::open(['route' => ['post-create'],'files' => true,'class' => 'form-horizontal'])!!}

@include('posts.form')

{!! Form::close() !!}

@endsection