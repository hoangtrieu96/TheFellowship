@extends('layouts.admin')

@section('title')
  <title>Show {{ $topic->name }}</title>
@endsection

@section('heading')
  <h1>Show {{ $topic->name }}</h1>
@endsection

@section('content')
  <div class="jumbotron text-center">
      <p>ID: {{ $topic->topiid }} </p>
      <p>Name: {{ $topic->name }} </p>
      <p>Content: {{ $topic->content }} </p>
      <p>Forum ID: {{ $topic->forum->foruid }} </p>
      <p>Forum: {{ $topic->forum->name }} </p>
  </div>
@endsection
