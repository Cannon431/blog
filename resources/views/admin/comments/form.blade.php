<div class="form-group {{ $errors->has('author') ? 'has-error' : ''}}">
    {!! Form::label('author', 'Автор', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('author', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('author', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    {!! Form::label('email', 'E-mail', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::email('email', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('text') ? 'has-error' : ''}}">
    {!! Form::label('text', 'Текст', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('text', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('text', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('post_id') ? 'has-error' : ''}}">
    {!! Form::label('post_id', 'Пост', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('post_id', $posts, $default, ['class' => 'form-control']) !!}
        {!! $errors->first('post_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
