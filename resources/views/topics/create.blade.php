@extends('layouts.admin')

@section('title')
  <title>Create a Topic</title>
@endsection

@section('heading')
  <h1>Create a Topic</h1>
@endsection

@section('content')
    {{ HTML::ul($errors->all()) }}

    {{ Form::open(array('url'=>'admin/topics')) }}

      <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
      </div>

      <div class="form-group">
        {{ Form::label('content', 'Content') }}
        {{ Form::text('content', Input::old('content'), array('class' => 'form-control')) }}
      </div>

      <div class="form-group">
        {{ Form::label('userid', 'User ID') }}
        {{ Form::text('userid', Input::old('userid'), array('class' => 'form-control')) }}
      </div>

      <div class="form-group">
        {{ Form::label('foruid', 'Forum ID') }}
        {{ Form::text('foruid', Input::old('foruid'), array('class' => 'form-control')) }}
      </div>

      {{ Form::submit('Create the Topic!', array ('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
@endsection
