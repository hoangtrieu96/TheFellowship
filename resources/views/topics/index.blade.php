@extends('layouts.admin')

@section('title')
  <title>All Topics</title>
@endsection

@section('heading')
  <h1>All Topics</h1>
@endsection

@section('content')
  <a href="{{ URL::to('admin/topics/create') }}">Create a Topic</a>

  <br/> <br/>

    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($topics as $key => $value)
          <tr>
            <td>{{ $value->topiid }}</td>
            <td>{{ $value->name }}</td>
            <td>
              {{ Form::open(array('url' => 'admin/topics/'.$value->topiid, 'class' => 'pull-right')) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Delete this Topic', array('class' => 'btn btn-warning')) }}
              {{ Form::close() }}
              <a class="btn btn-small btn-success" href="{{ URL::to('admin/topics/'.$value->topiid) }}">Show this Topic</a>
              <a class="btn btn-small btn-info" href="{{ URL::to('admin/topics/'.$value->topiid.'/edit') }}">Edit this Topic</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {{$topics->links('vendor.pagination.bootstrap-4')}}
@endsection
