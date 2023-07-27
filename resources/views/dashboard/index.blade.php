@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Welcome back, {{ auth()->user()->name }}</h1>
</div>

<div class="card shadow-sm p-2" style="width: 300px; height:450px;">
    <h4 class="text-center fw-bold bg-primary p-2 text-white">Profile</h4>
    <div class="d-flex justify-content-center">
        @if (auth()->user()->image && file_exists(public_path('storage/' . auth()->user()->image)))
            <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="{{ auth()->user()->name }}" width="200" height="200" class="img-thumbnail">
        @else
            <img src="{{ asset('img/dummy-avatar.jpg') }}" alt="{{ auth()->user()->name }}" width="200" height="200" class="img-thumbnail">
        @endif
    </div>
  <div class="card-body d-flex justify-content-center">
  <table class="table">
      <tbody>
          <tr>
              <td><b>ID</b></td>
              <td>:</td>
              <td> {{ $user->id }} </td>
          </tr>
          <tr>
              <td><b>Username</b></td>
              <td>:</td>
              <td> {{ $user->username }}</td>
          </tr>
          <tr>
              <td><b>Email</b></td>
              <td>:</td>
              <td> {{ $user->email }} </td>
          </tr>
      </tbody>
  </table>
</div>
@endsection