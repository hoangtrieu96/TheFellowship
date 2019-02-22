@extends('layouts.admin')

@section('title')
  <title>Create a Category</title>
@endsection

@section('heading')
  <h1>Create a Category</h1>
@endsection

@section('content')
    {{ HTML::ul($errors->all()) }}

    {{ Form::open(array('url'=>'admin/categories')) }}

      <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
      </div>

      {{ Form::submit('Create the Category!', array ('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
@endsection
