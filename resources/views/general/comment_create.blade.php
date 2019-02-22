@extends('layouts.user')

@section('title')
  <title>{{ucfirst($data['topic']->name)}}</title>
@endsection

@section('heading')
  <h1>{{ucfirst($data['topic']->name)}}</h1>
@endsection

@section('content')

  <div class="p-3 m-3 jumbotron">
    <div class="card">
        <div class="card-header bg-dark text-light">Posted by <b>{{ucfirst($data['topic']->user->name)}}</b> at <i>{{$data['topic']->created_at}}</i></div>

        <div class="card-body">
            {{$data['topic']->content}}
        </div>
        <br/>
    </div>
  </div>

  <div class="p-3 m-3 jumbotron">
    {{ HTML::ul($errors->all()) }}

    {{ Form::open(array('url'=>'comments/store')) }}

      <div class="form-group">
        {{ Form::label('content', 'Content') }}
        {{ Form::textarea('content', Input::old('content'), array('class' => 'form-control')) }}
      </div>

      {{ Form::hidden('userid', Auth::user()->userid, array('id' => 'userid')) }}

      {{ Form::hidden('topiid', $data['topic']->topiid, array('id' => 'topiid')) }}

      {{ Form::submit('Create the comment!', array ('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
  </div>

  <br/>
  <h3>Comments</h3>
  @foreach ($data['comments'] as $comment)
    <div class="card">
        <div class="card-header bg-secondary text-light">Posted by <b>{{ucfirst($comment->user->name)}}</b> at <i>{{$comment->created_at}}</i></div>

        <div class="card-body">
          <div class="text-left">
            {{$comment->content}}
          </div>
          <div class="text-right">
            <a href="{{ URL::to($data['topic']->topiid.'/comments/create/quote/'.$comment->content) }}">Quote</a>
          </div>
        </div>
    </div>
    <br/>
  @endforeach
  {{$data['comments']->links('vendor.pagination.bootstrap-4')}}
@endsection
