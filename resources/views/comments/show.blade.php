@extends('layouts.admin')

@section('title')
  <title>Show {{ $comment->commid }}</title>
@endsection

@section('heading')
  <h1>Show {{ $comment->commid }}</h1>
@endsection

@section('content')
  <div class="jumbotron text-center">
      <p>ID: {{ $comment->commid }} </p>
      <p>Name: {{ $comment->content }} </p>
      <p>User: {{ $comment->user->name }} </p>
      <p>Topic: {{ $comment->topic->name }} </p>
  </div>
@endsection
