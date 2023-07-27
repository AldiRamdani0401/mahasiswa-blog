@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Post Settings</h1>
</div>

@if(session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
  {{ session('success') }}
</div>
@endif

<div class="table-responsive">
    <table class="table table-striped table-bordered">
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
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>
                    <a href="/dashboard/post-settings/{{ $user->id }}/detail" class="badge bg-primary" style="text-decoration: none;"><span data-feather="eye"></span> Detail</a>
                </td>
            </tr>
        @endforeach
      </tbody>
    </table>
  </div>

@endsection