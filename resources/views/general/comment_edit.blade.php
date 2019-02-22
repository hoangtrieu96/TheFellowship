@extends('layouts.user')

@section('title')
  <title>Edit comment</title>
@endsection

@section('heading')
  <h1>Edit comment</h1>
@endsection

@section('content')
    {{ HTML::ul($errors->all()) }}

    {{ Form::model($data['comment'], array('url' => $data['topic']->topiid.'/comments/update/'.$data['comment']->commid, 'method' => 'PUT')) }}

    <div class="form-group">
      {{ Form::label('content', 'Content') }}
      {{ Form::text('content', Input::old('content'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Update the comment!', array ('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
@endsection
