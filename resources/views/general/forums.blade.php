@extends('layouts.user')

@section('title')
  <title>{{ucfirst($data['category']->name)}}</title>
@endsection

@section('heading')
  <h1>{{ucfirst($data['category']->name)}}</h1>
@endsection

@section('content')

  <br/> <br/>

    <table class="table table-bordered table-hover">
      <thead class="thead-dark">
        <tr>
          <th>Forums</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data['forums'] as $forum)
          <tr class="table-light">
            <td><a href="{{ URL::to('forums/'.$forum->foruid) }}">{{ $forum->name }}</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {{$data['forums']->links('vendor.pagination.bootstrap-4')}}
@endsection
