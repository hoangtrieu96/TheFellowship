@extends('layouts.admin')

@section('title')
  <title>Edit {{ $category->name }}</title>
@endsection

@section('heading')
  <h1>Edit {{ $category->name }}</h1>
@endsection

@section('content')
    {{ HTML::ul($errors->all()) }}

    {{ Form::model($category, array('route'=> array('categories.update', $category->cateid), 'method' => 'PUT')) }}

      <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
      </div>

      {{ Form::submit('Update the Category!', array ('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
@endsection
