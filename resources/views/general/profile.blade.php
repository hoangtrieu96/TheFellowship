@extends('layouts.user')

@section('title')
  <title>{{$user->name}}'s Profile</title>
@endsection

@section('heading')
  <h1>Details</h1>
@endsection

@section('content')

  <br/> <br/>

  <div class="jumbotron text-center">
      <p>ID: {{ $user->userid }} </p>
      <p>Name: {{ $user->name }} </p>
      <p>Email: {{ $user->email }} </p>
      <p>Role: {{ $user->role }} </p>
      <p>Created date: {{ $user->created_at }} </p>
  </div>
@endsection
