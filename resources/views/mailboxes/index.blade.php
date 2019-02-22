@extends('layouts.user')

@section('title')
  <title>Mailbox</title>
@endsection

@section('heading')
  <h1>All Messages</h1>
@endsection

@section('content')
  <a href="{{ URL::to('mailboxes/create') }}">Create a new message</a>

  <br/> <br/>

    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Title</th>
          <th>Sender</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($messages as $message)
          <tr>
            <td>{{ $message->title }}</td>
            <td>{{ $message->user->name }}</td>
            <td>
              {{ Form::open(array('url' => 'mailboxes/'.$message->messid, 'class' => 'pull-right')) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Delete this message', array('class' => 'btn btn-warning')) }}
              {{ Form::close() }}
              <a class="btn btn-small btn-success" href="{{ URL::to('mailboxes/'.$message->messid) }}">Read this message</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {{$messages->links('vendor.pagination.bootstrap-4')}}
@endsection
