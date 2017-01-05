@extends('layouts.web')
@section('content')

{!! Form::model($post, ['route' => ['post-update',$post->id],'method' => 'patch','files' => true,'class' => 'form-horizontal'])!!}

@include('posts.form')

{!! Form::close() !!}

@endsection