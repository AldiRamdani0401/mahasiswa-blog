@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">User Settings</h1>
</div>

@if(session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
  {{ session('success') }}
</div>
@endif

<div class="table-responsive col-lg-6">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">User ID</th>
          <th scope="col">Name</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
            @if(!$user['is_admin'] == 1)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>
                    <a class="badge bg-primary" style="text-decoration: none;"" href="{{ route('user-settings.show', ['user' => $user->id]) }}">
                        <span data-feather="settings"></span> Setting
                    </a>
                </td>
            </tr>
            @endif
        @endforeach
      </tbody>
    </table>
  </div>

@endsection