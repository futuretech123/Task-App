@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
      @endif
      <div class="card">
        <div class="card-header">Users List</div>
        <div class="card-body">
          <table class="table table-hover">
            <thead>
              <th>Name</th>
              <th>Email</th>
              <th>Action</th>
            </thead>
            <tbody>
            @foreach($users as $user)
              <tr>
                <td>{{$user->name}} </td>
                <td>{{$user->email}} </td>
                <td>
                  <form method="POST" action="{{route('user.delete', $user->id)}}" onsubmit="return ConfirmDelete()">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">DELETE</button>
                  </form>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
          {{ $users->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function ConfirmDelete(){
    var x = confirm("Are you sure you want to delete this user? If the user will be deleted then all the task related to this user will be deleted.");
    if (x)
      return true;
    else
      return false;
  }
</script>
@endsection