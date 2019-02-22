@extends('layouts.admin')

@section('title')
  <title>Show {{ $user->name }}</title>
@endsection

@section('heading')
  <h1>Show {{ $user->name }}</h1>
@endsection

@section('content')
  <div class="jumbotron text-center">
      <p>ID: {{ $user->userid }} </p>
      <p>Name: {{ $user->name }} </p>
      <p>Email: {{ $user->email }} </p>
      <p>Role: {{ $user->role }} </p>
      <p>Created date: {{ $user->created_at }} </p>
  </div>
@endsection
