@extends('layouts.admin')

@section('title')
  <title>Show {{ $category->name }}</title>
@endsection

@section('heading')
  <h1>Show {{ $category->name }}</h1>
@endsection

@section('content')
  <div class="jumbotron text-center">
      <p>ID: {{ $category->cateid }} </p>
      <p>Name: {{ $category->name }} </p>
  </div>
@endsection
