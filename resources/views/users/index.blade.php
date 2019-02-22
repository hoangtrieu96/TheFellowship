@extends('layouts.admin')

@section('title')
  <title>All users</title>
@endsection

@section('heading')
  <h1>All users</h1>
@endsection

@section('content')
  <br/> <br/>

    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $key => $value)
          <tr>
            <td>{{ $value->userid }}</td>
            <td>{{ $value->name }}</td>
            <td>
              {{ Form::open(array('url' => 'admin/users/'.$value->userid, 'class' => 'pull-right')) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Delete this user', array('class' => 'btn btn-warning')) }}
              {{ Form::close() }}
              <a class="btn btn-small btn-success" href="{{ URL::to('admin/users/'.$value->userid) }}">Show this user</a>
              <a class="btn btn-small btn-info" href="{{ URL::to('admin/users/'.$value->userid.'/edit') }}">Edit this user</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {{$users->links('vendor.pagination.bootstrap-4')}}
@endsection
