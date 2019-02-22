@extends('layouts.admin')

@section('title')
  <title>Edit {{ $comment->commid }}</title>
@endsection

@section('heading')
  <h1>Edit {{ $comment->commid }}</h1>
@endsection

@section('content')
    {{ HTML::ul($errors->all()) }}

    {{ Form::model($comment, array('route'=> array('comments.update', $comment->commid), 'method' => 'PUT')) }}

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

      {{ Form::submit('Update the comment!', array ('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
@endsection
