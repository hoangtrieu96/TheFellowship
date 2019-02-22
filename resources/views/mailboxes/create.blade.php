@extends('layouts.user')

@section('title')
  <title>Create a message</title>
@endsection

@section('heading')
  <h1>Create a message</h1>
@endsection

@section('content')
    {{ HTML::ul($errors->all()) }}

    {{ Form::open(array('url'=>'mailboxes')) }}

      @if ($email != '')
        <div class="form-group">
          {{ Form::label('email', 'Recipient email') }}
          {{ Form::text('email', $email, Input::old('email'), array('class' => 'form-control')) }}
        </div>
      @else
        <div class="form-group">
          {{ Form::label('email', 'Recipient email') }}
          {{ Form::text('email', Input::old('email'), array('class' => 'form-control')) }}
        </div>
      @endif

      <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', Input::old('title'), array('class' => 'form-control')) }}
      </div>

      <div class="form-group">
        {{ Form::label('content', 'Content') }}
        {{ Form::text('content', Input::old('content'), array('class' => 'form-control')) }}
      </div>

      {{ Form::submit('Send the message!', array ('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
@endsection
