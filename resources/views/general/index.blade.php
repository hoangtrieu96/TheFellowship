@extends('layouts.user')

@section('title')
  <title>All Categories</title>
@endsection

@section('heading')
  <h1>All Categories</h1>
@endsection

@section('content')

  <br/> <br/>

    <table class="table table-bordered table-hover">
      <thead class="thead-dark">
        <tr>
          <th>Categories</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($categories as $key => $value)
          <tr class="table-light">
            <td><a href="{{ URL::to('categories/'.$value->cateid) }}">{{ $value->name }}</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {{$categories->links('vendor.pagination.bootstrap-4')}}
@endsection
