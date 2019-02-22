@extends('layouts.admin')

@section('title')
  <title>All Categories</title>
@endsection

@section('heading')
  <h1>All Categories</h1>
@endsection

@section('content')
  <a href="{{ URL::to('admin/categories/create') }}">Create a Category</a>

  <br/> <br/>

    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($categories as $key => $value)
          <tr>
            <td>{{ $value->cateid }}</td>
            <td>{{ $value->name }}</td>
            <td>
              {{ Form::open(array('url' => 'admin/categories/'.$value->cateid, 'class' => 'pull-right')) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Delete this Category', array('class' => 'btn btn-warning')) }}
              {{ Form::close() }}
              <a class="btn btn-small btn-success" href="{{ URL::to('admin/categories/'.$value->cateid) }}">Show this Category</a>
              <a class="btn btn-small btn-info" href="{{ URL::to('admin/categories/'.$value->cateid.'/edit') }}">Edit this Category</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {{$categories->links('vendor.pagination.bootstrap-4')}}
@endsection
