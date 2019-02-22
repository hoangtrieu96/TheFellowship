@extends('layouts.user')

@section('title')
  <title>Create a Topic</title>
@endsection

@section('heading')
  <h1>Create a Topic</h1>
@endsection

@section('content')
    {{ HTML::ul($errors->all()) }}

    {{ Form::open(array('url'=>'topic_store')) }}

      <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
      </div>

      <div class="form-group">
        {{ Form::label('content', 'Content') }}
        {{ Form::text('content', Input::old('content'), array('class' => 'form-control')) }}
      </div>

      {{ Form::hidden('userid', Auth::user()->userid, array('id' => 'userid')) }}

      {{ Form::hidden('foruid', $foruid, array('id' => 'foruid')) }}

      {{ Form::submit('Create the Topic!', array ('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
@endsection
