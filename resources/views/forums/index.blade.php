@extends('layouts.admin')

@section('title')
  <title>All Forums</title>
@endsection

@section('heading')
  <h1>All Forums</h1>
@endsection

@section('content')
  <a href="{{ URL::to('admin/forums/create') }}">Create a Forum</a>

  <br/> <br/>

    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($forums as $key => $value)
          <tr>
            <td>{{ $value->foruid }}</td>
            <td>{{ $value->name }}</td>
            <td>
              {{ Form::open(array('url' => 'admin/forums/'.$value->foruid, 'class' => 'pull-right')) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Delete this Forum', array('class' => 'btn btn-warning')) }}
              {{ Form::close() }}
              <a class="btn btn-small btn-success" href="{{ URL::to('admin/forums/'.$value->foruid) }}">Show this Forum</a>
              <a class="btn btn-small btn-info" href="{{ URL::to('admin/forums/'.$value->foruid.'/edit') }}">Edit this Forum</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {{$forums->links('vendor.pagination.bootstrap-4')}}
@endsection
