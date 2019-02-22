@extends('layouts.admin')

@section('title')
  <title>All comments</title>
@endsection

@section('heading')
  <h1>All comments</h1>
@endsection

@section('content')
  <a href="{{ URL::to('admin/comments/create') }}">Create a comment</a>

  <br/> <br/>

    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Content</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($comments as $key => $value)
          <tr>
            <td>{{ $value->commid }}</td>
            <td>{{ $value->content }}</td>
            <td>
              {{ Form::open(array('url' => 'admin/comments/'.$value->commid, 'class' => 'pull-right')) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Delete this comment', array('class' => 'btn btn-warning')) }}
              {{ Form::close() }}
              <a class="btn btn-small btn-success" href="{{ URL::to('admin/comments/'.$value->commid) }}">Show this comment</a>
              <a class="btn btn-small btn-info" href="{{ URL::to('admin/comments/'.$value->commid.'/edit') }}">Edit this comment</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {{$comments->links('vendor.pagination.bootstrap-4')}}
@endsection
