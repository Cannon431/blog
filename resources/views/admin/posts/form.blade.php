<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>

<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title', 'Название', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::text('title', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    {!! Form::label('description', 'Описание', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::text('description', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('text') ? 'has-error' : ''}}">
    {!! Form::label('text', 'Текст', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::textarea('text', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'editor']) !!}
        {!! $errors->first('text', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
    {!! Form::label('category_id', 'Категория', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::select('category_id', $categories, 'test', ['class' => 'form-control']) !!}
        {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('author_id') ? 'has-error' : ''}}">
    {!! Form::label('author_id', 'Автор', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::select('author_id', $authors, 'test', ['class' => 'form-control']) !!}
        {!! $errors->first('author_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    {!! Form::label('image', 'Изображение', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::file('image', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Создать', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
