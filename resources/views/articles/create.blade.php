
@extends('layouts.app')
@section('content')
<style>
    input ,textarea, .control-label{
        margin-top: 10px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">New Article</div>
                <div class="panel-body">

                    @if(isset($article))
                    {{ Form::model($article, ["method"=>"PATCH","route" => ["article.update",$article->id],'files' => true ]) }}
                    @else
                    {{ Form::open(["method"=>"POST","route" => "article.store",'files' => true]) }}
                    @endif

                    {{ csrf_field()}}

                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="title" class="col-md-4 control-label">{!! Form::label('Article Title') !!}</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control" name="title" value="{{ old('title',isset($article)?$article->title:'') }}">
                            <!--{{Form::text('title','', array('class'=>'form-control'))}}-->

                            @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('summary') ? ' has-error' : '' }}">
                        <label for="summary" class="col-md-4 control-label">{!! Form::label('Article Summary') !!}</label>

                        <div class="col-md-6">
                            <input id="summary" type="text" class="form-control" name="summary" value="{{ old('summary',isset($article)?$article->summary:'') }}">

                            @if ($errors->has('summary'))
                            <span class="help-block">
                                <strong>{{ $errors->first('summary') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                        <label for="body" class="col-md-4 control-label">{!! Form::label('Article Body') !!}</label>

                        <div class="col-md-6">
                            <textarea id="body" class="form-control" name="body">
                                {{ old('body',isset($article)?$article->body:'') }}
                            </textarea>

                            @if ($errors->has('body'))
                            <span class="help-block">
                                <strong>{{ $errors->first('body') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                        <label for="image" class="col-md-4 control-label">{!! Form::label('Article Image') !!}</label>

                        <div class="col-md-6">
                            {!! Form::file('image', null) !!}

                            @if ($errors->has('image'))
                            <span class="help-block">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-user"></i> Submit
                            </button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection