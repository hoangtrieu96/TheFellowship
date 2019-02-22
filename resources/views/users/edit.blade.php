@extends('layouts.admin')

@section('title')
  <title>Edit {{ $user->name }}</title>
@endsection

@section('heading')
  <h1>Edit {{ $user->name }}</h1>
@endsection

@section('content')
    {{ HTML::ul($errors->all()) }}

    {{ Form::model($user, array('route'=> array('users.update', $user->userid), 'method' => 'PUT')) }}

      <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
      </div>

      <div class="form-group">
        {{ Form::label('role', 'Role') }}
        {{ Form::text('role', Input::old('role'), array('class' => 'form-control')) }}
      </div>

      {{ Form::submit('Update the user!', array ('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
@endsection
