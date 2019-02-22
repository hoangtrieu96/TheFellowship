@extends('layouts.admin')

@section('title')
  <title>Show {{ $forum->name }}</title>
@endsection

@section('heading')
  <h1>Show {{ $forum->name }}</h1>
@endsection

@section('content')
  <div class="jumbotron text-center">
      <p>ID: {{ $forum->foruid }} </p>
      <p>Name: {{ $forum->name }} </p>
      <p>Category ID: {{ $forum->category->cateid }} </p>
      <p>Category: {{ $forum->category->name }} </p>
  </div>
@endsection
