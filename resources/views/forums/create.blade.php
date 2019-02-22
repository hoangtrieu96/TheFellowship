@extends('layouts.admin')

@section('title')
  <title>Create a Forum</title>
@endsection

@section('heading')
  <h1>Create a Forum</h1>
@endsection

@section('content')
    {{ HTML::ul($errors->all()) }}

    {{ Form::open(array('url'=>'admin/forums')) }}

      <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
      </div>

      <div class="form-group">
        {{ Form::label('cateid', 'Category ID') }}
        {{ Form::text('cateid', Input::old('cateid'), array('class' => 'form-control')) }}
      </div>

      {{ Form::submit('Create the Forum!', array ('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
@endsection
