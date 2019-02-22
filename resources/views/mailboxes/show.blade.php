@extends('layouts.user')

@section('title')
  <title>Show {{ $message->title }}</title>
@endsection

@section('heading')
  <h1>Show {{ $message->title }}</h1>
@endsection

@section('content')
  <div class="card">
      <div class="card-header bg-secondary text-light">From by <b>{{ucfirst($message->user->name)}}</b> at <i>{{$message->created_at}}</i></div>

        <div class="card-footer">
          <span>Title: </span>
          <i>{{$message->title}}</i>
        </div>

      <div class="card-body">
        <div class="text-left">
          {{$message->content}}
        </div>
        <div class="text-right">
          <a class="btn btn-primary" href="{{ URL::to('mailboxes/reply/'.$message->userid) }}">Reply</a>
        </div>
      </div>
  </div>
@endsection
