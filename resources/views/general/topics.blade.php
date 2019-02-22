@extends('layouts.user')

@section('title')
  <title>{{ucfirst($data['forum']->name)}}</title>
@endsection

@section('heading')
  <h1>{{ucfirst($data['forum']->name)}}</h1>
@endsection

@section('content')
  <a href="{{ URL::to($data['forum']->foruid.'/topic_create') }}">Create a topic</a>

  <br/> <br/>

    <table class="table table-bordered table-hover">
      <thead class="thead-dark">
        <tr>
          <th>Topics</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data['topics'] as $topic)
          <tr class="table-light">
            <td><a href="{{ URL::to('topics/'.$topic->topiid) }}">{{ $topic->name }}</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {{$data['topics']->links('vendor.pagination.bootstrap-4')}}
@endsection
