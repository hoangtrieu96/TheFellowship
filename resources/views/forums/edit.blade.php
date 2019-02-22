@extends('layouts.admin')

@section('title')
  <title>Edit {{ $forum->name }}</title>
@endsection

@section('heading')
  <h1>Edit {{ $forum->name }}</h1>
@endsection

@section('content')
    {{ HTML::ul($errors->all()) }}

    {{ Form::model($forum, array('route'=> array('forums.update', $forum->foruid), 'method' => 'PUT')) }}

      <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
      </div>

      <div class="form-group">
        {{ Form::label('cateid', 'Category ID') }}
        {{ Form::text('cateid', Input::old('cateid'), array('class' => 'form-control')) }}
      </div>

      {{ Form::submit('Update the forum!', array ('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
@endsection
