@extends('layouts.user')

@section('title')
  <title>{{ucfirst($data['topic']->name)}}</title>
@endsection

@section('heading')
  <h1>{{ucfirst($data['topic']->name)}}</h1>
@endsection

@section('content')

  <div class="p-2 m-2 jumbotron">
    <div class="card">
        <div class="card-header bg-dark text-light">Posted by <b>{{ucfirst($data['topic']->user->name)}}</b> at <i>{{$data['topic']->created_at}}</i></div>

        <div class="card-body">
            {{$data['topic']->content}}
        </div>
    </div>
    <div class="text-right">
      <br/>
      <a class="btn btn-primary" href="{{ URL::to($data['topic']->topiid.'/comments/create') }}">Make a Comment</a>
    </div>
  </div>

  <br/>
  <h3>Comments</h3>
  @foreach ($data['comments'] as $comment)
    <div class="card">
        <div class="card-header bg-secondary text-light">Posted by <b>{{ucfirst($comment->user->name)}}</b> at <i>{{$comment->created_at}}</i></div>

        @if ($comment->quote)
          <div class="card-footer">
            <span>Quoted: </span>
            <i>{{$comment->quote}}</i>
          </div>
        @endif

        <div class="card-body">
          <div class="text-left">
            {{$comment->content}}
          </div>
          @if ($comment->user->userid == Auth::user()->userid)
            <div class="text-right">
              <a href="{{ URL::to($data['topic']->topiid.'/comments/create/quote/'.$comment->content) }}">Quote</a>
            </div>
            <br/>
            <div class="text-right">
              <a class="btn btn-warning" href="{{ URL::to($data['topic']->topiid.'/comments/edit/'.$comment->commid) }}">Edit</a>
              {{ Form::open(array('url' => $data['topic']->topiid.'/comments/delete/'.$comment->commid, 'class' => 'pull-right')) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
              {{ Form::close() }}
            </div>
          @else
            <div class="text-right">
              <a href="{{ URL::to($data['topic']->topiid.'/comments/create/quote/'.$comment->content) }}">Quote</a>
            </div>
          @endif
        </div>

    </div>
    <br/>
  @endforeach
  {{$data['comments']->links('vendor.pagination.bootstrap-4')}}
@endsection
