@extends('layouts.admin')

@section('title')
  <title>Create a comment</title>
@endsection

@section('heading')
  <h1>Create a comment</h1>
@endsection

@section('content')
    {{ HTML::ul($errors->all()) }}

    {{ Form::open(array('url'=>'admin/comments')) }}

      <div class="form-group">
        {{ Form::label('content', 'Content') }}
        {{ Form::text('content', Input::old('content'), array('class' => 'form-control')) }}
      </div>

      <div class="form-group">
        {{ Form::label('userid', 'User ID') }}
        {{ Form::text('userid', Input::old('userid'), array('class' => 'form-control')) }}
      </div>

      <div class="form-group">
        {{ Form::label('topiid', 'Topic ID') }}
        {{ Form::text('topiid', Input::old('topiid'), array('class' => 'form-control')) }}
      </div>

      {{ Form::submit('Create the comment!', array ('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
@endsection
