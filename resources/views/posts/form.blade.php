<div class="form-group">
    {!! Form::label('title', 'Title',['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::text('title',null,['class' => 'form-control', 'id' => 'title', 'placeholder' => 'title']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('content', 'Content',['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::textarea('content',null,['class' => 'form-control','rows' => '10', 'cols' => '20' ]) !!}
    </div>
</div>
@if(!empty($post) && $post->image)
<div class="form-group">
    <label for="image" class="col-sm-2 control-label"></label>
    <div class="col-sm-6">
        <img class="img-responsive" src="{{asset('postspics/'.$post->image)}}" alt="">
    </div>
</div>
@endif
<div class="form-group">
    {!! Form::label('image', 'Image',['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::file('image',['accept' => "image/*",'class' => 'form-control','id' => 'image']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit('Save',['class' => 'btn btn-default']) !!}
    </div>
</div>

